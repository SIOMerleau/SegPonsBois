<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\Essence;
use App\Http\Controllers\Controller;


class EssenceController extends Controller
{
    
  public function index(){

        return Essence::all();
    }


  public function store(Request $request){Essence::create($request->all()); }

  
  public function show(Essence $id){
      return $id;}


  public function update(Request $request, Essence $id){$id->update($request->all());}


  public function destroy(Essence $id){$id->delete();}
}