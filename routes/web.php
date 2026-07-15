<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\AcheteurController;

// Page Accueil
Route::get('/', function () { return view('boutique.home');})->name('home');

// resource, il permet de générer les 7 routes pour le CRUD de la ressource Categorie

//category
Route::resource('categories', CategorieController::class)-> parameters(['categories' => 'categorie']);

//Product
Route::resource('produits', ProduitController::class);

// Client
Route::resource('acheteurs', AcheteurController::class);

// Permet d'enregistrer un achat
Route::post('/acheteurs/{acheteur}/acheter', [AcheteurController::class, 'acheter'])->name('acheteurs.acheter');
