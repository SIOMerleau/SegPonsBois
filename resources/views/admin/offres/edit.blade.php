<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Offre</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-300">
@include('partials.navbar')

<div class="container mx-auto mt-4">
    <h1 class="text-2xl font-bold mb-4">Modifier l'Offre</h1>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mt-4" role="alert">
            <p class="font-bold">Succès</p>
            <p>{{ session('success') }}</p>
        </div>
    @elseif(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mt-4" role="alert">
            <p class="font-bold">Erreur</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <form action="{{ route('admin.offre.update', $offre->idOffre) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded p-6">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nomOffre" class="block text-gray-700 font-bold mb-2">Nom de l'Offre</label>
            <input type="text" id="nomOffre" name="nomOffre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nomOffre') border-red-500 @enderror" value="{{ old('nomOffre', $offre->nomOffre) }}" required>
            @error('nomOffre')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="date_debut" class="block text-gray-700 font-bold mb-2">Date de Début</label>
            <input type="date" id="date_debut" name="date_debut" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('date_debut') border-red-500 @enderror" value="{{ old('date_debut', $offre->date_debut) }}" required>
            @error('date_debut')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="date_fin" class="block text-gray-700 font-bold mb-2">Date de Fin</label>
            <input type="date" id="date_fin" name="date_fin" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('date_fin') border-red-500 @enderror" value="{{ old('date_fin', $offre->date_fin) }}" required>
            @error('date_fin')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="idProd_Produit" class="block text-gray-700 font-bold mb-2">Produit</label>
            <select id="idProd_Produit" name="idProd_Produit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('idProd_Produit') border-red-500 @enderror" required>
                @foreach($produits as $produit)
                    <option value="{{ $produit->idProd }}" {{ $offre->concerner->idProd_Produit == $produit->idProd ? 'selected' : '' }}>
                        {{ $produit->designationProduit }}
                    </option>
                @endforeach
            </select>
            @error('idProd_Produit')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="prixOffre" class="block text-gray-700 font-bold mb-2">Prix de l'Offre</label>
            <input type="number" id="prixOffre" name="prixOffre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('prixOffre') border-red-500 @enderror" value="{{ old('prixOffre', $offre->concerner->prixOffre) }}" step="0.01" required>
            @error('prixOffre')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="quantiteOf" class="block text-gray-700 font-bold mb-2">Quantité</label>
            <input type="number" id="quantiteOf" name="quantiteOf" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('quantiteOf') border-red-500 @enderror" value="{{ old('quantiteOf', $offre->concerner->quantiteOf) }}" min="1" required>
            @error('quantiteOf')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Modifier l'Offre</button>
        <a href="{{ route('admin.offre.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">Annuler</a>
    </form>
</div>
</body>
</html>
