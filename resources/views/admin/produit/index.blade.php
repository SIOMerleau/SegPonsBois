<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Produit</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-300">
@include('partials.navbar')


<div class="container mx-auto mt-8">
    <div class="grid grid-rows-1 grid-cols-2">
        <div class="grid grid-rows-1 grid-cols-2">
            <div class="mt-4">
                <div class="bg-white shadow-md rounded p-3 w-72">
                    <p class="text-xl text-center">Nombre total de produits</p>
                    <hr class="my-4">
                    <p class="text-center text-7xl font-bold text-amber-600 ">{{ $produits->count() }}</p>
             </div>
            </div>
        <div class="mt-4">
            <div class="bg-white shadow-md rounded p-3 w-72">
                <p class="text-xl text-center">Stock Total</p>
                <hr class="my-4">
                <p class="text-center text-7xl font-bold text-amber-600 "> {{ $produits->sum('stockProduit') }}</p>
            </div>
        </div>
    </div>
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


    <div class="flex justify-between items-center p-4 bg-gray-50 shadow-md rounded-lg mt-4">
            <form action="{{ route('admin.produit.create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @METHOD('POST')
                <div class="grid grid-cols-3 grid-rows-1 gap-4">
                    <div>
                        <h2 class="text-2xl font-bold">Gérer les produits</h2>
                    </div>
                        <div> 
                            <select name="idCategorie" id="idCategorie" class="w-48 p-2 border border-gray-300 rounded mt-1" required>
                                <option value="">Choisir une catégorie</option>
                                @foreach($categories as $c)
                                    <option value="{{ $c->idCategorie }}">{{ $c->libelleCategorie }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="designationProduit" id="designationProduit" class="w-72 p-2 border border-gray-300 rounded mt-1" placeholder="Nom du produit" required>
                            <textarea name="descriptionProduit" id="descriptionProduit" class="w-full p-2 border border-gray-300 rounded mt-1" placeholder="Description" required></textarea>
                        </div>
                        <div>
                            <input type="numeric" name="prixProduit" id="prixProduit" class="w-20 p-2 border border-gray-300 rounded mt-1" placeholder="Prix" required>
                            <input type="numeric" name="stockProduit" id="stockProduit" class="w-20 p-2 border border-gray-300 rounded mt-1" placeholder="Stock" required>
                            <input type="file" name="photoProduit" id="photoProduit" class="w-fit p-2 border border-gray-300 rounded mt-1">
                            <div class="flex justify-center">
                                <button type="submit" class="w-full bg-amber-600 hover:bg-amber-800 text-white font-bold py-2 px-4 rounded mt-1">Ajouter un produit</button>
                            </div>
                        </div>
                    </div>
                </div>  
            </form>
        </div>
    </div>

    <div class="container mx-auto bg-white shadow-md rounded my-6">

        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-left">ID</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-left">Catégorie</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-left">Nom</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-right">Prix</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-right">Stock</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-right">Description</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-right">Photo</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produits as $p)
                <tr>
                    <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $p->idProd }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $p->categorie->libelleCategorie }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $p->designationProduit }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-right">{{ $p->prixProduit }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-right">{{ $p->stockProduit }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-right">{{ $p->descriptionProduit }}</td>
                    @if ($p->photoProduit)
                        <td class="py-2 px-4 border-b border-gray-200 text-right"><img 
                        src="data:image/jpeg;base64,{{ base64_encode($p->photoProduit) }}" 
                        alt="{{ $p->designationProduit }}" 
                        class="w-16 h-16 rounded-full float-right"></td>
                    @else
                        <td>Aucun Photo</td>
                    @endif
                <td class="py-2 px-4 border-b border-gray-200 text-right">
                <button onclick="openModal({{ $p->idProd }})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded">Modifier</button>
                

                <!-- Modal -->
                <div id="modal-{{ $p->idProd }}" class="fixed z-10 inset-0 overflow-y-auto hidden">
                    <div class="flex items-center justify-center min-h-screen">
                        <div class="bg-white p-6 rounded shadow-lg">
                            <h2 class="text-xl text-left mb-4">Modifier le produit</h2>
                            <form action="{{ route('admin.produit.update', $p->idProd) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <input type="hidden" name="idProd" id="idProd" value="{{ $p->idProd }}">

                                    <label for="idCategorie" class="block text-gray-700 text-left">Catégorie</label>
                                    <select name="idCategorie" id="idCategorie" class="w-full p-2 border border-gray-300 rounded mt-1">
                                        @foreach($categories as $c)
                                            <option value="{{ $c->idCategorie }}" {{ $p->categorie->idCategorie == $c->idCategorie ? 'selected' : '' }}>{{ $c->libelleCategorie }}</option>
                                        @endforeach
                                    </select>

                                    <label for="designationProduit" class="block text-gray-700 text-left">Nom du produit</label>
                                    <input type="text" name="designationProduit" id="designationProduit" value="{{ $p->designationProduit }}" class="w-full p-2 border border-gray-300 rounded mt-1" required>

                                    <label for="prixProduit" name="prixProduit" id="prixProduit" class="block text-gray-700 text-left">Prix</label>
                                    <input type="numeric" name="prixProduit" id="prixProduit" value="{{ $p->prixProduit }}" class="w-full p-2 border border-gray-300 rounded mt-1" required>

                                    <label for="stockProduit" name="stockProduit" id="stockProduit" class="block text-gray-700 text-left">Stock</label>
                                    <input type="numeric" name="stockProduit" id="stockProduit" value="{{ $p->stockProduit }}" class="w-full p-2 border border-gray-300 rounded mt-1" required>

                                    <label for="descriptionProduit" name="descriptionProduit" id="descriptionProduit" class="block text-gray-700 text-left">Description</label>
                                    <textarea name="descriptionProduit" id="descriptionProduit" class="w-full p-2 border border-gray-300 rounded mt-1" required>{{ $p->descriptionProduit }}</textarea>

                                    @if($p->photoProduit)
                                        <img src="data:image/jpeg;base64,{{ base64_encode($p->photoProduit) }}" alt="{{ $p->designationProduit }}" class="w-16 h-16 rounded-full float-right">
                                    @endif
                                    
                                    <label for="photoProduit" name="photoProduit" id="photoProduit" class="block text-gray-700 text-left">Modifier la photo</label>
                                    <input type="file" name="photoProduit" id="photoProduit" class="w-fit p-2 border border-gray-300 rounded mt-1">     
                                </div>
                                <div class="flex justify-end">
                                    <button type="button" onclick="closeModal({{ $p->idProd }})" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-3 rounded mr-2">Annuler</button>
                                    <button type="submit" class="bg-amber-600 hover:bg-amber-800 text-white font-bold py-1 px-3 rounded">Enregistrer</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.produit.destroy', $p->idProd) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</button>
                </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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

</body>
</html>