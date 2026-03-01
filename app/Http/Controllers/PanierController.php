<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Panier;
use App\Models\Offre;
use App\Models\Contenirpr;
use App\Models\Contenirpc;
use App\Models\Piece;
use Auth;
use App\Models\Commande;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use TCPDF;

class PanierController extends Controller
{


    public function afficherPanier()
    {
        $user = Auth::user();
        $panier = $user->panier;
    
        if ($panier) {
            $offres = $panier->offres;
            $pieces = $panier->pieces;
            $produits = $panier->produits;
        } else {
            $offres = collect();
            $pieces = collect();
            $produits = collect();
            $panier = null;
        }
    
        return view('panier', compact('offres', 'pieces', 'produits', 'panier'));
    }
    

    // Afficher le panier
    public function index()
    {
        $user = Auth::user();
        $panier = $user->panier()->with('offres')->first();

        // Vérifier si l'utilisateur a un panier. Si ce n'est pas le cas, en créer un.
        if (!$panier) {
            $panier = Panier::create([
                'idClient' => $user->id,
                'datePanier' => now(),
                'total_price' => 0,
                'status' => 0
            ]);
            

            // Assigner le panier nouvellement créé à l'utilisateur
            $user->panier()->save($panier);
        }

        return view('panier', compact('panier'));
    }

    // Ajouter un produit au panier
    public function add(Request $request, $produitId)
{
    $user = Auth::user();
    $panier = $user->panier;

    if (!$panier) {
        $panier = Panier::create([
            'idClient' => $user->id,
            'datePanier' => now(),
            'total_price' => 0,
            'status' => 0
        ]);

        $user->panier()->save($panier);
    }

    $produit = Produit::find($produitId);

    if ($produit && $produit->stockProduit >= $request->quantity) {
        if ($panier->produits()->where('idProd_Produit', $produitId)->exists()) {
            $pivotRow = $panier->produits()->where('idProd_Produit', $produitId)->first();
            $newQuantity = $pivotRow->pivot->quantitePr + $request->quantity;

            $panier->produits()->updateExistingPivot($produitId, [
                'quantitePr' => $newQuantity,
                'prixPr' => $request->price
            ]);
        } else {
            $panier->produits()->attach($produitId, [
                'quantitePr' => $request->quantity,
                'prixPr' => $request->price
            ]);
        }

        $produit->decrement('stockProduit', $request->quantity);
        $this->updateTotalPrice($panier);

        return redirect()->route('panier')->with('success', 'Produit ajouté au panier!');
    }

    return redirect()->route('panier')->with('error', 'Produit non trouvé ou stock insuffisant.');
}

    // Supprimer un produit du panier
    public function remove($produitId)
{
    $user = Auth::user();
    $panier = $user->panier;

    if (!$panier) {
        $panier = Panier::create([
            'idClient' => $user->id,
            'datePanier' => now(),
            'total_price' => 0,
            'status' => 0
        ]);

        $user->panier()->save($panier);
    }

    $produit = Produit::find($produitId);
    $currentQuantity = $panier->produits()->find($produitId)->pivot->quantitePr;

    $panier->produits()->detach($produitId);
    $produit->increment('stockProduit', $currentQuantity);
    $this->updateTotalPrice($panier);

    return redirect()->route('panier')->with('success', 'Produit supprimé du panier!');
}



    // Augmenter la quantité d'un produit dans le panier
    public function increaseQuantity($produitId)
{
    $user = Auth::user();
    $panier = $user->panier;
    $produit = Produit::find($produitId);

    if ($panier && $produit && $produit->stockProduit > 0) {
        $panier->produits()->updateExistingPivot($produitId, [
            'quantitePr' => DB::raw('quantitePr + 1')
        ]);

        $produit->decrement('stockProduit', 1);
        $this->updateTotalPrice($panier);

        return redirect()->route('panier')->with('success', 'Quantité augmentée!');
    }

    return redirect()->route('panier')->with('error', 'Produit non trouvé ou stock insuffisant.');
}


