<?php

namespace App\Http\Controllers;

use App\Models\Visiteur;
use Illuminate\Http\Request;

class VisiteurController extends Controller
{
    public function index()
    {
        return Visiteur::all();
    }

    public function store(Request $request)
    {
        return Visiteur::create($request->all());
    }

    public function show(Visiteur $visiteur)
    {
        return $visiteur;
    }

    public function update(Request $request, Visiteur $visiteur)
    {
        $visiteur->update($request->all());
        return $visiteur;
    }

    public function destroy(Visiteur $visiteur)
    {
        $visiteur->delete();
        return response()->json(null, 204);
    }
}

