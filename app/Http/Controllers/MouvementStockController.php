<?php

namespace App\Http\Controllers;

use App\Models\MouvementStock;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MouvementStockController extends Controller
{
    // Afficher la liste des mouvements
    public function index()
    {
        $mouvements = MouvementStock::with(['produit', 'user'])->latest()->paginate(15);
        return view('mouvements.index', compact('mouvements'));
    }

    // Afficher le formulaire de création d'un mouvement (Réapprovisionnement / Sortie)
    public function create()
    {
        $produits = Produit::all();
        return view('mouvements.create', compact('produits'));
    }

    // Enregistrer un nouveau mouvement de stock (Entrée / Sortie / Ajustement)
    public function store(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'type' => 'required|in:entree,sortie,ajustement',
            'quantite' => 'required|integer|min:1',
            'prix_unit' => 'nullable|numeric|min:0', // Rendu nullable pour éviter les blocages lors des sorties
            'motif' => 'nullable|string|max:255',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $produit = Produit::lockForUpdate()->findOrFail($request->produit_id);
                $quantite = $request->quantite;
                
                // Si le prix_unit n'est pas fourni (ex: en sortie), on prend le prix d'achat actuel du produit
                $prixUnit = $request->prix_unit ?? $produit->prix_achat;

                if ($request->type === 'entree') {
                    // Calcul du CUMP (Coût Unitaire Moyen Pondéré)
                    $ancienStock = $produit->stock_actuel;
                    $ancienCump = $produit->prix_achat;

                    if (($ancienStock + $quantite) > 0) {
                        $nouveauCump = (($ancienStock * $ancienCump) + ($quantite * $prixUnit)) / ($ancienStock + $quantite);
                        $produit->prix_achat = round($nouveauCump, 2);
                    }

                    $produit->stock_actuel += $quantite;

                } elseif ($request->type === 'sortie') {
                    if ($produit->stock_actuel < $quantite) {
                        throw new \Exception("Stock insuffisant pour ce produit. Stock actuel : {$produit->stock_actuel}");
                    }
                    $produit->stock_actuel -= $quantite;

                } elseif ($request->type === 'ajustement') {
                    $produit->stock_actuel = $quantite; 
                }

                $produit->save();

                // Enregistrement du mouvement lié à l'utilisateur connecté
                MouvementStock::create([
                    'produit_id' => $produit->id,
                    'user_id' => auth()->id(),
                    'type' => $request->type,
                    'quantite' => $quantite,
                    'prix_unit' => $prixUnit,
                    'motif' => $request->motif,
                ]);
            });

            return redirect()->route('mouvements.index')->with('success', 'Mouvement de stock enregistré avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    // Supprimer un mouvement et réajuster le stock en conséquence
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $mouvement = MouvementStock::findOrFail($id);
                $produit = Produit::lockForUpdate()->findOrFail($mouvement->produit_id);

                // Inverser l'effet du mouvement sur le stock avant de le supprimer
                if ($mouvement->type === 'entree') {
                    if ($produit->stock_actuel < $mouvement->quantite) {
                        throw new \Exception("Impossible de supprimer ce mouvement : le stock actuel serait négatif.");
                    }
                    $produit->stock_actuel -= $mouvement->quantite;
                } elseif ($mouvement->type === 'sortie') {
                    $produit->stock_actuel += $mouvement->quantite;
                }

                $produit->save();
                $mouvement->delete();
            });

            return redirect()->route('mouvements.index')->with('success', 'Mouvement supprimé et stock réajusté avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}