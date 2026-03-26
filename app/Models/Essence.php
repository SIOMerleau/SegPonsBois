<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Essence extends Model
{
    protected $fillable = ['idEssence', 'varieteEssence', 'typeEssence', 'prixEssence', 'nomLatinEssence', 'descriptionEssence','origineEssence', 'densiteEssence', 'durabiliteEssence', 'commentaireEssence', 'photoEssence'];

    protected $table = 'essence';
    }
