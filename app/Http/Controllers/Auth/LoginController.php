<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    //Afficher le formulaire de connexion
    public function index()
    {
        //Retourne la vue de connexion
        return view ('client.connexion');
    }

    //Connexion
    public function login(Request $request){
        
        $credentials = $request->only('email', 'password');
        //Verification des informations de connexion
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            //Si l'utilisateur est un administrateur
            if(Auth::user()->is_admin){
                //Log
                Log::info('Connexion de l\'administrateur : [ '. Auth::user()->id .' ]');
                //Retourne à la page dashboard
                return redirect()->route('admin.dashboard');
            }else{
                //Log
                Log::info('Connexion de l\'utilisateur : ' . Auth::user()->email . ' [ '. Auth::user()->id .' ]');
                //Retourne à la page d'accueil
                return redirect()->intended('/');
            }
        }
        //Retourne un message d'erreur si les informations de connexion sont incorrectes
        return back()->withErrors([
            //Log
            Log::warning('Erreur de connexion pour le compte ' . $request->email),
            'email' => 'Erreur d\'email ou de mot de passe',
        ]);
    }
}
