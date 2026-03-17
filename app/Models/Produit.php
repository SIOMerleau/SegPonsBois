<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $primaryKey = 'idProd';
    protected $fillable = [
        'prixProduit', 'designationProduit', 'stockProduit', 'idCategorie', 'descriptionProduit'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'idCategorie');
    }
}

