<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisiteurRequest;
use App\Models\Visiteur;
use Illuminate\Support\Facades\Log;

class VisiteurController extends Controller
{
    //
    public function create() {
        // On retourne la vue contact
        return view('contact');
    }

    public function store(VisiteurRequest $request) {

        try{
        // Les données validées sont disponibles via $request->validated()
        $validatedData = $request->validated();
        //Ajout de la date du moment du contact
        $validatedData['dateContact'] = date('Y-m-d');

        // On crée un visiteur avec les données validées
        $visiteur = Visiteur::create($validatedData);

        //Log
        Log::info('Message contact envoyé par : '. $visiteur->nomVisiteur);
        // On redirige vers la page de contact avec un message de succès
        return redirect()->route('contact.create')->with('success', 'Message envoyé avec succès.');
        } catch (\Exception $e) {
            //Log
            Log::error('Erreur lors de l\'envoi du message de '. $request->nomVisiteur .': ' . $e->getMessage());
            // On redirige vers la page de contact avec un message d'erreur
            return redirect()->route('contact.create')->with('error', 'Une erreur est survenue lors de l\'envoi du message.');
        }
    }
}
