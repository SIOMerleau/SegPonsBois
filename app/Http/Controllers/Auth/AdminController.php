<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Visiteur;
use App\Models\Commande;
use Illuminate\Support\Facades\Log;
class AdminController extends Controller
{
    //Afficher le tableau de bord de l'administrateur
    public function index()
    {
        $user = auth()->user();
        //Verification si l'utilisateur est un administrateur
        if(!$user->is_admin){
            return redirect()->route('user.login');
        }
        //Retourne le dashboard si l'utilisateur est un administrateur
        return view ('admin.dashboard');
    }

    //Fonction pour supprimer un message de contact
    public function destroyMessage(Request $request){
        
        $user = auth()->user();
        //Verification si l'utilisateur est un administrateur
        if(!$user->is_admin){
            return redirect()->route('user.login');
        }
        //Suppression du message
        $message = Visiteur::where('idVisiteur', $request->id)->delete();
        Log::info('Message supprimé avec succès idVisiteur = [ '. $request->id .' ]');
        //Retourne le dashboard avec un message de succès
        return redirect()->route('admin.dashboard')->with('success', 'Message supprimé avec succès');
    }

    public function commandes() { 
        //Recuperation de toutes les commandes avec une relation client
        $commandes = Commande::with('client')->get(); 
        //Retourne la vue des commandes
        return view('admin.commandes', compact('commandes')); 
    }
}
