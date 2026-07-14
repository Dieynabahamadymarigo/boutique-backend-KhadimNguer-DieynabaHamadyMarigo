<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\AcheteurController;

// Page Accueil
Route::get('/', function () { return view('boutique.accueil');})->name('accueil');

// resource, il permet de générer les 7 routes pour le CRUD de la ressource Categorie
// le paramètre 'categorie' permet de spécifier le nom du paramètre dans l'URL pour les routes qui nécessitent un identifiant de catégorie.

//category
Route::resource('categories', CategorieController::class)-> parameters(['categories' => 'categorie']);

//Product
Route::resource('produits', ProduitController::class);

// Client
Route::resource('acheteurs', AcheteurController::class);

// Permet d'enregistrer un achat
Route::post('/acheteurs/{acheteur}/acheter', [AcheteurController::class, 'acheter'])->name('acheteurs.acheter');
