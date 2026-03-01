<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    // Définir le nom de la table si ce n'est pas le pluriel du nom du modèle
    protected $table = 'produit';
    protected $primaryKey = 'idProd'; //Clé primaire

    // Spécifie les colonnes autorisées à être massivement assignées
    protected $fillable = [
        'designationProduit',
        'prixProduit',
        'stockProduit',
        'photoProduit',
        'idCategorie',
        'descriptionProduit',
    ];

    public function categorie(){
        // Un produit appartient à une catégorie
        return $this->belongsTo(Categorie::class, 'idCategorie');

    }

    public function avis(){
        // Un produit peut avoir plusieurs avis
        return $this->hasMany(Avis::class, 'idProduit');
    }

    public $timestamps = false;

    // Relation avec la table contenir_pr
    public function contenirprs()
    {
        return $this->hasMany(Contenir::class, 'idProd_Produit','idProd');
    }

    // Relation avec la table concerner
    public function concerners() { 
        return $this->hasMany(Concerner::class, 'idProd_Produit', 'idProd'); 
    }
}
