<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContenirPc extends Model
{
    use HasFactory;

    protected $table = 'contenir_pc';

    protected $fillable = [
        'quantitePc',
        'prixPc',
        'panier_id',
        'piece_id',
    ];

    //Relation avec Panier
    public function panier(){
        return $this->belongsTo(Panier::class, 'idPanier', 'idPanier');
      }

      //Relation avec Piece
    public function pieces()
    {
        return $this->belongsTo(Piece::class, 'piece_id', 'idPiece');
    }
}