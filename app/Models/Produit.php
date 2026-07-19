<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    //
    protected $fillable = ['nom', 'prix', 'stock', 'description', 'categories_id'];

    // Conversion automatique des attributs en types natifs
    protected function casts(): array
    {
        return [
        'prix' => 'decimal:2',
        'stock' => 'integer',
        ];
    }

    // Un produit appartient à une catégorie
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categories_id');
    }

    // Un produit peut être acheté par plusieurs acheteurs
    public function acheteurs()
    {
        return $this->belongsToMany(Acheteur::class, 'acheteur_produits', 'produits_id', 'acheteurs_id')
            ->withPivot('quantite', 'date_achat')
            ->withTimestamps();
    }
}