    // Diminuer la quantité d'un produit dans le panier
    public function decreaseQuantity($produitId)
    {
        $user = Auth::user();
        $panier = $user->panier;
        $produit = Produit::find($produitId);
    
        if ($panier && $produit && $panier->produits()->where('idProd_Produit', $produitId)->exists()) {
            $currentQuantity = $panier->produits()->find($produitId)->pivot->quantitePr;
    
            if ($currentQuantity > 1) {
                $panier->produits()->updateExistingPivot($produitId, [
                    'quantitePr' => DB::raw('quantitePr - 1')
                ]);
                $produit->increment('stockProduit', 1);
            } else {
                $panier->produits()->detach($produitId);
                $produit->increment('stockProduit', 1);
            }
    
            $this->updateTotalPrice($panier);
    
            return redirect()->route('panier')->with('success', 'Quantité diminuée!');
        }
    
        return redirect()->route('panier')->with('error', 'Produit non trouvé ou stock insuffisant.');
    }
    
    
    // Ajouter une pièce au panier
    public function addPiece(Request $request, $pieceId){
    $user = Auth::user();
    $panier = $user->panier;
    // Vérifier si l'utilisateur a un panier. Si ce n'est pas le cas, en créer un.
    if (!$panier) {
        $panier = Panier::create([
            'idClient' => $user->id,
            'datePanier' => now(),
            'total_price' => 0,
            'status' => 0
        ]);
        // Assigner le panier nouvellement créé à l'utilisateur
        $user->panier()->save($panier);
    }
    // Récupérer la pièce
    $piece = Piece::find($pieceId);
    // Vérifier si la pièce existe et si le stock est suffisant
    if ($piece && $piece->stockPiece >= $request->quantity) {
        if ($panier->pieces()->where('idPiece', $pieceId)->exists()) {
            $pivotRow = $panier->pieces()->where('idPiece', $pieceId)->first();
            $newQuantity = $pivotRow->pivot->quantitePc + $request->quantity;
            // Mettre à jour la quantité et le prix de la pièce
            $panier->pieces()->updateExistingPivot($pieceId, [
                'quantitePc' => $newQuantity,
                'prixPc' => $request->price
            ]);
        } else {
            // Ajouter la pièce au panier
            $panier->pieces()->attach($pieceId, [
                'quantitePc' => $request->quantity,
                'prixPc' => $request->price
            ]);
        }
        // Mettre à jour le stock de la pièce et le prix total du panier
        $piece->decrement('stockPiece', $request->quantity);
        $this->updateTotalPrice($panier);
        // Rediriger vers le panier avec un message de succès
        return redirect()->route('panier')->with('success', 'Pièce ajoutée au panier!');
    }
    // Rediriger vers le panier avec un message d'erreur
    return redirect()->route('panier')->with('error', 'Pièce non trouvée ou stock insuffisant.');
}

    
    

// Supprimer une pièce du panier
public function removePiece($pieceId)
{
    $user = Auth::user();
    $panier = $user->panier;

    if (!$panier) {
        $panier = Panier::create([
            'idClient' => $user->id,
            'datePanier' => now(),
            'total_price' => 0,
            'status' => 0
        ]);

        $user->panier()->save($panier);
    }

    $piece = Piece::find($pieceId);
    $currentQuantity = $panier->pieces()->find($pieceId)->pivot->quantitePc;

    $panier->pieces()->detach($pieceId);
    $piece->increment('stockPiece', $currentQuantity);
    $this->updateTotalPrice($panier);

    return redirect()->route('panier')->with('success', 'Pièce supprimée du panier!');
}


// Augmenter la quantité d'une pièce dans le panier
public function increasePieceQuantity($pieceId)
{
    $user = Auth::user();
    $panier = $user->panier;
    $piece = Piece::find($pieceId);

    if ($panier && $piece && $piece->stockPiece > 0) {
        $panier->pieces()->updateExistingPivot($pieceId, [
            'quantitePc' => DB::raw('quantitePc + 1')
        ]);

        $piece->decrement('stockPiece', 1);
        $this->updateTotalPrice($panier);

        return redirect()->route('panier')->with('success', 'Quantité augmentée!');
    }

    return redirect()->route('panier')->with('error', 'Pièce non trouvée ou stock insuffisant.');
}




// Diminuer la quantité d'une pièce dans le panier
public function decreasePieceQuantity($pieceId)
{
    $user = Auth::user();
    $panier = $user->panier;
    $piece = Piece::find($pieceId);

    if ($panier && $piece && $panier->pieces()->where('idPiece', $pieceId)->exists()) {
        $currentQuantity = $panier->pieces()->find($pieceId)->pivot->quantitePc;

        if ($currentQuantity > 1) {
            $panier->pieces()->updateExistingPivot($pieceId, [
                'quantitePc' => DB::raw('quantitePc - 1')
            ]);
            $piece->increment('stockPiece', 1);
        } else {
            $panier->pieces()->detach($pieceId);
            $piece->increment('stockPiece', 1);
        }

        $this->updateTotalPrice($panier);

        return redirect()->route('panier')->with('success', 'Quantité diminuée!');
    }

    return redirect()->route('panier')->with('error', 'Pièce non trouvée ou stock insuffisant.');
}







