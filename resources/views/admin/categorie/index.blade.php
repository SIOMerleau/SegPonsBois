<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Catégorie</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-300">
@include('partials.navbar')


<div class="container mx-auto mt-4">
    <div class="bg-white shadow-md rounded p-3 w-72">
        <p class="text-xl text-center">Nombre total de catégories</p>
        <hr class="my-4">
        <p class="text-center text-7xl font-bold text-blue-500 ">{{ $categories->count() }}</p>
    </div>

    @session('success')
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mt-4" role="alert">
            <p class="font-bold">Succès</p>
            <p>{{ session('success') }}</p>
        </div>
    @endsession

    @session('error')
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mt-4" role="alert">
            <p class="font-bold">Erreur</p>
            <p>{{ session('error') }}</p>
        </div>
    @endsession
</div>

<div class="container mx-auto mt-8">
    <div class="flex justify-between items-center p-4 bg-gray-50 shadow-md rounded-lg">
        <h2 class="text-2xl font-bold">Gérer les catégories</h2>
            <form action="{{ route('admin.categorie.create')}}" method="POST">
                @csrf
                @METHOD('POST') 
                <input type="text" name="libelleCategorie" id="libelleCategorie" class="w-96 p-2 border border-gray-300 rounded mt-1 float-left" placeholder="Nom de la catégorie" required>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2 mt-1 float-right">Ajouter une catégorie</button>
            </form>
    </div>

    <div class="bg-white shadow-md rounded my-6">

        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-left">ID</th>
                <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-left">Nom</th>
                <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-right">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $categorie)
            <tr>
                <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $categorie->idCategorie }}</td>
                <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $categorie->libelleCategorie }}</td>
                <td class="py-2 px-4 border-b border-gray-200 text-right">
                <button onclick="openModal({{ $categorie->idCategorie }})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded">Modifier</button>

                <!-- Modal -->
                <div id="modal-{{ $categorie->idCategorie }}" class="fixed z-10 inset-0 overflow-y-auto hidden">
                    <div class="flex items-center justify-center min-h-screen">
                        <div class="bg-white p-6 rounded shadow-lg">
                            <h2 class="text-xl text-left mb-4">Modifier la catégorie</h2>
                            <form action="{{ route('admin.categorie.update', $categorie->idCategorie) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <input type="hidden" name="idCategorie" value="{{ $categorie->idCategorie }}">
                                    <label for="libelleCategorie" class="block text-gray-700 text-left">Nom de la catégorie</label>
                                    <input type="text" name="libelleCategorie" id="libelleCategorie" value="{{ $categorie->libelleCategorie }}" class="w-full p-2 border border-gray-300 rounded mt-1">
                                </div>
                                <div class="flex justify-end">
                                    <button type="button" onclick="closeModal({{ $categorie->idCategorie }})" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-3 rounded mr-2">Annuler</button>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                function openModal(id) {
                    document.getElementById('modal-' + id).classList.remove('hidden');
                }

                function closeModal(id) {
                    document.getElementById('modal-' + id).classList.add('hidden');
                }
                </script>


                <form action="{{ route('admin.categorie.destroy', $categorie->idCategorie) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">Supprimer</button>
                </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </table>
    </div>
</div>
</body>
</html>