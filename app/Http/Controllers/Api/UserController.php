<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest; // On importe ta Request
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();

        // Sécurité : On hache le mot de passe avant l'enregistrement
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user = User::create($data);

        return response()->json([
            'message' => 'Utilisateur créé avec succès',
            'data'    => $user
        ], 201);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Utilisateur introuvable'], 404);
        }

        return response()->json($user, 200);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Utilisateur introuvable'], 404);
        }

        $data = $request->validated();

        // Si un nouveau mot de passe est fourni, on le hache
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            // Sinon on retire le champ pour ne pas écraser le mot de passe actuel par du vide
            unset($data['password']);
        }

        $user->update($data);

        return response()->json([
            'message' => 'Profil mis à jour',
            'data'    => $user
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Utilisateur introuvable'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Compte supprimé'], 200);
    }
}