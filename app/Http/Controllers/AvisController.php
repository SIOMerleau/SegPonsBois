<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avis;
use Illuminate\Support\Facades\Auth;
use App\Models\Produit;
use Illuminate\Support\Facades\Log;

class AvisController extends Controller
{
    // Ajouter un avis
    public function store(Request $request){
        try {
            // Validation des données
            $validated = $request->validate([
                'idProduit' => 'required|integer',
                'etoilesAvis' => 'required|integer|min:1|max:5',
                'texteAvis' => 'nullable|string|max:255',
            ]);


            
            // Vérification si l'utilisateur a déjà laissé un avis pour ce produit
            $existingReview = Avis::where('idProduit', $validated['idProduit'])
                                  ->where('idUsers', auth()->id())
                                  ->first();
            if ($existingReview) {
                // Si un avis existe déjà, on renvoie une erreur
                return redirect()->route('produit.index')->with('error', 'Vous avez déjà laissé un avis pour ce produit.');
            }

            // Création de l'avis
            $avis = new Avis();
            $avis->idProduit = $validated['idProduit'];
            $avis->idUsers = auth()->id();
            $avis->etoilesAvis = $validated['etoilesAvis'];
            $avis->texteAvis = $validated['texteAvis'];
            $avis->dateAvis = now();
            $avis->save();

            //Log en cas d'ajout d'un avis
            Log::info('Avis ajouté pour le produit ' . $validated['idProduit'] . ' - ' . Produit::where('idProd', $validated['idProduit'])->get('designationProduit') . ' par l\'utilisateur ' . auth()->id() . auth()->user()->name);            
            // Retour à la page du produit avec un message de succès
            return redirect()->route('produit.index')->with('success', 'Votre avis a été ajouté avec succès.');
        } catch (\Exception $e) {
            // En cas d'erreur, on renvoie un message d'erreur + log
            Log::error('Erreur lors de l\'ajout d\'un avis : ' . $e->getMessage() . ' - produit -> ' . $validated['idProduit'] . ' - utilisateur -> ' . auth()->id() . auth()->user()->name);
            return back()->with('error', 'Une erreur s\'est produite lors de l\'ajout de votre avis.' . $e->getMessage());
        }
    }
}
