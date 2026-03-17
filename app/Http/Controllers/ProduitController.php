<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Avis;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProduitController extends Controller
{
    //Afficher la liste des produits dans la boutique
    public function index()
    {
        
        $produits = Produit::with(['categorie','avis'])->get();
        return view('produit.boutique', compact('produits'));
    }

    //Afficher la liste des produits et de sa catégorie lié dans le tableau de bord adminstrateur
    public function index_dashboard(){
        $produits = Produit::all();
        $produits = Produit::with('categorie')->get();

        $categories = Categorie::all();
        return view('admin.produit.index', compact('produits', 'categories'));
    }

    //Créer un nouveau produit dans la base de données
    public function store(Request $request)
    {
        try{
            //Validation des données
            $request->validate([
                'idCategorie' => 'required|integer',
                'designationProduit' => 'required|string|max:255',
                'photoProduit' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'prixProduit' => 'required|numeric',
                'stockProduit' => 'required|integer',
                'descriptionProduit' => 'required|string|max:255',
            ]);

            if($request->file('photoProduit')){
            //Récupération de l'image
            $image = $request->file('photoProduit');
            $imageBLOB = file_get_contents($image->getRealPath());
            }else{
                //Si il n'y a pas de photo
                $imageBLOB = "";
            }

            //Création du produit dans la base de données
            $produit = new Produit();
            $produit->idCategorie = $request->idCategorie;
            $produit->designationProduit = $request->designationProduit;
            if($imageBLOB){//Si une image a été uploadée
                $produit->photoProduit = $imageBLOB;
            }
            $produit->prixProduit = $request->prixProduit;
            $produit->stockProduit = $request->stockProduit;
            $produit->descriptionProduit = $request->descriptionProduit;
            $produit->save();
            //Log
            Log::info('Produit créer : id = ' .$produit->idProd . 
                ' - designationProduit = ' . $produit->designationProduit . 
                ' - prixProduit = '  . $produit->prixProduit .
                ' - stockProduit = ' . $produit->stockProduit .
                ' - descriptionProduit = ' . $produit->descriptionProduit .
                ' - Catégorie = ' . $produit->categorie->libelleCategorie .
                ' par ' . Auth::user()->name . '-'. Auth::user()->id);
            //Redirection vers la liste des produits avec un message de succès
            return redirect()->route('admin.produit.index')->with('success', 'Produit créé avec succès.');
        }catch(\Exception $e){
            //Log
            Log::error('Erreur lors de la création de la pièce : ' . $produit->designationProduit . ' par ' . Auth::user()->name . ' - Erreur : ' . $e->getMessage());
            //Redirection vers la liste des produits avec un message d'erreur
            return redirect()->route('admin.produit.index')->with('error', 'Erreur lors de la création du produit: ' . $e->getMessage());
        }
    }

    public function show( $idProd)
    {
        $produit = Produit::where('idProd', $idProd)->firstOrFail(); 
        $photoBase64 = base64_encode($produit->photoProduit);
        return view('produit.detail', compact('produit', 'photoBase64'));    
    }

    //Modifier un produit dans la base de données
    public function update(Request $request)
    {
        try{
            //Validation des données
            $validatedData = $request->validate([
                'idProd' => 'required|integer',
                'idCategorie' => 'required|integer',
                'designationProduit' => 'required|string|max:255',
                'photoProduit' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'prixProduit' => 'required|numeric',
                'stockProduit' => 'required|integer',
                'descriptionProduit' => 'required|string|max:255',
            ]);

            if($request->file('photoProduit')){
                //Récupération de l'image
                $image = $request->file('photoProduit');
                $imageBLOB = file_get_contents($image->getRealPath());
                }else{
                    //Si il n'y a pas de photo
                    $imageBLOB = "";
                }
            //Sauvegarde de l'ancien produit pour les logs
            $old_produit = Produit::findOrFail($validatedData['idProd']);
            //Modification du produit dans la base de données
            $produit = Produit::find($validatedData['idProd']);
            $produit->idCategorie = $validatedData['idCategorie'];
            $produit->designationProduit = $validatedData['designationProduit'];
            if($imageBLOB){//Si une image a été uploadée
                $produit->photoProduit = $imageBLOB;
            }
            $produit->prixProduit = $validatedData['prixProduit'];
            $produit->stockProduit = $validatedData['stockProduit'];
            $produit->descriptionProduit = $validatedData['descriptionProduit'];
            $produit->save();

            //Log
            Log::info('Produit modifier : id = ' .$produit->idProd . 
                ' - designationProduit = ' . $old_produit->designationProduit . ' -> ' . $produit->designationProduit .
                ' - prixProduit = '  . $old_produit->prixProduit . ' -> ' . $produit->prixProduit .
                ' - stockProduit = ' . $old_produit->stockProduit . ' -> ' . $produit->stockProduit .
                ' - descriptionProduit = ' . $old_produit->descriptionProduit . ' -> ' . $produit->descriptionProduit .
                ' - Catégorie = ' . $old_produit->categorie->libelleCategorie . ' -> ' . $produit->categorie->libelleCategorie .
                ' par ' . Auth::user()->name . '-'. Auth::user()->id);

            //Redirection vers la liste des produits avec un message de succès
            return redirect()->route('admin.produit.index')->with('success', 'Produit modifié avec succès.');
        } catch(\Exception $e){
            //Log
            Log::error('Erreur lors de la modification du produit : ' . $produit->designationProduit . ' - ' . $request->idProd . ' par ' . Auth::user()->name . ' - Erreur : ' . $e->getMessage());
            //Redirection vers la liste des produits avec un message d'erreur
            return redirect()->route('admin.produit.index')->with('error', 'Erreur lors de la modification du produit: ' . $e->getMessage());
        }
    }

    //Supprimer un produit dans la base de données
    public function destroy(string $id)
    {
        try{
            //Suppression du produit dans la base de données
            $produit = Produit::findOrFail($id);
            $produit->delete();
            //Log
            Log::info('Produit supprimé : ' . $produit->designationProduit . ' - ' . $id . ' par ' . Auth::user()->name . '-'. Auth::user()->id);
            //Redirection vers la liste des produits avec un message de succès
            return redirect()->route('admin.produit.index')->with('success', 'Produit supprimé avec succès.');
        }
        catch(\Exception $e){
            //Log
            Log::error('Erreur lors de la suppression du produit : ' . $produit->designationProduit . ' - ' . $id . ' par ' . Auth::user()->name . ' - Erreur : ' . $e->getMessage());
            //Redirection vers la liste des produits avec un message d'erreur
            return redirect()->route('admin.produit.index')->with('error', 'Erreur lors de la suppression du produit.');
        }
    }
}
