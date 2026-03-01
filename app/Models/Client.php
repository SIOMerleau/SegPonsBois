<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

use Illuminate\Database\Eloquent\Model;

class Client extends Model implements AuthenticatableContract
{
    use Authenticatable;
    protected $table = 'client';
    protected $fillable = [
        'nomClient',
        'prenomClient',
        'telClient',
        'mailClient',
        'adRueClient',
        'adCPClient',
        'adVilleClient',
        'mdpClient',
    ];

    protected $hidden = [
        'mdpClient',
    ];

    // Méthode pour récupérer le mot de passe
    public function getAuthPassword(){
        return $this->mdpClient;
    }
}
