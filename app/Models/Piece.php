<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    use HasFactory;

    // Définir le nom de la table si ce n'est pas le pluriel du nom du modèle
    protected $table = 'piece';
    protected $primaryKey = 'idPiece';

    // Spécifie les colonnes autorisées à être massivement assignées
    protected $fillable = [
        'typePiece',
        'commentaire',
        'referencePiece',
        'prixHTPiece',
        'stockPiece',
        'exportablePiece',
        'photoPiece',
        'idEssence',
    ];

    // Optionnel : Si on souhaites désactiver les timestamps
    public $timestamps = false;

    // Relation avec la table contenir_pc
    public function contenirpc(){
        return $this->hasMany(ContenirPc::class,'piece_id', 'idPiece');
    }
    //relation avec la table paniers
    public function panier() {
    
        return $this->belongsToMany(Panier::class, 'contenir_pc', 'piece_id', 'panier_id')
        ->withPivot('quantitePc', 'prixPc')
        ->withTimestamps();
    
    }

    // Relation avec la table essence
    public function essence(){
        return $this->belongsTo(Essence::class, 'idEssence', 'idEssence');
    }
    
}
