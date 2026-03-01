<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;
use App\Models\Commande;

class CommandeController extends Controller
{
    public function generateInvoice($idCommande)
    {
        $commande = Commande::with(['client', 'produits', 'pieces', 'offres'])->find($idCommande);

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Essence de Bois');
        $pdf->SetTitle('Facture');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Facture', 'Essence de Bois');

        // Ajouter une page
        $pdf->AddPage();

        // Contenu de la facture
        $html = view('invoice', [
            'commande' => $commande,
            'produits' => $commande->produits,
            'pieces' => $commande->pieces,
            'offres' => $commande->offres,
        ])->render();

        // Écrire le HTML dans le PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Télécharger le fichier PDF
        $pdf->Output('invoice_' . $commande->idCommande . '.pdf', 'D');
    }
}
