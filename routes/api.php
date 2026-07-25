<?php

use App\Http\Controllers\Api\AcheteurController;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\ProduitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//category
// Lister toutes les catégories
Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
// Créer une nouvelle catégorie
Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
// Afficher le détail d'une catégorie
Route::get('/categories/{categorie}', [CategorieController::class, 'show'])->name('categories.show');
// Modifier une catégorie existante
Route::put('/categories/{categorie}', [CategorieController::class, 'update'])->name('categories.update');
// Supprimer une catégorie
Route::delete('/categories/{categorie}', [CategorieController::class, 'destroy'])->name('categories.destroy');

// Product
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
Route::get('/produits/{id}', [ProduitController::class, 'show'])->name('produits.show');
Route::put('/produits/{id}', [ProduitController::class, 'update'])->name('produits.update');
Route::delete('/produits/{id}', [ProduitController::class, 'destroy'])->name('produits.destroy');

// Acheteurs
Route::get('/acheteurs', [AcheteurController::class, 'index'])->name('acheteurs.index');
Route::post('/acheteurs', [AcheteurController::class, 'store'])->name('acheteurs.store');
Route::get('/acheteurs/{id}', [AcheteurController::class, 'show'])->name('acheteurs.show');
Route::put('/acheteurs/{id}', [AcheteurController::class, 'update'])->name('acheteurs.update');
Route::delete('/acheteurs/{id}', [AcheteurController::class, 'destroy'])->name('acheteurs.destroy');

// Permet d'enregistrer un achat
Route::post('/acheteurs/{id}/acheter', [AcheteurController::class, 'acheter'])->name('api.acheteurs.acheter');

// Route::apiResource('categories', CategorieController::class)->parameters(['categories' => 'categorie']);

//Product
// Route::apiResource('produits', ProduitController::class);

// Client
// Route::apiResource('acheteurs', AcheteurController::class);
