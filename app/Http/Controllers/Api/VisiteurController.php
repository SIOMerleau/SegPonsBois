<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Visiteur;
use Illuminate\Http\Request;

class VisiteurController extends Controller
{
    public function index()
    {

        return Visiteur::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Visiteur::create($request->all()); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Visiteur $id)
    {
        return $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visiteur $id)
    {
        $id->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visiteur $id)
    {
        $id->delete();
    }
}
