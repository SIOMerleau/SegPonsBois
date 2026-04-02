<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use App\Http\Requests\AvisRequest; 

class AvisController extends Controller
{
    public function index()
    {
        return response()->json(Avis::all());
    }

    public function store(AvisRequest $request)
    {
        // On utilise $request->validated() pour ne prendre que les données sûres
        $avis = Avis::create($request->validated()); 
        
        return response()->json([
            'message' => 'Avis enregistré avec succès',
            'data' => $avis
        ], 201);
    }

    public function show($id)
    {
        $avis = Avis::find($id);
        if (!$avis) {
            return response()->json(['message' => 'Avis non trouvé'], 404);
        }
        return response()->json($avis);
    }

    public function update(AvisRequest $request, $id)
    {
        $avis = Avis::find($id);
        if (!$avis) {
            return response()->json(['message' => 'Avis non trouvé'], 404);
        }

        $avis->update($request->validated());
        
        return response()->json([
            'message' => 'Avis mis à jour',
            'data' => $avis
        ]);
    }

    public function destroy($id)
    {
        $avis = Avis::find($id);
        if (!$avis) {
            return response()->json(['message' => 'Avis non trouvé'], 404);
        }

        $avis->delete();
        return response()->json(['message' => 'Avis supprimé avec succès']);
    }
}