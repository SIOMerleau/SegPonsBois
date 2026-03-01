<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visiteur extends Model
{
    use HasFactory;
    
    protected $table = 'visiteur';
    protected  $fillable = [
        'nomVisiteur',
        'prenomVisiteur',
        'telVisiteur',
        'mailVisiteur',
        'dateContact',
        'messageContact',
    ];
}
