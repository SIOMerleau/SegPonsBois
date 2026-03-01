<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{

    //Afficher le formulaire d'inscription
    public function create()
    {
        return view('client.inscription');
    }

    //Insertion de l'utilisateur dans la bdd et connexion
    public function store(Request $request)
    {
        //Validation des données
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        // Vérification que l'email est un email valable comportant un arobaze et un nom de domaine d'un service mail
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return back()->withErrors(['email' => 'L\'adresse email n\'est pas valide.']);
        }
        // Vérification que le mot de passe comporte bien 8 caractères, minuscule et majuscule, au moins 1 chiffre et au moins 1 caractère spécial
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $request->password)) {
            return back()->withErrors(['password' => 'Le mot de passe doit comporter au moins 8 caractères, une minuscule, une majuscule, un chiffre et un caractère spécial.']);
        }

        //Insertion dans la bdd
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        Log::info('Inscription de l\'utilisateur : ' . $user->email . ' [ '. $user->id .' ]');

        //Connexion de l'utilisateur
        Auth::login($user);
        Log::info('Connexion de l\'utilisateur : ' . $user->email . ' [ '. $user->id .' ]');
        //Retourne à la page d'accueil
        return redirect('/');
    }

}
