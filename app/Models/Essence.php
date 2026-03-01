<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Essence extends Model
{
    use HasFactory;

    // Définir le nom de la table si ce n'est pas le pluriel du nom du modèle
    protected $table = 'essence';

    // Spécifie les colonnes autorisées à être massivement assignées
    protected $fillable = [
        'varieteEssence',
        'typeEssence',
        'nomLatinEssence',
        'origineEssence',
        'densiteEssence',
        'durabiliteEssence',
        'commentaireEssence',
        'photoEssence'
    ];

    //Clé primaire
    protected $primaryKey = 'idEssence';

    public $timestamps = false;
}
