<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Http\Requests\ProduitRequest; // Import de ta Request
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    public function index()
    {
        // On peut charger la catégorie en même temps pour l'API
        return response()->json(Produit::with('categorie')->get(), 200);
    }

    public function store(ProduitRequest $request)
    {
        $data = $request->validated();

        // Gestion de l'image
        if ($request->hasFile('photoProduit')) {
            $path = $request->file('photoProduit')->store('produits', 'public');
            $data['photoProduit'] = $path;
        }

        $produit = Produit::create($data);

        return response()->json([
            'message' => 'Produit créé avec succès',
            'data'    => $produit
        ], 201);
    }

    public function show($id)
    {
        $produit = Produit::find($id);

        if (!$produit) {
            return response()->json(['message' => 'Produit introuvable'], 404);
        }

        return response()->json($produit, 200);
    }

    public function update(ProduitRequest $request, $id)
    {
        $produit = Produit::find($id);

        if (!$produit) {
            return response()->json(['message' => 'Produit introuvable'], 404);
        }

        $data = $request->validated();

        // Si une nouvelle photo est envoyée
        if ($request->hasFile('photoProduit')) {
            // Optionnel : supprimer l'ancienne photo du disque
            if ($produit->photoProduit) {
                Storage::disk('public')->delete($produit->photoProduit);
            }
            
            $path = $request->file('photoProduit')->store('produits', 'public');
            $data['photoProduit'] = $path;
        }

        $produit->update($data);

        return response()->json([
            'message' => 'Produit mis à jour',
            'data'    => $produit
        ], 200);
    }

    public function destroy($id)
    {
        $produit = Produit::find($id);

        if (!$produit) {
            return response()->json(['message' => 'Produit introuvable'], 404);
        }

        // Suppression de l'image associée avant de supprimer le produit
        if ($produit->photoProduit) {
            Storage::disk('public')->delete($produit->photoProduit);
        }

        $produit->delete();

        return response()->json(['message' => 'Produit supprimé'], 200);
    }
}