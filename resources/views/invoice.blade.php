<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facture</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        .invoice-header,
        .invoice-footer {
            text-align: center;
            padding: 10px 0;
            background-color: #333;
            color: #fff;
        }

        .invoice-header h1,
        .invoice-footer p {
            margin: 0;
        }

        .invoice-body {
            padding: 20px 0;
        }

        .invoice-body h2 {
            text-align: center;
            margin: 0 0 20px 0;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
            font-size: 1.2em;
        }

        .total span {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h1>Facture</h1>
        </div>

        <div class="invoice-body">
            <p>Date : {{ now()->format('d/m/Y') }}</p>
            <p>Client : {{ $commande->client->name }}</p>
            <p>Adresse : {{ $commande->client->adresse }}</p>
            <p>Ville : {{ $commande->client->ville }}</p>
            <p>Code Postal : {{ $commande->client->code_postal }}</p>

            <h2>Produits</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produits as $produit)
                        <tr>
                            <td>{{ $produit->designationProduit }}</td>
                            <td>{{ $produit->pivot->quantitePr }}</td>
                            <td>{{ $produit->pivot->prixPr }} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h2>Pièces</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Quantité</th>                       
                        <th>Référence</th>
                        <th>Essence</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pieces as $piece)
                        <tr>
                            <td>{{ $piece->typePiece }}</td>
                            <td>{{ $piece->pivot->quantitePc }}</td>
                            <td>{{ $piece->referencePiece }} </td>
                            <td>{{ $piece->essence ? $piece->essence->nomLatinEssence : 'N/A' }}</td>
                            <td>{{ $piece->pivot->prixPc }} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h2>Offres</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($offres as $offre)
                        <tr>
                            <td>{{ $offre->nomOffre }}</td>
                            <td>{{ $offre->pivot->quantiteOf }}</td>
                            <td>{{ $offre->pivot->prixOffre }} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total">
                <p>Total : <span>{{ $commande->total_price }} €</span></p>
            </div>
        </div>

        <div class="invoice-footer">
            <p>Merci pour votre achat !</p>
        </div>
    </div>
</body>
</html>