  // Méthode pour mettre à jour le total_price du panier
  private function updateTotalPrice($panier) 
  {
      $totalPriceProduits = $panier->produits->sum(function($produit) {
          return $produit->pivot->quantitePr * $produit->pivot->prixPr;
      });
  
      $totalPricePieces = $panier->pieces->sum(function($piece) {
          return $piece->pivot->quantitePc * $piece->pivot->prixPc;
      });
  
      $totalPriceOffres = $panier->offres->sum(function($offre) {
          return $offre->pivot->quantiteOf * $offre->pivot->prixOffre;
      });
  
      $panier->total_price = $totalPriceProduits + $totalPricePieces + $totalPriceOffres;
      $panier->save();
  }
  

  
 //ajouter une offre au panier
  public function ajouterOffreAuPanier(Request $request, $idOffre)
{
    $user = Auth::user();
    $panier = $user->panier;

    if (!$panier) {
        $panier = Panier::create([
            'idClient' => $user->id,
            'datePanier' => now(),
            'total_price' => 0,
            'status' => 0
        ]);

        $user->panier()->save($panier);
    }

    $offre = Offre::find($idOffre);
    //gerer les quantitée
    if ($offre && $offre->concerner->quantiteOf >= $request->quantite) {
        $pivotRow = $panier->offres()->where('contenir_offre.idOffre', $idOffre)->first();

        if ($pivotRow) {
            $newQuantity = $pivotRow->pivot->quantiteOf + $request->quantite;

            $panier->offres()->updateExistingPivot($idOffre, [
                'quantiteOf' => $newQuantity,
                'prixOffre' => $offre->concerner->prixOffre
            ]);
        } else {
            $panier->offres()->attach($idOffre, [
                'quantiteOf' => $request->quantite,
                'prixOffre' => $offre->concerner->prixOffre
            ]);
        }

        $offre->concerner->decrement('quantiteOf', $request->quantite);
        $this->updateTotalPrice($panier);

        return redirect()->route('panier')->with('success', 'Offre ajoutée au panier!');
    }

    return redirect()->route('panier')->with('error', 'Offre non trouvée ou stock insuffisant.');
}


  
  
  //supprimer une offre du panier
public function removeOffre($idOffre)
{
    $user = Auth::user();
    $panier = $user->panier;

    if (!$panier) {
        $panier = Panier::create([
            'idClient' => $user->id,
            'datePanier' => now(),
            'total_price' => 0,
            'status' => 0
        ]);

        $user->panier()->save($panier);
    }

    $offre = Offre::find($idOffre);
    $currentQuantity = $panier->offres()->find($idOffre)->pivot->quantiteOf;

    $panier->offres()->detach($idOffre);

    if ($offre) {
        $offre->concerner->increment('quantiteOf', $currentQuantity);
    }

    $this->updateTotalPrice($panier);

    return redirect()->route('panier')->with('success', 'Offre supprimée du panier!');
}

//augmenter une quantité d'offre
      public function increaseOffreQuantity($idOffre)
{
    $user = Auth::user();
    $panier = $user->panier;
    $offre = Offre::find($idOffre);

    if ($panier && $offre && $offre->concerner->quantiteOf > 0) {
        $panier->offres()->updateExistingPivot($idOffre, [
            'quantiteOf' => DB::raw('contenir_offre.quantiteOf + 1')
        ]);

        $offre->concerner->decrement('quantiteOf', 1);
        $this->updateTotalPrice($panier);
    }

    return redirect()->route('panier')->with('success', 'Quantité de l\'offre augmentée!');
}

      
  //diminuer une quantité d'offre
public function decreaseOffreQuantity($idOffre)
{
    $user = Auth::user();
    $panier = $user->panier;
    $offre = Offre::find($idOffre);

    if ($panier && $offre && $panier->offres()->where('contenir_offre.idOffre', $idOffre)->exists()) {
        $currentQuantity = $panier->offres()->find($idOffre)->pivot->quantiteOf;

        if ($currentQuantity > 1) {
            $panier->offres()->updateExistingPivot($idOffre, [
                'quantiteOf' => DB::raw('contenir_offre.quantiteOf - 1')
            ]);
            $offre->concerner->increment('quantiteOf', 1);
        } else {
            $panier->offres()->detach($idOffre);
            $offre->concerner->increment('quantiteOf', 1);
        }

        $this->updateTotalPrice($panier);
    }

    return redirect()->route('panier')->with('success', 'Quantité de l\'offre diminuée!');
}


    //générer la facture pdf
    public function generateInvoice()
    {
        $user = Auth::user();
        $panier = $user->panier;

        $pdf = new TCPDF();
        $pdf->AddPage();

        // Titre du document
        $pdf->SetFont('helvetica', 'B', 20);
        $pdf->Cell(0, 10, 'Facture', 0, 1, 'C');

        // Date et informations du client
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, 'Date : ' . now()->format('d/m/Y'), 0, 1, 'L');
        $pdf->Cell(0, 10, 'Client : ' . $user->name, 0, 1, 'L');

