<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index()
    {

        return Commande::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Commande::create($request->all()); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Commande $id)
    {
        return $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commande $id)
    {
        $id->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $id)
    {
        $id->delete();
    }
}
