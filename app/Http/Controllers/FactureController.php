<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\LigneFacture;
use App\Models\Produit;
use App\Models\Tiers;
use App\Models\MouvementStock;
use App\Models\EcritureComptable;
use App\Models\CompteComptable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FactureController extends Controller
{
    public function index()
    {
        $factures = Facture::with(['tiers', 'user', 'lignes.produit'])->latest()->paginate(10);
        return view('factures.index', compact('factures'));
    }

    public function create()
    {
        $clients = Tiers::where('type', 'client')->get();
        $produits = Produit::all();
        return view('factures.create', compact('clients', 'produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tiers_id' => 'required|exists:tiers,id',
            'lignes' => 'required|array|min:1',
            'lignes.*.produit_id' => 'required|exists:produits,id',
            'lignes.*.quantite' => 'required|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $montantHt = 0;
                $tvaRate = 0.18;
                $lignesData = [];

                foreach ($request->lignes as $item) {
                    $produit = Produit::lockForUpdate()->findOrFail($item['produit_id']);
                    $quantite = $item['quantite'];

                    if ($produit->stock_actuel < $quantite) {
                        throw new \Exception("Stock insuffisant pour le produit : {$produit->designation} (Stock: {$produit->stock_actuel})");
                    }

                    $prixUnit = $produit->prix_vente;
                    $montantLigne = $quantite * $prixUnit;
                    $montantHt += $montantLigne;

                    $lignesData[] = [
                        'produit' => $produit,
                        'quantite' => $quantite,
                        'prix_unit' => $prixUnit,
                        'montant_ligne' => $montantLigne,
                    ];
                }

                $montantTva = $montantHt * $tvaRate;
                $montantTtc = $montantHt + $montantTva;

                $numeroFacture = 'FAC-' . date('Y') . '-' . str_pad(Facture::count() + 1, 4, '0', STR_PAD_LEFT);
                
                $facture = Facture::create([
                    'numero' => $numeroFacture,
                    'tiers_id' => $request->tiers_id,
                    'user_id' => auth()->id(),
                    'date_facture' => Carbon::now(),
                    'montant_ht' => $montantHt,
                    'montant_tva' => $montantTva,
                    'montant_ttc' => $montantTtc,
                    'statut' => 'impayee',
                ]);

                foreach ($lignesData as $data) {
                    $produit = $data['produit'];
                    
                    LigneFacture::create([
                        'facture_id' => $facture->id,
                        'produit_id' => $produit->id,
                        'quantite' => $data['quantite'],
                        'prix_unit' => $data['prix_unit'],
                        'montant_ligne' => $data['montant_ligne'],
                    ]);

                    $produit->stock_actuel -= $data['quantite'];
                    $produit->save();

                    MouvementStock::create([
                        'produit_id' => $produit->id,
                        'user_id' => auth()->id(),
                        'type' => 'sortie',
                        'quantite' => $data['quantite'],
                        'prix_unit' => $produit->prix_achat,
                        'motif' => "Vente - Facture {$numeroFacture}",
                    ]);
                }

                $compteClient = CompteComptable::firstOrCreate(['numero_compte' => '411000'], ['intitule' => 'Clients', 'classe' => 4]);
                $compteVente = CompteComptable::firstOrCreate(['numero_compte' => '701000'], ['intitule' => 'Ventes de marchandises', 'classe' => 7]);
                $compteTva = CompteComptable::firstOrCreate(['numero_compte' => '443100'], ['intitule' => 'TVA facturée', 'classe' => 4]);

                $dateJour = Carbon::now();

                EcritureComptable::create([
                    'journal_code' => 'VTE',
                    'compte_id' => $compteClient->id,
                    'libelle' => "Facture {$numeroFacture}",
                    'debit' => $montantTtc,
                    'credit' => 0,
                    'date_ecriture' => $dateJour,
                ]);

                EcritureComptable::create([
                    'journal_code' => 'VTE',
                    'compte_id' => $compteVente->id,
                    'libelle' => "Facture {$numeroFacture}",
                    'debit' => 0,
                    'credit' => $montantHt,
                    'date_ecriture' => $dateJour,
                ]);

                if ($montantTva > 0) {
                    EcritureComptable::create([
                        'journal_code' => 'VTE',
                        'compte_id' => $compteTva->id,
                        'libelle' => "Facture {$numeroFacture}",
                        'debit' => 0,
                        'credit' => $montantTva,
                        'date_ecriture' => $dateJour,
                    ]);
                }
            });

            return redirect()->route('factures.index')->with('success', 'Facture générée, stock mis à jour et écritures comptables passées avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function show(Facture $facture)
    {
        $facture->load(['tiers', 'user', 'lignes.produit']);
        return view('factures.show', compact('facture'));
    }
}