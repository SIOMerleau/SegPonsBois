<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContenirOffre extends Model
{
    use HasFactory;

    // Définir le nom de la table
    protected $table = 'contenir_offre';

    // Colonnes autorisées à être massivement assignées
    protected $fillable = [
        'quantiteOffre',
        'prixOffre',
        'panier_id',
        'offre_id',
    ];

    // Relation avec le modèle Offre
    public function offre()
    {
        return $this->belongsTo(Offre::class, 'offre_id', 'idOffre');
    }

    // Relation avec le modèle Panier
    public function panier()
    {
        return $this->belongsTo(Panier::class, 'panier_id', 'idPanier');
    }
}
