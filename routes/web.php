<?php

use App\Http\Controllers\AcheteurController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Page accueil
Route::get('/', function () {
    return view('boutique.home');
})->name('home');

// Catalogue produits — visible même sans connexion
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::get('/produits/{produit}', [ProduitController::class, 'show'])->name('produits.show');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:employe,gestionnaire,admin'])->group(function () {

    // categories
    Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
    Route::get('/categories/{categorie}', [CategorieController::class, 'show'])->name('categories.show');

    // acheteurs
    Route::get('/acheteurs', [AcheteurController::class, 'index'])->name('acheteurs.index');
    Route::get('/acheteurs/{acheteur}', [AcheteurController::class, 'show'])->name('acheteurs.show');

    // Enregistrer un achat
    Route::post('/acheteurs/{acheteur}/acheter', [AcheteurController::class, 'acheter'])
        ->name('acheteurs.acheter');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    });

Route::middleware(['auth', 'role:gestionnaire,admin'])->group(function () {
    // Produits
    Route::get('/produits/create', [ProduitController::class, 'create'])->name('produits.create');
    Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
    Route::get('/produits/{produit}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
    Route::put('/produits/{produit}', [ProduitController::class, 'update'])->name('produits.update');
    Route::delete('/produits/{produit}', [ProduitController::class, 'destroy'])->name('produits.destroy');

    // catégories
    Route::get('/categories/create', [CategorieController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
    Route::get('/categories/{categorie}/edit', [CategorieController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{categorie}', [CategorieController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{categorie}', [CategorieController::class, 'destroy'])->name('categories.destroy');

    // acheteurs
    Route::get('/acheteurs/create', [AcheteurController::class, 'create'])->name('acheteurs.create');
    Route::post('/acheteurs', [AcheteurController::class, 'store'])->name('acheteurs.store');
    Route::get('/acheteurs/{acheteur}/edit', [AcheteurController::class, 'edit'])->name('acheteurs.edit');
    Route::put('/acheteurs/{acheteur}', [AcheteurController::class, 'update'])->name('acheteurs.update');
    Route::delete('/acheteurs/{acheteur}', [AcheteurController::class, 'destroy'])->name('acheteurs.destroy');

});

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('users', UserController::class)->parameters(['users' => 'user']);

});
    // Route::resource('categories', CategorieController::class)
    //     ->parameters(['categories' => 'categorie']);
    // Route::resource('produits', ProduitController::class);

    // Route::resource('acheteurs', AcheteurController::class);


require __DIR__.'/auth.php';
