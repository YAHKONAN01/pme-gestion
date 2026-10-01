<?php

namespace App\Http\Controllers;

use App\Models\Tiers;
use Illuminate\Http\Request;

class TiersController extends Controller
{
    public function index()
    {
        $tiers = Tiers::latest()->paginate(10);
        return view('tiers.index', compact('tiers'));
    }

    public function create()
    {
        return view('tiers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:client,fournisseur',
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
            'plafond_credit' => 'required|numeric|min:0',
        ]);

        Tiers::create($request->all());

        return redirect()->route('tiers.index')->with('success', 'Tiers enregistré avec succès.');
    }
}