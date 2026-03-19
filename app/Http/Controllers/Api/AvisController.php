<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    public function index()
    {

        return Avis::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Avis::create($request->all()); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Avis $id)
    {
        return $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Avis $id)
    {
        $id->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Avis $id)
    {
        $id->delete();
    }
}
