<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    protected $fillable = [
        'nomClient',
        'prenomClient',
        'noteAvis',
        'commentaireAvis',
    ];

    protected $table = 'avis_1';
}
