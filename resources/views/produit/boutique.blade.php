<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boutique</title>
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
    <h1 class="text-5xl font-bold text-center mb-8 text-gray-900">Boutique Produits</h1>

    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      @foreach ($produits as $p)
        <li class="bg-white rounded-lg shadow-lg p-4 hover:shadow-xl transition duration-300 cursor-pointer" onclick="openModal({{ $p->idProd }})">
            <div class="flex justify-center">
                <a href="#" class="block text-xl font-semibold text-blue-600 hover:text-blue-800 mb-2 produit-toggle">
                {{ $p->designationProduit }}</a>
            </div>

            <div class="flex justify-center">
                <p class="text-gray-500">{{ $p->categorie->libelleCategorie }}</p>
            </div>

            @if ($p->photoProduit)
                <div class="flex justify-center">
                    <img src="data:image/jpeg;base64,{{ base64_encode($p->photoProduit) }}" alt="{{ $p->designationProduit }}" class="mt-4 w-fit h-48 object-cover rounded-lg">
                </div>
            @endif

            <div class="flex justify-center mt-4">
                <p class="text-2xl">{{ $p->prixProduit }}€<span class="text-sm text-gray-500">TTC</span></p>
            </div>

            <div class="flex justify-between mt-4">
                <div class="flex items-center">
                    <span id="rating-{{ $p->idProd }}" class="flex text-yellow-500 text-2xl">
                    @if($p->avis->count() > 0)
                        @php
                        $averageRating = $p->avis->avg('etoilesAvis');
                        $fullStars = floor($averageRating);
                        $halfStar = $averageRating - $fullStars >= 0.5;
                    @endphp
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $fullStars)
                            <span class="star-rating cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                            </svg>
                            </span>
                        @elseif ($i == $fullStars + 1 && $halfStar)
                            <span class="star-rating cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>
                            </span>
                        @else
                            <span class="star-rating cursor-pointer text-gray-300"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                            </svg>
                            </span>
                        @endif
                    @endfor
                        <span class="text-gray-400 text-sm sm:text-xs">({{$averageRating}})</span>
                    @else
                        @for($i = 0; $i < 5; $i++)
                            <span class="star-rating cursor-pointer text-gray-300"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                            </svg>
                            </span>
                        @endfor
                            <span class="text-gray-400 text-sm sm:text-xs">(0.0)</span>
                    @endif
                </span>
            </div>


            <form action="{{ route('panier.add', $p->idProd) }}" id="add-to-cart-{{ $p->idProd }}" method="POST" class="flex items-center">
                @csrf
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="price" value="{{ $p->prixProduit }}">
                <button type="button" onclick="checkAuthPanier({{ $p->idProd }})" class="px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                </button>
            </form>
            
          </div>
        </li>
      @endforeach
    </ul>
  </div>
</div>

