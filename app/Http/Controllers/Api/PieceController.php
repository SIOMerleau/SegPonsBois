<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Piece;
use App\Http\Requests\PieceRequest; // On lie ta Request
use Illuminate\Http\Request;

class PieceController extends Controller
{
    public function index()
    {
        return response()->json(Piece::all(), 200);
    }

    public function store(PieceRequest $request)
    {
        // On récupère les données validées (et préparées)
        $data = $request->validated();

        // Gestion de l'image si présente (Stockage local recommandé)
        if ($request->hasFile('photoPiece')) {
            $path = $request->file('photoPiece')->store('pieces', 'public');
            $data['photoPiece'] = $path;
        }

        $piece = Piece::create($data);

        return response()->json([
            'message' => 'Pièce créée avec succès',
            'data'    => $piece
        ], 201);
    }

    
    public function update(PieceRequest $request, $id)
    {
        $piece = Piece::find($id);

        if (!$piece) {
            return response()->json(['message' => 'Pièce introuvable'], 404);
        }

        $data = $request->validated();

        // Mise à jour de l'image si un nouveau fichier est envoyé
        if ($request->hasFile('photoPiece')) {
            $path = $request->file('photoPiece')->store('pieces', 'public');
            $data['photoPiece'] = $path;
        }

        $piece->update($data);

        return response()->json([
            'message' => 'Pièce mise à jour',
            'data'    => $piece
        ], 200);
    }
    public function show($id)
    {
        $piece = Piece::find($id);

        if (!$piece) {
            return response()->json(['message' => 'Pièce introuvable'], 404);
        }

        return response()->json($piece, 200);
    }

    public function destroy($id)
    {
        $piece = Piece::find($id);

        if (!$piece) {
            return response()->json(['message' => 'Pièce introuvable'], 404);
        }

        $piece->delete();

        return response()->json(['message' => 'Pièce supprimée'], 200);
    }
}