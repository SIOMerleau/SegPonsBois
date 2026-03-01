<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commandes';
    protected $primaryKey = 'idCommande'; //Clé primaire

    protected $fillable = [
        'idClient', 
        'total_price', 
        'status'
    ];

    // Relation avec User (Client)
    public function client()
    {
        return $this->belongsTo(User::class, 'idClient');
    }

    // Relation avec Produit
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produit', 'idCommande', 'idProduit')
                    ->withPivot('quantitePr', 'prixPr');
    }

    // Relation avec Piece
    public function pieces()
    {
        return $this->belongsToMany(Piece::class, 'commande_piece', 'idCommande', 'idPiece')
                    ->withPivot('quantitePc', 'prixPc');
    }

    // Relation avec Offre
    public function offres()
    {
        return $this->belongsToMany(Offre::class, 'commande_offre', 'idCommande', 'idOffre')
                    ->withPivot('quantiteOf', 'prixOffre');
    }
}
