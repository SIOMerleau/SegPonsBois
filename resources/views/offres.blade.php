<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Offres du Jour</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles for the list group */
        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            border-radius: 0.25rem;
            background-color: #fff;
        }

        .list-group-item:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">

@include('partials.navbar')

    <!-- Offres du jour -->
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center mb-6">Offres du Jour</h1>

    <!-- Vérification de la présence d'offres -->
    @if ($offres->isEmpty())
        <p class="text-center text-gray-500">Pas d'offre disponible.</p>
    @else
        <ul class="list-group rounded-lg shadow-sm">
            @foreach ($offres as $offre)
                <li class="list-group-item">
                    <div>
                        <h2 class="text-xl font-semibold">{{$offre->nomOffre}}</h2>
                        <p class="test-gray-700">Debut de l'offre : {{$offre->date_debut}}</p>
                        <p class="text-gray-700">Fin de l'offre : {{ $offre->date_fin }}</p>

                        @if ($offre->concerner)
                        <p class="text-gray-700">Prix de l'offre : {{ $offre->concerner->prixOffre }} €</p>
                        <p class="text-gray-700">Quantité de l'offre : {{ $offre->concerner->quantiteOf }}</p>
                        @if ($offre->concerner->produit)
                            <p class="text-gray-700">Nom du produit : {{ $offre->concerner->produit->designationProduit }}</p>
                            <div class="mt-4">
                                <img 
                                    src="data:image/jpeg;base64,{{ base64_encode($offre->concerner->produit->photoProduit) }}" 
                                    alt="{{ $offre->concerner->produit->designationProduit }}" 
                                    class="w-64 h-64 object-cover rounded-lg"
                                >
                            </div>
                            @else
                                <p class="text-gray-500">Produit non disponible.</p>
                            @endif
                        @else
                        <p class="text-gray-500">Détails non disponibles pour cette offre.</p>
                        @endif
                    </div>
                    <form action="{{ route('panier.ajouterOffre', ['idOffre' => $offre->idOffre]) }}" method="POST" id="add-to-cart-{{$offre->idOffre}}">
                        @csrf
                        <input type="number" name="quantite" value="1" min="1" class="border rounded w-16 text-center">
                        <button type="button" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition" onclick="checkAuthof({{$offre->idOffre}})">
                            Ajouter au Panier
                        </button>
                    </form>
                    
                    
                </li>
            @endforeach
           
        </ul>
    @endif
</div>
<!-- Script to handle authentication before adding to cart -->
<script>
    function checkAuthof(idOffre) {
        @auth
            document.getElementById('add-to-cart-' + idOffre).submit();
        @else
            window.location.href = "{{ route('user.login') }}";
        @endauth
    }
</script>

</body>
</html>
