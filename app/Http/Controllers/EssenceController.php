<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Essence;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class EssenceController extends Controller
{
    //Afficher la liste des essences dans la boutique
    public function index(Request $request){   
    // Récupérer les valeurs des filtres
    $durabilite = $request->input('durabiliteEssence');
    $typeEssence = $request->input('typeEssence');

    // Appliquer les filtres si des valeurs sont spécifiées
    $essence = Essence::query()
        ->when($durabilite, function ($query, $durabilite) {
            return $query->where('durabiliteEssence', $durabilite);
        })
        ->when($typeEssence, function ($query, $typeEssence) {
            return $query->where('typeEssence', $typeEssence);
        })
        ->get();
    // Retourner la vue avec les essences filtrées
    return view('essence.boutique', compact('essence'));
    }

    public function index_dashboard(){
        //Afficher la liste des essences dans le tableau du dashboard
        $essences = Essence::all();
        return view('admin.essence.index', compact('essences'));
    }

    //Créer une nouvelle essence dans la base de données
    public function store(Request $request){
        try{
            //Validation des données
            $validateData = $request->validate([
                'varieteEssence' => 'required|string|max:255',  
                'typeEssence' => 'nullable|string|max:15',
                'customTypeEssence' => 'nullable|string|max:15',
                'nomLatinEssence' => 'required|string|max:30',
                'origineEssence' => 'nullable|string|max:20',
                'customOrigineEssence' => 'nullable|string|max:20',
                'densiteEssence' => 'nullable|string|max:15',
                'photoEssence' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'durabiliteEssence' => 'nullable|string|max:15',
                'customDurabiliteEssence' => 'nullable|string|max:15',
                'commentaireEssence' => 'required|string|max:255',
            ]);

            if($request->file('photoEssence')){
                //Récupération de l'image
                $image = $request->file('photoEssence');
                $imageBLOB = file_get_contents($image->getRealPath());
            }else{
                //Si il n'y a pas de photo
                $imageBLOB = "";
            }

            //Si le type d'essence est personnalisé
            if($validateData['typeEssence'] == 'custom'){
                $typeEssence = $validateData['customTypeEssence'];
            }else{
                $typeEssence = $validateData['typeEssence'];
            }
            //Si l'origine de l'essence est personnalisée
            if($validateData['origineEssence'] == 'custom'){
                $origineEssence = $validateData['customOrigineEssence'];
            }else{
                $origineEssence = $validateData['origineEssence'];
            }
            //Si la durabilité de l'essence est personnalisée
            if($validateData['durabiliteEssence'] == 'custom'){
                $durabiliteEssence = $validateData['customDurabiliteEssence'];
            }else{
                $durabiliteEssence = $validateData['durabiliteEssence'];
            }

            //Création de l'essence dans la base de données
            $essence = new Essence();
            $essence->varieteEssence = $validateData['varieteEssence'];
            $essence->typeEssence = $typeEssence;
            $essence->nomLatinEssence = $validateData['nomLatinEssence'];
            $essence->origineEssence = $origineEssence;
            $essence->densiteEssence = $validateData['densiteEssence'];
            if($imageBLOB){//Si une image a été uploadée
                $essence->photoEssence = $imageBLOB;
            }
            $essence->durabiliteEssence = $durabiliteEssence;
            $essence->commentaireEssence = $validateData['commentaireEssence'];
            $essence->save();
            //Log
            Log::info('Essence créer : id = ' .$essence->idEssence . ' - varieteEssence = ' . $essence->varieteEssence . 
                ' - typeEssence = '  . $essence->typeEssence .
                ' - nomLatinEssence = '  . $essence->nomLatinEssence .
                ' - origineEssence = '  . $essence->origineEssence .
                ' - densiteEssence = '  . $essence->densiteEssence .
                ' - durabiliteEssence =  ' . $essence->durabiliteEssence .
                ' - commentaireEssence = '  . $essence->commentaireEssence .
            ' par ' . Auth::user()->name . '-'. Auth::user()->id);

            //Rediriger vers la page de gestion des essences
            return redirect()->route('admin.essence.index')->with('success', 'Essence créée avec succès.');
        } catch(\Exception $e){
            //Log
            Log::error('Erreur lors de la création de l\'essence : ' . $essence->varieteEssence . ' par ' . Auth::user()->name . ' - Erreur : ' . $e->getMessage());
            //Rediriger vers la page de gestion des essences avec un message d'erreur
            return redirect()->route('admin.essence.index')->with('error', 'Erreur lors de la création de l\'essence: ' . $e->getMessage());
        }
    }

    
    public function show($id)
{
    $essence = Essence::findOrFail($id);

    // Convertir le BLOB en base64
    $essence->photoEssence = base64_encode($essence->photoEssence);

    return view('essence.boutique', compact('essence'));
}

    //Modifier une essence dans la base de données
    public function update(Request $request)
    {
        try{
            //Validation des données
            $validateData = $request->validate([
                'idEssence' => 'required|integer',
                'varieteEssence' => 'required|string|max:255',
                'typeEssence' => 'nullable|string|max:15',
                'customTypeEssence' => 'nullable|string|max:15',
                'nomLatinEssence' => 'required|string|max:30',
                'origineEssence' => 'nullable|string|max:20',
                'customOrigineEssence' => 'nullable|string|max:20',
                'densiteEssence' => 'nullable|string|max:15',
                'photoEssence' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'durabiliteEssence' => 'nullable|string|max:15',
                'customDurabiliteEssence' => 'nullable|string|max:15',
                'commentaireEssence' => 'required|string|max:255',
            ]);

            if($request->file('photoEssence')){
                //Récupération de l'image
                $image = $request->file('photoEssence');
                $imageBLOB = file_get_contents($image->getRealPath());
            }else{
                //Si il n'y a pas de photo
                $imageBLOB = "";
            }

            //Si le type d'essence est personnalisé
            if($validateData['typeEssence'] == 'custom'){
                $typeEssence = $validateData['customTypeEssence'];
            }else{
                $typeEssence = $validateData['typeEssence'];
            }
            //Si l'origine de l'essence est personnalisée
            if($validateData['origineEssence'] == 'custom'){
                $origineEssence = $validateData['customOrigineEssence'];
            }else{
                $origineEssence = $validateData['origineEssence'];
            }
            //Si la durabilité de l'essence est personnalisée
            if($validateData['durabiliteEssence'] == 'custom'){
                $durabiliteEssence = $validateData['customDurabiliteEssence'];
            }else{
                $durabiliteEssence = $validateData['durabiliteEssence'];
            }

            //Sauvegarde de l'ancienne essence pour les logs
            $old_essence = Essence::findOrFail($validateData['idEssence']);
            //Mise à jour de l'essence dans la base de données
            $essence = Essence::findOrFail($validateData['idEssence']);
            $essence->varieteEssence = $validateData['varieteEssence'];
            $essence->typeEssence = $typeEssence;
            $essence->nomLatinEssence = $validateData['nomLatinEssence'];
            $essence->origineEssence = $origineEssence;
            $essence->densiteEssence = $validateData['densiteEssence'];
            if($imageBLOB){//Si une image a été uploadée
                $essence->photoEssence = $imageBLOB;
            }
            $essence->durabiliteEssence = $durabiliteEssence;
            $essence->commentaireEssence = $validateData['commentaireEssence'];
            $essence->save();
            //Log
            Log::info('Essence modifiée : id = ' .$validateData['idEssence'] . ' - varieteEssence = ' . $old_essence->varieteEssence . ' -> ' . $essence->varieteEssence . 
                ' - typeEssence = ' . $old_essence->typeEssence . ' -> ' . $essence->typeEssence .
                ' - nomLatinEssence = ' . $old_essence->nomLatinEssence . ' -> ' . $essence->nomLatinEssence .
                ' - origineEssence = ' . $old_essence->origineEssence . ' -> ' . $essence->origineEssence .
                ' - densiteEssence = ' . $old_essence->densiteEssence . ' -> ' . $essence->densiteEssence .
                ' - durabiliteEssence = ' . $old_essence->durabiliteEssence . ' -> ' . $essence->durabiliteEssence .
                ' - commentaireEssence = ' . $old_essence->commentaireEssence . ' -> ' . $essence->commentaireEssence .
            ' par ' . Auth::user()->name . '-'. Auth::user()->id);

            //Rediriger vers la page de gestion des essences
            return redirect()->route('admin.essence.index')->with('success', 'Essence modifiée avec succès.');
        } catch(\Exception $e){
            //Log
            Log::error('Erreur lors de la modification de l\'essence : ' . $validateData['idEssence'] . ' - ' . $essence->varieteEssence . ' par ' . Auth::user()->name . ' - Erreur : ' . $e->getMessage());
            //Rediriger vers la page de gestion des essences avec un message d'erreur
            return redirect()->route('admin.essence.index')->with('error', 'Erreur lors de la modification de l\'essence: ' . $e->getMessage());
        }
    }

    //Supprimer une essence de la base de données
    public function destroy(string $id)
    {
        try{
            //Suppression du produit dans la base de données
            $essence = Essence::findOrFail($id);
            $essence->delete();
            //Log
            Log::info('Essence supprimée : ' . $essence->varieteEssence . ' - ' . $id . ' par ' . Auth::user()->name . '-'. Auth::user()->id);
            //Redirection vers la liste des essences avec un message de succès
            return redirect()->route('admin.essence.index')->with('success', 'Produit supprimé avec succès.');
        }
        catch(\Exception $e){
            //Log
            Log::error('Erreur lors de la suppression de l\'essence : ' . $id . ' par ' . Auth::user()->name . '-'. Auth::user()->id . ' - Erreur : ' . $e->getMessage());
            //Redirection vers la liste des essences avec un message d'erreur
            return redirect()->route('admin.essence.index')->with('error', 'Erreur lors de la suppression du produit.');
        }
    }
}
