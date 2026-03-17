<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visiteur extends Model
{
    protected $primaryKey = 'idVisiteur';
    protected $fillable = [
        'nomVisiteur', 'prenomVisiteur', 'telVisiteur', 'mailVisiteur', 'dateContact', 'messageContact'
    ];
}

