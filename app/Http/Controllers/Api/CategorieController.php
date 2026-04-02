<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Http\Requests\CategorieRequest;

class CategorieController extends Controller
{
    public function index()
    {
        return response()->json(Categorie::all(), 200);
    }

    public function store(CategorieRequest $request)
    {
        // Utilise uniquement les données validées
        $categorie = Categorie::create($request->validated()); 
        
        return response()->json([
            'message' => 'Catégorie créée avec succès',
            'data'    => $categorie
        ], 201);
    }

    public function show($id)
    {
        $categorie = Categorie::find($id);

        if (!$categorie) {
            return response()->json(['message' => 'Catégorie introuvable'], 404);
        }

        return response()->json($categorie, 200);
    }

    public function update(CategorieRequest $request, $id)
    {
        $categorie = Categorie::find($id);

        if (!$categorie) {
            return response()->json(['message' => 'Catégorie introuvable'], 404);
        }

        $categorie->update($request->validated());

        return response()->json([
            'message' => 'Catégorie mise à jour',
            'data'    => $categorie
        ], 200);
    }

    public function destroy($id)
    {
        $categorie = Categorie::find($id);

        if (!$categorie) {
            return response()->json(['message' => 'Catégorie introuvable'], 404);
        }

        $categorie->delete();

        return response()->json(['message' => 'Catégorie supprimée avec succès'], 200);
    }
}