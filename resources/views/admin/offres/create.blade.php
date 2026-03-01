<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Créer une Offre</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-center mb-6">Créer une Nouvelle Offre</h1>

    <!-- Formulaire -->
    <form action="{{ route('admin.offre.store') }}" method="POST" class="bg-white shadow-md rounded px-8 py-6">
        @csrf

        <!-- Nom de l'offre -->
        <div class="mb-4">
            <label for="nomOffre" class="block text-gray-700 font-bold mb-2">Nom de l'Offre</label>
            <input type="text" id="nomOffre" name="nomOffre" class="w-full px-4 py-2 border rounded" placeholder="Ex: Offre spéciale Noël" required>
        </div>

        <!-- Date de début -->
        <div class="mb-4">
            <label for="date_debut" class="block text-gray-700 font-bold mb-2">Date de Début</label>
            <input type="date" id="date_debut" name="date_debut" class="w-full px-4 py-2 border rounded" required>
        </div>

        <!-- Date de fin -->
        <div class="mb-4">
            <label for="date_fin" class="block text-gray-700 font-bold mb-2">Date de Fin</label>
            <input type="date" id="date_fin" name="date_fin" class="w-full px-4 py-2 border rounded" required>
        </div>

        <!-- Produit -->
        <div class="mb-4">
            <label for="idProd_Produit" class="block text-gray-700 font-bold mb-2">Produit</label>
            <select id="idProd_Produit" name="idProd_Produit" class="w-full px-4 py-2 border rounded">
                @foreach ($produits as $produit)
                    <option value="{{ $produit->idProd }}">{{ $produit->designationProduit }}</option>
                @endforeach
            </select>
        </div>

        <!-- Prix de l'offre -->
        <div class="mb-4">
            <label for="prixOffre" class="block text-gray-700 font-bold mb-2">Prix de l'Offre</label>
            <input type="number" id="prixOffre" name="prixOffre" class="w-full px-4 py-2 border rounded" placeholder="Ex: 50" required>
        </div>

        <!-- Quantité de l'offre -->
        <div class="mb-4">
            <label for="quantiteOf" class="block text-gray-700 font-bold mb-2">Quantité</label>
            <input type="number" id="quantiteOf" name="quantiteOf" class="w-full px-4 py-2 border rounded" placeholder="Ex: 100" required>
        </div>

        <!-- Bouton de soumission -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Créer l'Offre</button>
        </div>
    </form>
</div>

</body>
</html>
