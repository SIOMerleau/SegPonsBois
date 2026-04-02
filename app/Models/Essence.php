<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Essence extends Model
{
    protected $primaryKey = 'COL 1'; 

   
    public $incrementing = false; 
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [ 
       'varieteEssence', 
       'typeEssence', 
       'prixEssence', 
       'nomLatinEssence', 
       'descriptionEssence',
       'origineEssence', 
       'densiteEssence', 
       'durabiliteEssence', 
       'commentaireEssence',
       'photoEssence'
    ];

    protected $table = 'essence';
}