        // Produits
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, 'Produits', 0, 1, 'L');
        $pdf->SetFont('helvetica', '', 12);
        $tbl = '<table border="1" cellpadding="5">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($panier->produits as $produit) {
            $tbl .= '<tr>
                        <td>' . $produit->designationProduit . '</td>
                        <td>' . $produit->pivot->quantitePr . '</td>
                        <td>' . $produit->pivot->prixPr . ' €</td>
                    </tr>';
        }
        $tbl .= '</tbody></table>';
        $pdf->writeHTML($tbl, true, false, false, false, '');

        // Pièces
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, 'Pièces', 0, 1, 'L');
        $pdf->SetFont('helvetica', '', 12);
        $tbl = '<table border="1" cellpadding="5">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                            <th>Référence</th>
                            <th>Essence</th>
                        </tr>
                    </thead>
                    <tbody>';
        
        foreach ($panier->pieces as $piece) {
            $essenceNom = $piece->essence ? $piece->essence->nomLatinEssence : 'N/A';
            $tbl .= '<tr>
                        <td>' . $piece->typePiece . '</td>
                        <td>' . $piece->pivot->quantitePc . '</td>
                        <td>' . $piece->pivot->prixPc . ' €</td>
                        <td>' . $piece->referencePiece . '</td>
                        <td>' . $essenceNom . '</td>
                    </tr>';
        }
        
        $tbl .= '</tbody></table>';
        $pdf->writeHTML($tbl, true, false, false, false, '');
        

        // Offres
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, 'Offres', 0, 1, 'L');
        $pdf->SetFont('helvetica', '', 12);
        $tbl = '<table border="1" cellpadding="5">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($panier->offres as $offre) {
            $tbl .= '<tr>
                        <td>' . $offre->nomOffre . '</td>
                        <td>' . $offre->pivot->quantiteOf . '</td>
                        <td>' . $offre->pivot->prixOffre . ' €</td>
                    </tr>';
        }
        $tbl .= '</tbody></table>';
        $pdf->writeHTML($tbl, true, false, false, false, '');

        // Total
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, 'Total : ' . $panier->total_price . ' €', 0, 1, 'R');

        // Générer le PDF
        $pdf->Output('facture.pdf', 'D');
    
}





    public function passerCommande()
    {
        $user = Auth::user();
        $panier = $user->panier;

        if ($panier) {
            // Créer la commande
            $commande = Commande::create([
                'idClient' => $user->id,
                'total_price' => $panier->total_price,
                'status' => 'terminée',
            ]);

            // Ajouter les produits à la commande
            foreach ($panier->produits as $produit) {
                $commande->produits()->attach($produit->idProd, [
                    'quantitePr' => $produit->pivot->quantitePr,
                    'prixPr' => $produit->pivot->prixPr,
                ]);
            }

            // Ajouter les pièces à la commande
            foreach ($panier->pieces as $piece) {
                $commande->pieces()->attach($piece->idPiece, [
                    'quantitePc' => $piece->pivot->quantitePc,
                    'prixPc' => $piece->pivot->prixPc,
                ]);
            }

            // Ajouter les offres à la commande
            foreach ($panier->offres as $offre) {
                $commande->offres()->attach($offre->idOffre, [
                    'quantiteOf' => $offre->pivot->quantiteOf,
                    'prixOffre' => $offre->pivot->prixOffre,
                ]);
            }

            // Générer la facture en PDF
            $pdf = new TCPDF();
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Essence de Bois');
            $pdf->SetTitle('Facture');
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Facture', 'Essence de Bois');

            // Ajouter une page
            $pdf->AddPage();

            // Contenu de la facture
            $html = view('invoice', [
                'user' => $user,
                'commande' => $commande,
                'produits' => $commande->produits,
                'pieces' => $commande->pieces,
                'offres' => $commande->offres,
            ])->render();

            // Écrire le HTML dans le PDF
            $pdf->writeHTML($html, true, false, true, false, '');

            // Vider le panier après la commande
            $panier->produits()->detach();
            $panier->pieces()->detach();
            $panier->offres()->detach();
            $panier->delete();
            //Log
            Log::info('Commane passé : ' . $commande->idCommande . ' par ' . Auth::user()->name . '-'. Auth::user()->id);

            // Télécharger le fichier PDF
            $pdf->Output('facture' . $commande->idCommande . '.pdf', 'D');
            //Log
            Log::info('Facture générée pour la commande ' . $commande->idCommande . ' par ' . Auth::user()->name . '-'. Auth::user()->id);

            return redirect()->route('panier')->with('success', 'Commande passée avec succès!');
        }

        return redirect()->route('panier')->with('error', 'Votre panier est vide.');
    
}


  
      
  }
  







 
    
