<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boutique Pièces</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@include('partials.navbar')

<body class="bg-gray-100 text-gray-900">
@session('error')
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endsession



<div class="py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-5xl font-bold text-center mb-8 text-gray-900">Boutique Pièces</h1>

        <div class="mb-4">
            <label for="essence" class="block text-sm font-medium text-gray-700">Sélectionnez l'essence:</label>
            <select id="essence" name="essence" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" onchange="filterPieces()">
                <option value="">Toutes les essences</option>
                @foreach ($essences as $essence)
                    <option value="{{ $essence->idEssence }}">{{ $essence->varieteEssence }}</option>
                @endforeach
            </select>
        </div>




        <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6" id="pieces-list">
        @foreach ($pieces as $p)
            <li class="bg-white rounded-lg shadow-lg p-4 hover:shadow-xl transition duration-300 cursor-pointer piece-item" data-essence-id="{{ $p->essence->idEssence ?? '' }}" onclick="openModal({{ $p->idEssence }})">
                <div class="flex justify-center">
                    <a href="#" class="block text-xl font-semibold text-blue-600 hover:text-blue-800 mb-2 produit-toggle">
                    {{ $p->typePiece }}</a>
                </div>

                <div class="flex justify-center">
                    <p class="text-gray-500">
                        @if(isset($p->essence) && isset($p->essence->varieteEssence))
                            {{ $p->essence->varieteEssence }}
                        @else
                            <p>N/A</p>
                        @endif
                    </p>
                </div>

                @if ($p->photoPiece)
                    <div class="flex justify-center">
                        <img src="data:image/jpeg;base64,{{ base64_encode($p->photoPiece) }}" alt="{{ $p->typePiece }} - {{$p->essence->varieteEssence}} " class="mt-4 w-fit h-48 object-cover rounded-lg">
                    </div>
                @endif

                <div class="flex justify-center mt-4">
                    <p class="text-2xl">{{ number_format($p->prixHTPiece, 2) }}€<span class="text-sm text-gray-500">TTC</span></p>
                </div>


                <form action="{{ route('panier.addPiece', $p->idPiece) }}" id="add-to-cart-{{ $p->idPiece }}" method="POST" class="flex items-center">
                    @csrf
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="price" value="{{ $p->prixHTPiece }}">
                    <div class="flex justify-center w-full mt-2">
                        <button type="button" onclick="checkAuthPanier({{ $p->idPiece }})" class="px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </li>
        @endforeach
        </ul>
    </div>
</div>
                

@foreach($pieces as $p)
<!-- Modal -->
<div id="modal-{{ $p->idPiece }}" class="fixed z-10 inset-0 overflow-y-auto hidden bg-black bg-opacity-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full mx-auto overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-900 leading-tight">
                        {{$p->typePiece}} {{$p->essence->varieteEssence}}
                        </h2>
                    </div>
                    <button type="button" onclick="closeModal({{ $p->idPiece }})" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="space-y-2 text-gray-700">
                    <p><strong>Prix :</strong> {{ number_format($p->prixHTPiece, 2) }}€<span class="text-sm text-gray-500"> TTC</span></p>
                    <p><strong>Stock :</strong> {{$p->stockPiece}}</p>
                    <p><strong>Référence :</strong> {{$p->referencePiece}}</p>
                    <p><strong>Description :</strong> {{$p->commentaire}}</p>
                    <p><strong>Exportable :</strong> {{$p->exportablePiece == 1 ?  'Oui' : 'Non'}}</p>
                </div>
            </div>
        </div>
    </div>
  </div>
@endforeach

</body>
    <script>
        //Script pour ajouter une pièce au panier
        function checkAuthPanier(pieceId) {
            @auth //On vérifie si l'utilisateur est connecté pour valider le formulaire du panier
                document.getElementById('add-to-cart-' + pieceId).submit();
            @else //Sinon on redirige l'utilisateur vers la page de connexion
                window.location.href = "{{ route('user.login') }}";
            @endauth
        }

        //Script pour l'ouvreture du modal
        function openModal(id) {
            if (!event.target.closest('button[type="button"]')) {//On vérifie que le bouton ne soit pas celui pour ajouter la panier
                document.getElementById('modal-' + id).classList.remove('hidden');
            }
        }
    
        //Script pour la fermeture du modal
        function closeModal(id) {
            document.getElementById('modal-' + id).classList.add('hidden');
        }

        //Script pour filtrer l'affichage des pièces selon l'essence
        function filterPieces() {
            //On récupère la valeur de l'essence sélectionnée
            var selectedEssence = document.getElementById('essence').value;
            var pieces = document.querySelectorAll('.piece-item');
            //On parcourt les pièces pour les afficher ou les cacher selon l'essence sélectionnée
            pieces.forEach(function(piece) {
            if (selectedEssence === '' || piece.getAttribute('data-essence-id') === selectedEssence) {
                piece.style.display = 'block';
            }else {
                piece.style.display = 'none';
            }
        });
    }
    </script>

@include('partials.footer')
</html>