@foreach($produits as $p)
<!-- Modal -->
<div id="modal-{{ $p->idProd }}" class="fixed z-10 inset-0 overflow-y-auto hidden bg-black bg-opacity-50">
  <div class="flex items-center justify-center min-h-screen p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full mx-auto overflow-hidden">
      <div class="p-6">
        <div class="flex justify-between items-start mb-4">
          <div>
            <h2 class="text-2xl font-semibold text-gray-900 leading-tight">
              {{$p->categorie->libelleCategorie}} {{$p->designationProduit}}
            </h2>
          </div>
          <button type="button" onclick="closeModal({{ $p->idProd }})" class="text-gray-500 hover:text-gray-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="space-y-2 text-gray-700">
          <p><strong>Prix :</strong> {{$p->prixProduit}} €</p>
          <p><strong>Stock :</strong> {{$p->stockProduit}}</p>
          <p><strong>Description :</strong> {{$p->descriptionProduit}}</p>
        </div>
      </div>

      <div class="bg-gray-100 p-6 border-t border-gray-200">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">Avis des utilisateurs</h3>
        <span>
            <form id="form-avis-{{ $p->idProd }}" action="{{ route('avis.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <input type="hidden" name="idProduit" value="{{ $p->idProd }}">
                    <label for="etoilesAvis" class="block text-sm font-medium text-gray-700">Évaluation</label>
                    <div class="flex items-center">
                        @for ($i = 1; $i <= 5; $i ++)
                            <input type="radio" id="etoilesAvis-{{ $i }}" name="etoilesAvis" value="{{ $i }}" class="hidden">
                            <label for="etoilesAvis-{{ $i }}" class="cursor-pointer star-label" data-value="{{ $i }}">
                            @if (fmod($i, 1) == 0)
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                </svg>
                            @endif
                            </label>
                        @endfor
                    </div>
                </div>
                <div class="mb-4">
                    <label for="texteAvis" class="block text-sm font-medium text-gray-700">Votre avis</label>
                    <textarea id="texteAvis" name="texteAvis" rows="4" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                </div>
                <button type="button" onclick="checkAuthAvis({{ $p->idProd }})" class="px-4 py-2 bg-blue-500 text-white rounded">Soumettre l'avis</button>
            </form>
        </span>
        
        <div class="space-y-4">
            @if ($p->avis->count() > 0)
                @foreach ($p->avis as $avis)
                    <div class="bg-white rounded-lg shadow p-4">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex text-yellow-500">
                                @php
                                $avisRating = $avis->etoilesAvis;
                                $fullStars = floor($avisRating);
                                @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $fullStars)
                                        <span class="star-rating cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                        </svg></span>
                                    @else
                                        <span class="star-rating cursor-pointer text-gray-300"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                        </svg></span>
                                    @endif
                                @endfor
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ $avis->user ? $avis->user->name : 'Utilisateur inconnu' }} {{$avis->user ? $avis->user->username : ''}} - {{ \Carbon\Carbon::parse($avis->dateAvis)->format('d/m/Y') }}
                            </div>
                        </div>
                            <p class="text-gray-700">{{ $avis->texteAvis }}</p>
                    </div>
                @endforeach
            @else
                <p class="text-gray-500">Aucun avis pour ce produit.</p>
            @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach

<script> 
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

//Colorie des étoiles + enregistrement de la note dans le formulaire dans un champ input
    document.querySelectorAll('.star-label').forEach(label => {
        label.addEventListener('click', function() {
            const value = this.getAttribute('data-value');
            const form = this.closest('form');
            const stars = form.querySelectorAll('.star-label');

            //Colorie les étoiles
            stars.forEach(star => {
                const starValue = star.getAttribute('data-value');
                if (starValue <= value) {
                    star.querySelector('svg').classList.add('text-yellow-500');
                    star.querySelector('svg').classList.remove('text-gray-300');
                } else {
                    star.querySelector('svg').classList.add('text-gray-300');
                    star.querySelector('svg').classList.remove('text-yellow-500');
                }
            });
            //On coche la sélection dans le formulaire
            form.querySelector(`input[name="etoilesAvis"][value="${value}"]`).checked = true;
        });
    });

//Fonction pour vérifier si l'utilisateur est connecté pour ajouter un produit au panier
function checkAuthPanier(idProd) {
     @auth document.getElementById('add-to-cart-' + idProd).submit(); 
     @else window.location.href = "{{ route('user.login') }}"; 
     @endauth 
    }
    

//Fonction pour vérifier si l'utilisateur est connecté pour soumettre un avis et vérifier si une note a été sélectionnée
    function checkAuthAvis(idProd){
        //On vérifie si une note a été sélectionnée
        if(document.querySelector('input[name="etoilesAvis"]:checked') == null){
            alert('Veuillez sélectionner une note avant de soumettre votre avis.');
            return;
        }
        @auth //Si l'utilisateur est connecté on submit le formulaire
            document.getElementById('form-avis-' + idProd).submit();
        @else //Sinon redirection vers la page de connexion
            window.location.href = '{{route('user.index')}}';
        @endauth
    }
    </script>
</body>
@include('partials.footer')
</html>
