<?php

namespace App\Models;

use  Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;

    protected $table  ="panier";
    protected $primaryKey = "idPanier"; //Clé primaire
    protected $fillable = [
        'idClient',
        'datePanier',
        'total_price',
        'status',
    ];

    //Relation avec User
   public function contenirprs(){
    return $this->hasMany(Contenirpr::class, 'idPanier','idPanier');
   }

   //Relation avec User
   public function produits(){
    return $this->belongsToMany(Produit::class, 'contenirpr', 'idPanier', 'idProd_Produit')
    ->withPivot('quantitePr', 'prixPr')
    ->withTimestamps();
   }

   //Relation avec ContenirPc
   public function contenirpc(){
    return $this->hasMany(ContenirPc::class, 'idPanier','idPanier');
   }

   //Relation avec Piece
   public function pieces(){
    return $this->belongsToMany(Piece::class, 'contenir_pc', 'panier_id','piece_id')
    ->withPivot('quantitePc', 'prixPc')
    ->withTimestamps();
   
   }

   //Relation avec User
   public function offres()
    {
        return $this->belongsToMany(Offre::class, 'contenir_offre', 'idPanier', 'idOffre')
            ->withPivot('quantiteOf', 'prixOffre');
    }
};
