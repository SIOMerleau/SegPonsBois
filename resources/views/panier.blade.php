<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Votre Panier</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function verifierInformationsPersonnelles(event) {
            const address = "{{ Auth::user()->adresse }}";
            const city = "{{ Auth::user()->ville }}";
            const postalCode = "{{ Auth::user()->code_postal }}";

            if (!address || !city || !postalCode) {
                event.preventDefault();
                alert('Veuillez compléter vos informations personnelles avant de passer une commande.');
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-sans">

    @include('partials.navbar')

    <div class="container mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Votre Panier</h1>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Erreur!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if($panier && ($panier->produits->count() || $panier->pieces->count() || $panier->offres->count()))
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <ul class="divide-y divide-gray-200">
                    <!-- Affichage des produits -->
                    @foreach($panier->produits as $produit)
                        <li class="flex items-center px-4 py-4 sm:px-6">
                            <div class="flex-shrink-0">
                                <img src="data:image/jpeg;base64,{{ base64_encode($produit->photoProduit) }}" alt="{{ $produit->designationProduit }}" class="w-16 h-16 object-cover rounded-lg">
                            </div>
                            <div class="flex-1 min-w-0 ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $produit->designationProduit }}</h3>
                                <p class="text-sm text-gray-600">{{ $produit->pivot->quantitePr }} x {{ $produit->pivot->prixPr }} €</p>
                            </div>
                            <div class="ml-4 flex-shrink-0 flex space-x-2">
                                <form action="{{ route('panier.decrease', $produit->idProd) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-gray-300 text-gray-900 rounded">-</button>
                                </form>
                                <form action="{{ route('panier.increase', $produit->idProd) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-gray-300 text-gray-900 rounded">+</button>
                                </form>
                                <form action="{{ route('panier.remove', $produit->idProd) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Supprimer</button>
                                </form>
                            </div>
                        </li>
                    @endforeach

                    <!-- Affichage des pièces -->
                    @foreach($panier->pieces as $piece)
                        <li class="flex items-center px-4 py-4 sm:px-6">
                            <div class="flex-shrink-0">
                                <img src="data:image/jpeg;base64,{{ base64_encode($piece->photoPiece) }}" alt="{{ $piece->typePiece }}" class="w-16 h-16 object-cover rounded-lg">
                            </div>
                            <div class="flex-1 min-w-0 ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $piece->typePiece }}</h3>
                                <p class="text-sm text-gray-600">{{ $piece->pivot->quantitePc }} x {{ $piece->pivot->prixPc }} €</p>
                            </div>
                            <div class="ml-4 flex-shrink-0 flex space-x-2">
                                <form action="{{ route('panier.decreasePiece', $piece->idPiece) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-gray-300 text-gray-900 rounded">-</button>
                                </form>
                                <form action="{{ route('panier.increasePiece', $piece->idPiece) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-gray-300 text-gray-900 rounded">+</button>
                                </form>
                                <form action="{{ route('panier.removePiece', $piece->idPiece) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Supprimer</button>
                                </form>
                            </div>
                        </li>
                    @endforeach

                    <!-- Affichage des offres -->
                    @foreach($panier->offres as $offre)
                        <li class="flex items-center px-4 py-4 sm:px-6">
                            <div class="flex-shrink-0">
                                <img src="data:image/jpeg;base64,{{ base64_encode($offre->concerner->produit->photoProduit) }}" alt="{{ $offre->nomOffre }}" class="w-16 h-16 object-cover rounded-lg">
                            </div>
                            <div class="flex-1 min-w-0 ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $offre->nomOffre }}</h3>
                                <p class="text-sm text-gray-600">Prix unitaire : {{ $offre->concerner->prixOffre }} €</p>
                                <p class="text-sm text-gray-600">Quantité : {{ $offre->pivot->quantiteOf }}</p>
                                @if($offre->concerner->produit)
                                    <p class="text-sm text-gray-600">Produit inclus : {{ $offre->concerner->produit->designationProduit }}</p>
                                @else
                                    <p class="text-sm text-gray-500">Produit non spécifié.</p>
                                @endif
                            </div>
                            <div class="ml-4 flex-shrink-0 flex space-x-2">
                                <form action="{{ route('panier.decreaseOffreQuantity', $offre->idOffre) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-gray-300 text-gray-900 rounded">-</button>
                                </form>
                                <form action="{{ route('panier.increaseOffreQuantity', $offre->idOffre) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-gray-300 text-gray-900 rounded">+</button>
                                </form>
                                <form action="{{ route('panier.removeOffre', ['idOffre' => $offre->idOffre]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Supprimer</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="px-6 py-4 bg-gray-50">
                    <div class="flex flex-col sm:flex-row justify-between items-center">
                        <p class="text-lg font-semibold text-gray-800 mb-2 sm:mb-0">Total :</p>
                        <p class="text-xl font-bold text-gray-900">{{ $panier->total_price }} €</p>
                    </div>
                    <form action="{{ route('panier.passerCommande') }}" method="POST" onsubmit="verifierInformationsPersonnelles(event)">
                        @csrf
                        <button type="submit" class="mt-4 px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Passer commande
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="text-center py-8">
                <p class="text-gray-600 mb-4">Votre panier est vide.</p>
                <a href="{{ route('boutique') }}" class="inline-block px-6 py-3 bg-gray-500 hover:bg-gray-700 text-white font-medium rounded-lg transition duration-300">Retour à la boutique</a>
            </div>
        @endif
    </div>

</body>
</html>
