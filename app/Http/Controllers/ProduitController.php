<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        return Produit::with('categorie')->get();
    }

    public function store(Request $request)
    {
        return Produit::create($request->all());
    }

    public function show(Produit $produit)
    {
        return $produit->load('categorie');
    }

    public function update(Request $request, Produit $produit)
    {
        $produit->update($request->all());
        return $produit->load('categorie');
    }

    public function destroy(Produit $produit)
    {
        $produit->delete();
        return response()->json(null, 204);
    }
}
