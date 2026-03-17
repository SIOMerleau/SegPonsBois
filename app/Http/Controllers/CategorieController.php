<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CategorieController extends Controller
{
    //Renvoyer la vue avec la liste des catégories
    public function index(){
        //Récupération de la liste des catégories
        $categories = Categorie::all();
        //Renvoyer la vue avec la liste des catégories
        return view('admin.categorie.index')->with('categories', $categories);
    }

    public function create(Request $request){
        try{
            //Validation des données
            $request->validate([
                'libelleCategorie' => 'required|string|max:255'
            ]);
            //Création de la catégorie dans la base de données
            $categorie = Categorie::create([
                'libelleCategorie' => $request->libelleCategorie
            ]);
            //Log
            Log::info('Catégorie ajoutée : ' . $request->libelleCategorie . ' par ' . Auth::user()->name . '-'. Auth::user()->id);
            //Redirection vers la liste des catégories avec un message de succès
            return redirect()->route('admin.categorie.index')->with('success', 'Catégorie ajoutée avec succès.');
        } 
        catch(\Exception $e){
            //Log
            Log::error('Erreur lors de l\'ajout de la catégorie : ' . $request->libelleCategorie . ' par ' . Auth::user()->name . '-'. Auth::user()->id . ' - Erreur : ' . $e->getMessage());
            //Redirection vers la liste des catégories avec un message d'erreur
            return redirect()->route('admin.categorie.index')->with('error', 'Erreur lors de l\'ajout de la catégorie.');
        }
    }

    public function update(Request $request){

        try{
            //Validation des données
            $validatedData = $request->validate([
                'idCategorie' => 'required|integer',
                'libelleCategorie' => 'required|string|max:255'
            ]);
            //Modification de la catégorie dans la base de données
            $categorie = Categorie::findOrFail($validatedData['idCategorie']);
            //Sauvegarde de l'ancien libellé pour le log
            $old_libelleCategorie = $categorie->libelleCategorie;
            $categorie->libelleCategorie = $validatedData['libelleCategorie'];
            $categorie->save();
            //Log
            Log::info('Catégorie modifiée : id = ' .$validatedData['idCategorie'] . ' - libelleCategorie = ' . $old_libelleCategorie . ' -> ' . $categorie->libelleCategorie .' par ' . Auth::user()->name . '-'. Auth::user()->id);
            //Redirection vers la liste des catégories avec un message de succès
            return redirect()->route('admin.categorie.index')->with('success', 'Catégorie modifiée avec succès.');
        }
        catch(\Exception $e){
            //Log
            Log::error('Erreur lors de la suppression de la catégorie : ' . $validatedData['idCategorie'] . ' par ' . Auth::user()->name . ' - Erreur : ' . $e->getMessage());
            //Redirection vers la liste des catégories avec un message d'erreur
            return redirect()->route('admin.categorie.index')->with('error', 'Erreur lors de la modification de la catégorie.');
        }
        
    }

    public function destroy($idCategorie){
        try {
            //Suppression de la catégorie dans la base de données
            $categorie = Categorie::findOrFail($idCategorie);
            $categorie->delete();
            //Log
            Log::info('Catégorie supprimée : ' . $categorie->libelleCategorie . ' - ' . $idCategorie . ' par ' . Auth::user()->name . '-'. Auth::user()->id);
            //Redirection vers la liste des catégories avec un message de succès
            return redirect()->route('admin.categorie.index')->with('success', 'Catégorie supprimée avec succès.');
        } catch (\Exception $e) {
            //Log
            Log::error('Erreur lors de la suppression de la catégorie : ' . $idCategorie . ' par ' . Auth::user()->name . '-'. Auth::user()->id . ' - Erreur : ' . $e->getMessage());
            //Redirection vers la liste des catégories avec un message d'erreur
            return redirect()->route('admin.categorie.index')->with('error', 'Erreur lors de la suppression de la catégorie.');
        }
        
    }
}
