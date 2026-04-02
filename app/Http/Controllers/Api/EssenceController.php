<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Essence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class EssenceController extends Controller
{
    public function index()
    {
        return response()->json(Essence::all());
    }

    public function store(Request $request)
    {
        try {
            // 1. Gestion de l'image (BLOB)
            $imageBLOB = null;
            if ($request->hasFile('photoEssence')) {
                $image = $request->file('photoEssence');
                $imageBLOB = file_get_contents($image->getRealPath());
            }

            // 2. Traitement des champs "custom"
            $typeEssence = ($request->typeEssence === 'custom') 
                ? $request->customTypeEssence 
                : $request->typeEssence;

            $origineEssence = ($request->origineEssence === 'custom') 
                ? $request->customOrigineEssence 
                : $request->origineEssence;

            $durabiliteEssence = ($request->durabiliteEssence === 'custom') 
                ? $request->customDurabiliteEssence 
                : $request->durabiliteEssence;

            // 3. Création et remplissage de l'objet
            $essence = new Essence();
            $essence->varieteEssence = $request->varieteEssence;
            $essence->typeEssence = $typeEssence;
            $essence->nomLatinEssence = $request->nomLatinEssence;
            $essence->origineEssence = $origineEssence;
            $essence->densiteEssence = $request->densiteEssence;
            $essence->durabiliteEssence = $durabiliteEssence;
            $essence->commentaireEssence = $request->commentaireEssence;
            
            if ($imageBLOB) {
                $essence->photoEssence = $imageBLOB;
            }
            
            $essence->save();

            // 4. Log de succès
            Log::info("Essence créée : ID {$essence->id} par " . Auth::user()->name);

            return response()->json(['message' => 'Essence créée avec succès', 'data' => $essence], 201);

        } catch (\Exception $e) {
            Log::error("Erreur création Essence : " . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la création', 'details' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $essence = Essence::find($id);
        if (!$essence) return response()->json(['message' => 'Non trouvé'], 404);
        return response()->json($essence);
    }

    public function update(Request $request, $id)
    {
        $essence = Essence::find($id);
        if (!$essence) return response()->json(['message' => 'Non trouvé'], 404);

        // Ici tu peux réutiliser la logique du store pour les champs customs si nécessaire
        $essence->update($request->all());
        return response()->json($essence);
    }

    public function destroy($id)
    {
        $essence = Essence::find($id);
        if ($essence) {
            $essence->delete();
            return response()->json(['message' => 'Supprimé']);
        }
        return response()->json(['message' => 'Non trouvé'], 404);
    }
}