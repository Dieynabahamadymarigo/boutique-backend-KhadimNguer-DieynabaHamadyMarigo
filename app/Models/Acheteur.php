<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acheteur extends Model
{
    //
    protected $fillable = ['nom', 'email', 'telephone'];

    // Un acheteur peut acheter plusieurs produits
    public function produits()
    {
        return $this->belongsToMany(Produit::class)
            ->withPivot('quantite', 'date_achat')
            ->withTimestamps();
    }
}
