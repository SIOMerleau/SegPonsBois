<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;

    protected $table = 'avis';
    protected $primaryKey = 'idProd'; // Clé primaire

    protected $fillable = [
        'idProduit',
        'idUsers',
        'etoilesAvis',
        'texteAvis',
        'dateAvis',
    ];

    //Un avis appartient à un produit
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'idProduit', 'idProd');
    }

    // Un avis appartient à un utilisateur
    public function user(){
        return $this->belongsTo(User::class, 'idUsers', 'id');
    }
}
