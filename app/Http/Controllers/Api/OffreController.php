<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offre;
use App\Http\Requests\OffreRequest; // On importe ta Request
use Illuminate\Http\Request;

class OffreController extends Controller
{
    public function index()
    {
        // On retourne tout en JSON
        return response()->json(Offre::all(), 200);
    }

    public function store(OffreRequest $request)
    {
        // On crée l'offre avec les données validées
        $offre = Offre::create($request->validated()); 
        
        return response()->json([
            'message' => 'Offre créée avec succès !',
            'data'    => $offre
        ], 201);
    }

    public function show($id)
    {
        $offre = Offre::find($id);

        if (!$offre) {
            return response()->json(['message' => 'Offre introuvable'], 404);
        }

        return response()->json($offre, 200);
    }

    public function update(OffreRequest $request, $id)
    {
        $offre = Offre::find($id);

        if (!$offre) {
            return response()->json(['message' => 'Offre introuvable'], 404);
        }

        $offre->update($request->validated());

        return response()->json([
            'message' => 'Offre mise à jour',
            'data'    => $offre
        ], 200);
    }

    public function destroy($id)
    {
        $offre = Offre::find($id);

        if (!$offre) {
            return response()->json(['message' => 'Offre introuvable'], 404);
        }

        $offre->delete();

        return response()->json(['message' => 'Offre supprimée'], 200);
    }
}