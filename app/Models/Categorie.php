<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    // Définir le nom de la table si ce n'est pas le pluriel du nom du modèle
    protected $table = 'categorie';

    // Spécifie les colonnes autorisées à être massivement assignées
    protected $fillable = [
        'libelleCategorie',
    ];

    //Clé primaire
    protected $primaryKey = 'idCategorie';

    public $timestamps = false;
}
