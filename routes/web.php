<?php

use App\Http\Controllers\AcheteurController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Page accueil
Route::get('/', function () {
    return view('boutique.home');
})->middleware(['auth', 'verified'])->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Génère les 7 routes CRUD pour chaque ressource
Route::resource('categories', CategorieController::class)
    ->parameters(['categories' => 'categorie']);
Route::resource('produits', ProduitController::class);
Route::resource('acheteurs', AcheteurController::class);

// Enregistrer un achat
Route::post('/acheteurs/{acheteur}/acheter', [AcheteurController::class, 'acheter'])
    ->name('acheteurs.acheter');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
