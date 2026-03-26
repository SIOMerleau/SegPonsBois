<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EssenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Essence::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        essence::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(essence $id)
    {
        return $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, essence $id)
    {
        $id->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(essence $id)
    {
        $id->delete();
    }
}
