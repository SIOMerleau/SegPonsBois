<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tableau de Bord des Commandes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

    @include('partials.navbar')

    <div class="container mx-auto py-8">
        <h1 class="text-4xl font-bold text-center mb-8">Tableau de Bord des Commandes</h1>

        @if(session('success'))
            <p class="text-green-500">{{ session('success') }}</p>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-gray-200">ID</th>
                        <th class="py-2 px-4 bg-gray-200">Client</th>
                        <th class="py-2 px-4 bg-gray-200">Total</th>
                        <th class="py-2 px-4 bg-gray-200">Statut</th>
                        <th class="py-2 px-4 bg-gray-200">Date</th>
                        <th class="py-2 px-4 bg-gray-200">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commandes as $commande)
                        <tr>
                            <td class="py-2 px-4 border">{{ $commande->idCommande }}</td>
                            <td class="py-2 px-4 border">{{ $commande->client->name }}</td>
                            <td class="py-2 px-4 border">{{ $commande->total_price }} €</td>
                            <td class="py-2 px-4 border">{{ $commande->status }}</td>
                            <td class="py-2 px-4 border">{{ $commande->created_at->format('d/m/Y') }}</td>
                            <td class="py-2 px-4 border">
                                <form action="{{ route('commandes.generateInvoice', $commande->idCommande) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
                                        Télécharger la Facture
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
