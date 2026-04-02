<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    protected $fillable = [
        'idEssence',
        'idCategorie',
        'quantitePanier',
        'prixTotalPanier',
    ];

    protected $table = 'panier';
}
