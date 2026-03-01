<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérez les Offres</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-300">
@include('partials.navbar')

<div class="container mx-auto mt-4">
    <h1 class="text-2xl font-bold mb-4">Gérer les Offres</h1>

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

    <div class="mb-3 flex justify-end">
        <a href="{{ route('admin.offre.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Créer une Nouvelle Offre</a>
    </div>

    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">#</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Nom de l'Offre</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Produit</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Prix</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Quantité</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Date de Début</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Date de Fin</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($offres as $offre)
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $offre->id }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $offre->nomOffre }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $offre->concerner->produit->designationProduit ?? 'N/A' }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $offre->concerner->prixOffre }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $offre->concerner->quantiteOf }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $offre->date_debut }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $offre->date_fin }}</td>
                        <td class="py-2 px-4 border-b border-gray-200 text-right">
                            <a href="{{ route('admin.offre.edit', $offre->idOffre) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded">Modifier</a>
                            <form action="{{ route('admin.offre.destroy', ['idOffre' => $offre->idOffre]) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette offre ?');"> @csrf @method('DELETE') <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 transition"> Supprimer </button> </form>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
