<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concerner extends Model
{
    use HasFactory;

    protected $table = 'concerner';

    protected $fillable = [
        'idOffre', 
        'idProd_Produit', 
        'prixOffre',
        'quantiteOf'
    ];

    //Relation avec Offre
    public function offre()
    {
        return $this->belongsTo(Offre::class, 'idOffre', 'idOffre');
    }

    //Relation avec Produit
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'idProd_Produit', 'idProd');
    }
}
