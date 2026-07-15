<?php

use App\Http\Controllers\Api\AcheteurController;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\ProduitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// resource, il permet de générer les 7 routes pour le CRUD de la ressource Categorie
// le paramètre 'categorie' permet de spécifier le nom du paramètre dans l'URL pour les routes qui nécessitent un identifiant de catégorie.


//category
// Route::apiResource('categories', CategorieController::class)->parameters(['categories' => 'categorie']);

//Product
// Route::apiResource('produits', ProduitController::class);

// Client
// Route::apiResource('acheteurs', AcheteurController::class);

// Permet d'enregistrer un achat
// Route::post('/acheteurs/{acheteur}/acheter', [AcheteurController::class, 'acheter'])->name('api.acheteurs.acheter');
