<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {

        return Categorie::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Categorie::create($request->all()); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $id)
    {
        return $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $id)
    {
        $id->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $id)
    {
        $id->delete();
    }
}
