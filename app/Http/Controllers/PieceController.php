<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Piece;
use App\Models\Essence;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PieceController extends Controller
{

    //Renvoyer les pièces vers la boutique
    public function index()
    {
        $pieces = Piece::all();
        $pieces = Piece::with('essence')->get();

        $essences = Essence::all();
        return view('piece.boutique', compact('pieces', 'essences'));
    }

    //Renvoyer les pièces vers le dashboard admin
    public function index_dashboard(){
        $pieces = Piece::all();
        $pieces = Piece::with('essence')->get();

        $essences = Essence::all();
        return view('admin.piece.index', compact('pieces', 'essences'));
    }

    public function store(Request $request){
        try{
        //Validation des données
        $request->validate([
            'idEssence' => 'required|integer',
            'typePiece' => 'required|string|max:15',
            'photoPiece' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'prixHTPiece' => 'required|numeric',
            'stockPiece' => 'required|integer',
            'commentaire' => 'required|string|max:255',
            'referencePiece' => 'required|string|max:255',
            'exportablePiece' => 'required|integer',
        ]);

        if($request->file('photoPiece')){
            //Récupération de l'image
            $image = $request->file('photoPiece');
            $imageBLOB = file_get_contents($image->getRealPath());
        }else{
            //Si il n'y a pas de photo
            $imageBLOB = "";
        }

        //Création de la pièce dans la base de données
        $piece = new Piece();
        $piece->idEssence = $request->idEssence;
        $piece->typePiece = $request->typePiece;
        if($imageBLOB){//Si une image a été uploadée
            $piece->photoPiece = $imageBLOB;
        }
        $piece->prixHTPiece = $request->prixHTPiece;
        $piece->stockPiece = $request->stockPiece;
        $piece->commentaire = $request->commentaire;
        $piece->referencePiece = $request->referencePiece;
        $piece->exportablePiece = $request->exportablePiece;
        $piece->save();
        //Log
        Log::info('Piece créer : id = ' .$piece->idPiece . ' - varieteEssence = ' . $piece->essence->varieteEssence . 
                ' - typePiece = '  . $piece->typePiece .
                ' - commentaire = '  . $piece->commentaire .
                ' - referencePiece = '  . $piece->referencePiece .
                ' - prixHTPiece = '  . $piece->prixHTPiece .
                ' - stockPiece = '  . $piece->stockPiece .
                ' - exportablePiece = '  . $piece->exportablePiece .
            ' par ' . Auth::user()->name . '-'. Auth::user()->id);

        //Redirection vers la page de la boutique
        return redirect()->route('admin.piece.index')->with('success', 'La pièce a été ajoutée avec succès');
    }catch(\Exception $e){
        //Log
        Log::error('Erreur lors de la création de la pièce : ' . $piece->typePiece . ' par ' . Auth::user()->name . ' - Erreur : ' . $e->getMessage());
        //Redirection vers la page de la boutique avec un message d'erreur
        return redirect()->route('admin.piece.index')->with('error', 'Erreur lors de l\'ajout de la pièce: ' . $e->getMessage());
    }
}


    public function show( $idPiece)
    {
        $piece = Piece::where('idPiece', $idPiece)->firstOrFail(); 
        $photoBase64 = base64_encode($piece->photoPiece);
        return view('piece.detail', compact('piece', 'photoBase64'));    
    }


    //Modifier une pièce dans la base de données
    public function update(Request $request){
        //
        try{
            //Validation des données
            $request->validate([
                'idPiece' => 'required|integer',
                'idEssence' => 'required|integer',
                'typePiece' => 'required|string|max:15',
                'photoPiece' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'prixHTPiece' => 'required|numeric',
                'stockPiece' => 'required|integer',
                'commentaire' => 'required|string|max:255',
                'referencePiece' => 'required|string|max:255',
                'exportablePiece' => 'required|integer',
            ]);
    
            if($request->file('photoPiece')){
                //Récupération de l'image
                $image = $request->file('photoPiece');
                $imageBLOB = file_get_contents($image->getRealPath());
            }else{
                //Si il n'y a pas de photo
                $imageBLOB = "";
            }
            //Sauvegarde de l'ancienne pièce pour le log
            $old_piece = Piece::findOrFail($request->idPiece);
            //Modification de la pièce dans la base de données
            $piece = Piece::find($request->idPiece);
            $piece->idEssence = $request->idEssence;
            $piece->typePiece = $request->typePiece;
            if($imageBLOB){//Si une image a été uploadée
                $piece->photoPiece = $imageBLOB;
            }
            $piece->prixHTPiece = $request->prixHTPiece;
            $piece->stockPiece = $request->stockPiece;
            $piece->commentaire = $request->commentaire;
            $piece->referencePiece = $request->referencePiece;
            $piece->exportablePiece = $request->exportablePiece;
            $piece->save();

            //Log
            Log::info('Piece modifier : id = ' .$piece->idPiece . 
                ' - varieteEssence = ' . $old_piece->essence->varieteEssence . ' -> ' . $piece->essence->varieteEssence .
                ' - typePiece = '  . $old_piece->typePiece . ' -> ' . $piece->typePiece .
                ' - commentaire = '  . $old_piece->commentaire . ' -> ' . $piece->commentaire .
                ' - referencePiece = '  . $old_piece->referencePiece . ' -> ' . $piece->referencePiece .
                ' - prixHTPiece = '  . $old_piece->prixHTPiece . ' -> ' . $piece->prixHTPiece .
                ' - stockPiece = '  . $old_piece->stockPiece . ' -> ' . $piece->stockPiece .
                ' - exportablePiece = '  . $old_piece->exportablePiece . ' -> ' . $piece->exportablePiece .
                ' par ' . Auth::user()->name . '-'. Auth::user()->id);
    
            //Redirection vers la page de la boutique
            return redirect()->route('admin.piece.index')->with('success', 'La pièce a été modifié avec succès');
        }catch(\Exception $e){
            //Log
            Log::error('Erreur lors de la modification de la pièce : ' . $request->idPiece . ' - ' . $request->typePiece . ' par ' . Auth::user()->name . ' - Erreur : ' . $e->getMessage());
            //Redirection vers la page de la boutique avec un message d'erreur
            return redirect()->route('admin.piece.index')->with('error', 'Erreur lors de l\'ajout de la pièce: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try{
            //Suppression du produit dans la base de données
            $piece = Piece::findOrFail($id);
            $piece->delete();
            //Log
            Log::info('Piece supprimé : ' . $piece->typePiece . ' - ' . $id . ' par ' . Auth::user()->name . '-'. Auth::user()->id);
            //Redirection vers la liste des produits avec un message de succès
            return redirect()->route('admin.piece.index')->with('success', 'Produit supprimé avec succès.');
        }
        catch(\Exception $e){
            //Log
            Log::error('Erreur lors de la suppression de la pièce : ' . $id . ' par ' . Auth::user()->name . '-'. Auth::user()->id . ' - Erreur : ' . $e->getMessage());
            //Redirection vers la liste des produits avec un message d'erreur
            return redirect()->route('admin.piece.index')->with('error', 'Erreur lors de la suppression du produit.');
        }
    }
}
