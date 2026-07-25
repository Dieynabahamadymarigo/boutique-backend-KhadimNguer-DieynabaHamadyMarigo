<?php

namespace Database\Seeders;

use App\Models\Acheteur;
use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Catégories
        $cafes = Categorie::create([
            'nom'=> 'Cafés ☕',
            'description'=>'Catégorie des cafés',
        ]);
        $patisseries = Categorie::create([
            'nom'=>'Patisséries 🥨',
            'description'=>'Viennoiseries 🥐 et Gateaux 🎂',
        ]);

        // Produits
        $produitAchete = Produit::create([
            'nom'=> 'Cappuccino ☕',
            'prix'=> 3000,
            'stock'=> 10,
            'description'=> 'Cappuccino, à base de café expresso',
            'categories_id'=> $cafes->id,
        ]);
        Produit::create([
            'nom'=> 'Croissant 🥐',
            'prix'=> 1000,
            'stock'=> 7,
            'description'=> 'Croissant au choco',
            'categories_id'=> $patisseries->id,
        ]);

        // Acheteurs
        $acheteur = Acheteur::create([
            'nom'=>'Awa',
            'email'=>'awa@gmail.com',
            'telephone'=>'778798899'
        ]);

        // Enregistrer un achat
        $acheteur->produits()->attach($produitAchete->id,[
            'quantite'=>3,
            'date_achat'=> '2026-07-17',
        ]);

    }
}
