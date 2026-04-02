<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Panier;
use App\Http\Requests\PanierRequest; 

class PanierController extends Controller
{
    public function index()
    {
        // Retourne tous les paniers (souvent filtré par client dans la vraie vie)
        return response()->json(Panier::all(), 200);
    }

   public function store(PanierRequest $request)
    {
        // On récupère TOUTES les données (idClient, datePanier, idProduit, etc.)
        // qui ont été validées et préparées dans la Request.
        $panier = Panier::create($request->validated());

        return response()->json([
            'status'  => 'success',
            'message' => 'Produit ajouté au panier',
            'data'    => $panier
        ], 201);
    }

    public function show($id)
    {
        $panier = Panier::find($id);

        if (!$panier) {
            return response()->json(['message' => 'Panier introuvable'], 404);
        }

        return response()->json($panier, 200);
    }

    public function update(PanierRequest $request, $id)
    {
        $panier = Panier::find($id);
        
        if (!$panier) {
            return response()->json(['message' => 'Panier introuvable'], 404);
        }

        $panier->update($request->validated());

        return response()->json([
            'message' => 'Panier mis à jour',
            'data'    => $panier
        ]);
    }

    public function destroy($id)
    {
        $panier = Panier::find($id);

        if (!$panier) {
            return response()->json(['message' => 'Panier introuvable'], 404);
        }

        $panier->delete();

        return response()->json(['message' => 'Produit retiré du panier'], 200);
    }
}