<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visiteur extends Model
{
    protected $fillable = [
        'nomVisiteur',
        'prenomVisiteur',
        'emailVisiteur',
        'motDePasseVisiteur',
    ];

    protected $table = 'visiteur';
}
