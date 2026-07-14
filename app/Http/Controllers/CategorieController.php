<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

//CRUD des catégories.

class CategorieController extends Controller
{
    // liste des catégories,triées par nom
    public function index(): View
    {
        $categories = Categorie::query()->orderBy('nom')->get();

        return view('categories.index', ['categories' => $categories]);
    }

    // Affichage du formulaire de création.
    public function create(): View
    {
        return view('categories.create');
    }

    // Enregistrer une nouvelle catégorie en base.
    public function store(Request $request): RedirectResponse
    {
        // Vérifie les données du formulaire avant insertion
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:100', 'unique:categories,nom'],
            'description' => ['nullable', 'string'],
        ]);

        Categorie::create($validated);

        return Redirect::route('categories.index')->with('success', 'Catégorie créée.');
    }


    public function show(Categorie $categorie): View
    {
        // load
        $categorie->load('produits');

        return view('categories.show', ['categorie' => $categorie]);
    }

    // Affiche le formulaire d'édition.
    public function edit(Categorie $categorie): View
    {
        return view('categories.edit', ['categorie' => $categorie]);
    }

    // Met à jour une catégorie existante.
    public function update(Request $request, Categorie $categorie): RedirectResponse
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:100', 'unique:categories,nom,' . $categorie->id],
            'description' => ['nullable', 'string'],
        ]);

        $categorie->update($validated);

        return Redirect::route('categories.index')->with('success', 'Catégorie mise à jour.');
    }

    // Supprime une catégorie
    public function destroy(Categorie $categorie): RedirectResponse
    {
        $categorie->delete();

        return Redirect::route('categories.index')->with('success', 'Catégorie supprimée.');
    }
}
