<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-300">
@include('partials.navbar')



    <div class="flex justify-center space-x-4 mt-8">

        <!-- Catégories -->
        <div>
            <a href="{{ route('admin.categorie.index') }}" class="bg-blue-500 text-white px-4 py-4 rounded-lg">
                Gérer les Catégories
            </a>
        </div>

        <!-- Produits -->
        <div>
            <a href="{{ route('admin.produit.index') }}" class="bg-amber-600 text-white px-4 py-4 rounded-lg">
                Gérer les Produits
            </a>
        </div>
        <!-- Offre -->
        <div>
            <a href="{{ route('admin.offre.index') }}" class="bg-green-600 text-white px-4 py-4 rounded-lg">
                Gérer les Offres
            </a>
        </div>

        <!-- Essences -->
        <div>
            <a href="{{ route('admin.essence.index') }}" class="bg-lime-600 text-white px-4 py-4 rounded-lg">
                Gérer les Essences
            </a>
        </div>

         <!-- Essences -->
         <div>
            <a href="{{ route('admin.commandes') }}" class="bg-yellow-500 text-white px-4 py-4 rounded-lg">
                Gérer les commandes
            </a>
        </div>
    

        <!-- Pièces -->
        <div>
            <a href="{{ route('admin.piece.index') }}" class="bg-red-800 text-white px-4 py-4 rounded-lg">
                Gérer les Pièces
            </a>
        </div>
    
    </div>

<!-- Message Contact -->
        @php
        //Récupérer tous les messages des contacts
            use App\Models\Visiteur;
            $messages = Visiteur::all();
        @endphp
        <div class="container mx-auto mt-8">
            <h2 class="text-2xl font-bold mb-4">Messages de Contact</h2>
            <div class="bg-white shadow-md rounded-lg p-6">
                @if($messages->isEmpty())
                    <p>Aucun message de contact pour le moment.</p>
                @else
                    <ul>
                        @session('success')
                            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                                <p class="font-bold">Succès</p>
                                <p>{{ session('success') }}</p>
                            </div>
                        @endsession
                        @foreach($messages as $message)
                            <li class="border-b border-gray-200 py-2 flex justify-between items-center">
                                <div>
                                    <strong>De:</strong> 
                                    <a href="#" onclick="copyToClipboard('{{ $message->mailVisiteur }}')">{{$message->mailVisiteur}}</a></span> | {{$message->nomVisiteur}} {{$message->prenomVisiteur}}<span><br>
                                    <strong>Message:</strong> {{ $message->messageContact }}<br>
                                    <strong>Date:</strong> {{ $message->created_at->format('d/m/Y H:i') }}
                                </div>

                                <form action="{{ route('admin.destroyMessage') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{ $message->idVisiteur }}">
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg></button>
                                </form>

                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>


        <script>
            //Script pour copier l'email dans le presse papier
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
            alert('Email copié dans le presse-papier');
            }, function(err) {
            console.error('Erreur lors de la copie: ', err);
            });
        }
        </script>


</body>
</html>