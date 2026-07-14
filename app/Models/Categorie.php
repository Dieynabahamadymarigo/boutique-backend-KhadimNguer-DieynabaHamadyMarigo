<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    //
    protected $fillable = ['nom', 'description'];

    // Une catégorie peut avoir plusieurs produits
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
}
