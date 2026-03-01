<li class="px-4 py-4 sm:px-6 flex flex-col sm:flex-row items-center"> {{-- Flex column sur mobile, row sur sm et plus --}}
    <img src="data:image/jpeg;base64,{{ base64_encode($item->photoProduit ?? $item->photoPiece ?? $item->concerner->produit->photoProduit ?? '') }}" alt="{{ $item->designationProduit ?? $item->typePiece ?? $item->nomOffre }}" class="w-20 h-20 object-cover rounded-lg mr-0 mb-4 sm:mr-4 sm:mb-0 shadow"> {{-- Marges adaptées --}}
    <div class="flex-grow sm:text-left text-center mb-4 sm:mb-0"> {{-- Alignement du texte --}}
        <h2 class="text-lg font-medium text-gray-800">{{ $item->designationProduit ?? $item->typePiece ?? $item->nomOffre }}</h2>
        <p class="text-gray-600 text-sm">
            @if ($type === 'produit')
                {{ $item->pivot->quantitePr }} x {{ $item->pivot->prixPr }} €
            @elseif ($type === 'piece')
                {{ $item->pivot->quantitePc }} x {{ $item->pivot->prixPc }} €
            @else
              Prix unitaire : {{ $item->concerner->prixOffre }} € - Quantité : {{ $item->pivot->quantiteOf }}
              @if($item->concerner->produit)
                <br>Produit inclus : {{ $item->concerner->produit->designationProduit }}
              @endif
            @endif
        </p>
    </div>
    <div class="flex items-center space-x-2 flex-wrap justify-center sm:justify-end"> {{-- Gestion du retour à la ligne des boutons sur mobile --}}
        <form action="{{ route('panier.decrease' . ($type === 'piece' ? 'Piece' : ($type === 'offre' ? 'OffreQuantity' : '')), $item->idProd ?? $item->idPiece ?? $item->idOffre) }}" method="POST">
            @csrf
            <button type="submit" class="px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded">-</button>
        </form>
        <form action="{{ route('panier.increase' . ($type === 'piece' ? 'Piece' : ($type === 'offre' ? 'OffreQuantity' : '')), $item->idProd ?? $item->idPiece ?? $item->idOffre) }}" method="POST">
            @csrf
            <button type="submit" class="px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded">+</button>
        </form>
        <form action="{{ route('panier.remove' . ($type === 'piece' ? 'Piece' : ($type === 'offre' ? 'Offre' : '')), $item->idProd ?? $item->idPiece ?? ['idOffre' => $item->idOffre]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-2 py-1 bg-red-500 hover:bg-red-600 text-white rounded">Supprimer</button>
        </form>
    </div>
</li>