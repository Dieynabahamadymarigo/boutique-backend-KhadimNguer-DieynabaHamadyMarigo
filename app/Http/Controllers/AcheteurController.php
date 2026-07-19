<?php

namespace App\Http\Controllers;

use App\Models\Acheteur;
use App\Models\Produit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

// Crud Acheteur

class AcheteurController extends Controller
{
    //liste des acheteurs,triés par nom
    public function index():View
    {
        $acheteurs = Acheteur::query()->orderBy('nom')->get();
        $produits = Produit::orderBy('nom')->get();

        return view('acheteurs.index', ['acheteurs' => $acheteurs, 'produits' =>$produits]);
    }

    // Affichage du formulaire de création.
    public function create():View
    {
        return view('acheteurs.create');
    }

    // Enregistrer un nouvel acheteur en base.
    public function store(Request $request):RedirectResponse
    {
        // Vérifie les données du formulaire avant insertion
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:acheteurs,email'],
            'telephone' => ['nullable', 'string', 'max:20'],
        ]);

        Acheteur::create($validated);

        return Redirect::route('acheteurs.index')->with('success', 'Acheteur créé.');
    }

    // Affiche la fiche d'un acheteur.
    public function show(Acheteur $acheteur):View
    {
        // load
        $acheteur->load('produits');

        // Liste des produits disponibles
        $produits = Produit::orderBy('nom')->get();

        return view('acheteurs.show', ['acheteur' => $acheteur, 'produits' => $produits]);
    }

    // Affiche le formulaire d'édition.
    public function edit(Acheteur $acheteur):View
    {
        return view('acheteurs.edit', ['acheteur' => $acheteur]);
    }

    // Met à jour un acheteur existant.
    public function update(Request $request, Acheteur $acheteur):RedirectResponse
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:acheteurs,email,' . $acheteur->id],
            'telephone' => ['nullable', 'string', 'max:20'],
        ]);

        $acheteur->update($validated);

        return Redirect::route('acheteurs.index')->with('success', 'Acheteur mis à jour.');
    }

    // Supprime un acheteur
    public function destroy(Acheteur $acheteur):RedirectResponse
    {
        $acheteur->delete();

        return Redirect::route('acheteurs.index')->with('success', 'Acheteur supprimé.');
    }

    // Enregistre un produit acheté par un acheteur.
    public function acheter(Request $request, Acheteur $acheteur):RedirectResponse
    {
        $validated = $request->validate([
            'produit_id' => ['required', 'exists:produits,id'],
            'quantite' => ['required', 'integer', 'min:1'],
            'date_achat' => ['required', 'date'],
        ]);

        // insert into pivot table acheteur_produit
        $acheteur->produits()->attach($validated['produit_id'], ['quantite' => $validated['quantite'], 'date_achat' => $validated['date_achat']]);

        return Redirect::route('acheteurs.index')->with('success', 'Achat enregistré.');
    }
}
