<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{

    public function index(){
        //Récupération de l'utilisateur connecté
        $user = auth()->user();

        //Verification si l'utilisateur est connecté
        if(!$user){
            //Retourne à la page de connexion
            return redirect()->route('user.login');
        }
        //Retourne à la page du tableau de bord de l'utilisateur
        return view('client.dashboard');
    }


    //Modification des informations de l'utilisateur
    public function update(Request $request){
        //Recuperation de l'utilisateur connecté
        $user = auth()->user();
        //Verification si l'utilisateur est connecté
        if(!$user){
            //Retourne à la page de connexion
            return redirect()->route('user.login');
        }
    
        //Validation des données
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'telephone' => $request->telephone,
            'code_postal' => $request->code_postal,
            'ville' => $request->ville,
            'adresse' => $request->adresse,
        ]);
        //Log
        Log::info('Profil Utilisateur modifié : '. $user->id);
        //Retourne à la page du tableau de bord de l'utilisateur
        return redirect()->route('user.dashboard');
    }
}
