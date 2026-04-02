<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Visiteur;
use App\Http\Requests\VisiteurRequest; // On lie ta Request
use Illuminate\Http\Request;

class VisiteurController extends Controller
{
    public function index()
    {
        return response()->json(Visiteur::all(), 200);
    }

    public function store(VisiteurRequest $request)
    {
        // On enregistre uniquement les données validées
        $visiteur = Visiteur::create($request->validated()); 

        return response()->json([
            'message' => 'Message envoyé avec succès !',
            'data'    => $visiteur
        ], 201);
    }

    public function show($id)
    {
        $visiteur = Visiteur::find($id);

        if (!$visiteur) {
            return response()->json(['message' => 'Visiteur introuvable'], 404);
        }

        return response()->json($visiteur, 200);
    }

    public function update(VisiteurRequest $request, $id)
    {
        $visiteur = Visiteur::find($id);

        if (!$visiteur) {
            return response()->json(['message' => 'Visiteur introuvable'], 404);
        }

        $visiteur->update($request->validated());

        return response()->json([
            'message' => 'Informations visiteur mises à jour',
            'data'    => $visiteur
        ], 200);
    }

    public function destroy($id)
    {
        $visiteur = Visiteur::find($id);

        if (!$visiteur) {
            return response()->json(['message' => 'Visiteur introuvable'], 404);
        }

        $visiteur->delete();

        return response()->json(['message' => 'Visiteur supprimé'], 200);
    }
}