<?php
namespace App\Http\Controllers;

use App\Models\Offre;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OffreController extends Controller
{
    // Affichage des offres pour les utilisateurs
    public function index()
    {
        // Récupération des offres avec les produits concernés
        $offres = Offre::with('concerner.produit')->get();
        // Retourne la vue des offres
        return view('offres', compact('offres'));
    }

    public function show($id)
    {
        // Récupération de l'offre avec les produits concernés
        $offre = Offre::with('concerner.produit')->findOrFail($id);
        // Retourne la vue de l'offre
        return view('offres.show', compact('offre'));
    }

    // Affichage des offres pour les administrateurs
    public function adminIndex()
    {
        // Récupération des offres avec les produits concernés
        $offres = Offre::with('concerner.produit')->get();
        // Retourne la vue des offres pour les administrateurs
        return view('admin.offres.index', compact('offres'));
    }

    public function create()
    {
        // Récupération de tous les produits
        $produits = Produit::all();
        // Retourne la vue de création d'une offre avec les données des produits
        return view('admin.offres.create', compact('produits'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'nomOffre' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'idProd_Produit' => 'required|exists:produit,idProd',
            'prixOffre' => 'required|numeric|min:0',
            'quantiteOf' => 'required|integer|min:1',
        ]);

        // Création de l'offre
        $offre = Offre::create([
            'nomOffre' => $validated['nomOffre'],
            'date_debut' => $validated['date_debut'],
            'date_fin' => $validated['date_fin'],
        ]);

        // Création de la relation concerner
        $offre->concerner()->create([
            'idProd_Produit' => $validated['idProd_Produit'],
            'prixOffre' => $validated['prixOffre'],
            'quantiteOf' => $validated['quantiteOf'],
        ]);
        //Log
        Log::info('Offre ajoutée : ' . $validated['nomOffre'] . ' par ' . Auth::user()->name . '-'. Auth::user()->id);
        // Redirection vers la liste des offres
        return redirect()->route('admin.offre.index')->with('success', 'Offre créée avec succès.');
    }

    public function edit($idOffre)
    {
        // Récupération de l'offre avec les produits concernés
        $offre = Offre::with('concerner')->findOrFail($idOffre);
        // Récupération de tous les produits
        $produits = Produit::all();
        // Retourne la vue de modification d'une offre avec les données de l'offre et des produits
        return view('admin.offres.edit', compact('offre', 'produits'));
    }

    public function update(Request $request, $idOffre)
    {
        // Validation des données
        $request->validate([
            'nomOffre' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'idProd_Produit' => 'required|exists:produit,idProd',
            'prixOffre' => 'required|numeric|min:0',
            'quantiteOf' => 'required|integer|min:1',
        ]);
        // Récupération de l'offre
        $offre = Offre::findOrFail($idOffre);
        // Mise à jour de l'offre
        $offre->update($request->only(['nomOffre', 'date_debut', 'date_fin']));
        // Mise à jour de la relation concerner
        $offre->concerner()->updateOrCreate(
            ['idOffre' => $offre->idOffre],
            $request->only(['idProd_Produit', 'prixOffre', 'quantiteOf'])
        );
        // Redirection vers la liste des offres
        return redirect()->route('admin.offre.index')->with('success', 'Offre mise à jour avec succès.');
    }

    public function destroy($idOffre)
    {
        // Récupération de l'offre
        $offre = Offre::findOrFail($idOffre);
        // Suppression de la relation concerner si elle existe
        if ($offre->concerner) {
            $offre->concerner()->delete();
        }
        // Suppression de l'offre
        $offre->delete();
        // Redirection vers la liste des offres
        return redirect()->route('admin.offre.index')->with('success', 'Offre supprimée avec succès.');
    }
}
