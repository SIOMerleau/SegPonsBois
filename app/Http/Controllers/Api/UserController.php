<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {

        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create($request->all()); 
    }

    /**
     * Display the specified resource.
     */
    public function show(User $id)
    {
        return $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $id)
    {
        $id->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $id)
    {
        $id->delete();
    }
}
