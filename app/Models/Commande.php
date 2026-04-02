<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'idEssence',
        'idCategorie',
        'quantiteCommande',
        'prixTotalCommande',
    ];

    protected $table = 'commandes';
}
