<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::with('categorie')->latest()->paginate(10);
        return view('produits.index', compact('produits'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('produits.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'reference' => 'required|string|unique:produits,reference',
            'designation' => 'required|string|max:255',
            'prix_achat' => 'required|numeric|min:0',
            'prix_vente' => 'required|numeric|min:0',
            'stock_actuel' => 'required|integer|min:0',
            'seuil_alerte' => 'required|integer|min:0',
            'methode_valorisation' => 'required|string|in:CUMP,FIFO',
        ]);

        Produit::create([
            'category_id' => $request->category_id,
            'reference' => $request->reference,
            'designation' => $request->designation,
            'prix_achat' => $request->prix_achat,
            'prix_vente' => $request->prix_vente,
            'stock_actuel' => $request->stock_actuel,
            'seuil_alerte' => $request->seuil_alerte,
            'methode_valorisation' => $request->methode_valorisation,
        ]);

        return redirect()->route('produits.index')->with('success', 'Produit enregistré avec succès.');
    }

    public function edit(Produit $produit)
    {
        $categories = Categorie::all();
        return view('produits.edit', compact('produit', 'categories'));
    }

    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'reference' => 'required|string|unique:produits,reference,' . $produit->id,
            'designation' => 'required|string|max:255',
            'prix_achat' => 'required|numeric|min:0',
            'prix_vente' => 'required|numeric|min:0',
            'stock_actuel' => 'required|integer|min:0',
            'seuil_alerte' => 'required|integer|min:0',
            'methode_valorisation' => 'required|string|in:CUMP,FIFO',
        ]);

        $produit->update([
            'category_id' => $request->category_id,
            'reference' => $request->reference,
            'designation' => $request->designation,
            'prix_achat' => $request->prix_achat,
            'prix_vente' => $request->prix_vente,
            'stock_actuel' => $request->stock_actuel,
            'seuil_alerte' => $request->seuil_alerte,
            'methode_valorisation' => $request->methode_valorisation,
        ]);

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
    }
}