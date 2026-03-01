<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogoutController extends Controller
{
    //Déconnexion
    public function destroy(Request $request)
    {
        //Log
        Log::info('Déconnexion de l\'utilisateur : ' . Auth::user()->email . ' [ '. Auth::user()->id .' ]');

        Auth::logout();
        //Invalider la session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        //Retourne à la page d'accueil
        return redirect('/');
    }
}
