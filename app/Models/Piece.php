<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    protected $fillable = [
        'nomPiece',
        'descriptionPiece',
        'prixPiece',
    ];

    protected $table = 'piece';
}
