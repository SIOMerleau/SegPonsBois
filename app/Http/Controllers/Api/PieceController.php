<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Piece;
use Illuminate\Http\Request;

class PieceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Piece::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Piece::create($request->all()); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Piece $id)
    {
        return $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Piece $id)
    {
        $id->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Piece $id)
    {
        $id->delete();
    }
}
