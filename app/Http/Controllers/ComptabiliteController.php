<?php

namespace App\Http\Controllers;

use App\Models\EcritureComptable;
use App\Models\CompteComptable;
use Illuminate\Http\Request;

class ComptabiliteController extends Controller
{
    public function journal()
    {
        $ecritures = EcritureComptable::with('compte')->latest('date_ecriture')->paginate(15);
        return view('comptabilite.journal', compact('ecritures'));
    }

    public function create()
    {
        $comptes = CompteComptable::all();
        return view('comptabilite.create', compact('comptes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_ecriture' => 'required|date',
            'piece_ref' => 'required|string|max:255',
            'numero_compte' => 'required|string',
            'journal_code' => 'required|string|max:10',
            'libelle' => 'required|string|max:255',
            'montant_debit' => 'required|numeric|min:0',
            'montant_credit' => 'required|numeric|min:0',
        ]);

        // Recherche ou création automatique du compte SYSCOHADA s'il n'existe pas
        $compte = CompteComptable::firstOrCreate(
            ['numero_compte' => $request->numero_compte],
            [
                'intitule' => 'Compte ' . $request->numero_compte,
                'classe' => substr($request->numero_compte, 0, 1)
            ]
        );

        // Enregistrement de l'écriture avec le code journal
        EcritureComptable::create([
            'date_ecriture' => $request->date_ecriture,
            'piece_ref' => $request->piece_ref,
            'compte_id' => $compte->id,
            'journal_code' => $request->journal_code,
            'libelle' => $request->libelle,
            'debit' => $request->montant_debit,
            'credit' => $request->montant_credit,
        ]);

        return redirect()->route('comptabilite.journal')
            ->with('success', 'Écriture comptable enregistrée avec succès.');
    }

    public function destroy($id)
    {
        $ecriture = EcritureComptable::findOrFail($id);
        $ecriture->delete();

        return redirect()->route('comptabilite.journal')
            ->with('success', 'Écriture comptable supprimée avec succès.');
    }

    public function balance()
    {
        $comptes = CompteComptable::with(['ecritures'])->get()->map(function ($compte) {
            $totalDebit = $compte->ecritures->sum('debit');
            $totalCredit = $compte->ecritures->sum('credit');
            $solde = $totalDebit - $totalCredit;

            $compte->total_debit = $totalDebit;
            $compte->total_credit = $totalCredit;
            $compte->solde = $solde;

            return $compte;
        })->filter(function ($compte) {
            return $compte->total_debit > 0 || $compte->total_credit > 0;
        });

        return view('comptabilite.balance', compact('comptes'));
    }
}