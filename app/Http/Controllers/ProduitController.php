<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProduitController extends Controller
{
    //CRUD des produits
    public function index():View
    {
        // Logique pour afficher la liste des produits
        $produits = Produit::with('categorie')->orderBy('nom')->get();

        return view('produits.index', ['produits' => $produits]);
    }

    // Affiche le formulaire de création d'un produit.
    public function create():View
    {
        // Liste des catégories pour le formulaire de création de produit
        $categories = Categorie::orderBy('nom')->get();

        return view('produits.create', ['categories' => $categories]);
    }

    // Enregistre un nouveau produit en base.
    public function store(Request $request):RedirectResponse
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prix' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'categorie_id' => ['required', 'exists:categories,id'],
        ]);

        Produit::create($validated);

        return Redirect()->route('produits.index')->with('success', 'Produit créé.');
    }

    // Affiche la fiche d'un produit.
    public function show(Produit $produit):View
    {
        $produit->load('categorie','acheteurs');

        return view('produits.show', ['produit' => $produit]);
    }

    // Affiche le formulaire d'édition d'un produit.
    public function edit(Produit $produit):View
    {
        // Liste des catégories pour le formulaire d'édition de produit
        $categories = Categorie::orderBy('nom')->get();

        return view('produits.edit', ['produit' => $produit, 'categories' => $categories]);
    }

    // Met à jour un produit existant.
    public function update(Request $request, Produit $produit):RedirectResponse
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prix' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'categorie_id' => ['required', 'exists:categories,id'],
        ]);

        $produit->update($validated);

        return Redirect()->route('produits.index')->with('success', 'Produit mis à jour.');
    }

    // Supprime un produit.
    public function destroy(Produit $produit):RedirectResponse
    {
        $produit->delete();

        return Redirect()->route('produits.index')->with('success', 'Produit supprimé.');
    }
}
