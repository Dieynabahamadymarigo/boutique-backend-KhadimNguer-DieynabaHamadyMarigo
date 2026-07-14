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
        return $this->belongsTo(Categorie::class);
    }

    // Un produit peut être acheté par plusieurs acheteurs
    public function acheteurs()
    {
        return $this->belongsToMany(Acheteur::class)
            ->withPivot('quantite', 'date_achat')
            ->withTimestamps();
    }
}
