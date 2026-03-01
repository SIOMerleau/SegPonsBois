<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;

    protected $primaryKey = 'idOffre'; //Clé primaire

    protected $fillable = [
        'nomOffre', 
        'date_debut', 
        'date_fin'
    ];

    //Relation avec Concerner
    public function concerner()
    {
        return $this->hasOne(Concerner::class, 'idOffre', 'idOffre');
    }
}
