<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContenirPr extends Model
{
    use HasFactory;

    // Définir le nom de la table si ce n'est pas le pluriel du nom du modèle
    protected $table = 'contenirpr';

    // Spécifie les colonnes autorisées à être massivement assignées
    protected $fillable = [
        'quantitePr',
        'prixPr',
        'idProd_Produit',
        'idPanier',
    ];

    //Relation avec Produit
   public function produit()
   {
     return $this->belongsTo(Produit::class, 'idProd_Produit', 'idProd');
   }

   //Relation avec Panier
   public function panier(){
     return $this->belongsTo(Panier::class, 'idPanier', 'idPanier');
   }
}
