<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Piece</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-300">
@include('partials.navbar')


<div class="container mx-auto mt-8">
    <div class="grid grid-rows-1 grid-cols-2">
        <div class="grid grid-rows-1 grid-cols-2">
            <div class="mt-4">
                <div class="bg-white shadow-md rounded p-3 w-72">
                    <p class="text-xl text-center">Nombre total de pièces</p>
                    <hr class="my-4">
                    <p class="text-center text-7xl font-bold text-red-800 ">{{ $pieces->count() }}</p>
             </div>
            </div>
        <div class="mt-4">
            <div class="bg-white shadow-md rounded p-3 w-72">
                <p class="text-xl text-center">Stock Total</p>
                <hr class="my-4">
                <p class="text-center text-7xl font-bold text-red-800 "> {{ $pieces->sum('stockPiece') }}</p>
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
            <form action="{{ route('admin.piece.create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @METHOD('POST')
                <div class="grid grid-cols-3 grid-rows-1 gap-4">
                    <div>
                        <h2 class="text-2xl font-bold">Gérer les pièces</h2>
                    </div>
                        <div> 
                            <select name="idEssence" id="idEssence" class="w-48 p-2 border border-gray-300 rounded mt-1" required>
                                <option value="">Choisir une essence</option>
                                @foreach($essences as $e)
                                    <option value="{{ $e->idEssence }}">{{ $e->varieteEssence }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="typePiece" id="typePiece" class="w-72 p-2 border border-gray-300 rounded mt-1" placeholder="Pièce" maxlength="15" required>
                            <textarea name="commentaire" id="commentaire" class="w-full p-2 border border-gray-300 rounded mt-1" placeholder="Description" required></textarea>
                            <input type="text" name="referencePiece" id="referencePiece" class="w-72 p-2 border border-gray-300 rounded mt-1" placeholder="Référence" maxlength="255" required>
                        </div>
                        <div>
                            <input type="numeric" name="prixHTPiece" id="prixHTPiece" class="w-20 p-2 border border-gray-300 rounded mt-1" placeholder="Prix" required>
                            <select name="exportablePiece" id="exportablePiece" class="w-48 p-2 border border-gray-300 rounded mt-1" required>
                                <option value="">Exportable</option>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                            <input type="numeric" name="stockPiece" id="stockPiece" class="w-20 p-2 border border-gray-300 rounded mt-1" placeholder="Stock" required>
                            <input type="file" name="photoPiece" id="photoPiece" class="w-fit p-2 border border-gray-300 rounded mt-1">
                            <div class="flex justify-center">
                                <button type="submit" class="w-full bg-red-800 hover:bg-red-950 text-white font-bold py-2 px-4 rounded mt-1">Ajouter une pièce</button>
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
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-left">Essence</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-left">Type</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-right">Prix</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-right">Stock</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-right">Référence</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-right">Exportable</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-right">Description</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-right">Photo</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pieces as $p)
                <tr>
                    <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $p->idPiece }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $p->essence->varieteEssence }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $p->typePiece }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-right">{{ $p->prixHTPiece }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-right">{{ $p->stockPiece }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-right">{{ $p->referencePiece }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-right">{{ $p->exportablePiece == 1 ? 'Oui' : 'Nom' }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-right">{{ $p->commentaire }}</td>
                    @if ($p->photoPiece)
                        <td class="py-2 px-4 border-b border-gray-200 text-right"><img 
                        src="data:image/jpeg;base64,{{ base64_encode($p->photoPiece) }}" 
                        alt="{{ $p->typePiece }} - {{$p->essence->varieteEssence}}" 
                        class="w-16 h-16 rounded-full float-right"></td>
                    @else
                        <td>Aucun Photo</td>
                    @endif
                <td class="py-2 px-4 border-b border-gray-200 text-right">
                <button onclick="openModal({{ $p->idPiece }})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded">Modifier</button>
                

                <!-- Modal -->
                <div id="modal-{{ $p->idPiece }}" class="fixed z-10 inset-0 overflow-y-auto hidden">
                    <div class="flex items-center justify-center min-h-screen">
                        <div class="bg-white p-6 rounded shadow-lg">
                            <h2 class="text-xl text-left mb-4">Modifier la pièce</h2>
                            <form action="{{ route('admin.piece.update', $p->idPiece) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <input type="hidden" name="idPiece" id="idPiece" value="{{ $p->idPiece }}">

                                    <label for="idEssence" class="block text-gray-700 text-left">Essence</label>
                                    <select name="idEssence" id="idEssence" class="w-full p-2 border border-gray-300 rounded mt-1">
                                        @foreach($essences as $e)
                                            <option value="{{ $e->idEssence }}" {{ $p->essence->idEssence == $e->idEssence ? 'selected' : '' }}>{{ $e->varieteEssence }}</option>
                                        @endforeach
                                    </select>

                                    <label for="typePiece" class="block text-gray-700 text-left">Type de pièce</label>
                                    <input type="text" name="typePiece" id="typePiece" value="{{ $p->typePiece }}" class="w-full p-2 border border-gray-300 rounded mt-1" maxlength="15" required>

                                    <label for="prixHTPiece" name="prixHTPiece" id="prixHTPiece" class="block text-gray-700 text-left">Prix</label>
                                    <input type="numeric" name="prixHTPiece" id="prixHTPiece" value="{{ $p->prixHTPiece }}" class="w-full p-2 border border-gray-300 rounded mt-1" required>

                                    <label for="stockPiece" name="stockPiece" id="stockPiece" class="block text-gray-700 text-left">Stock</label>
                                    <input type="numeric" name="stockPiece" id="stockPiece" value="{{ $p->stockPiece }}" class="w-full p-2 border border-gray-300 rounded mt-1" required>

                                    <label for="referencePiece" name="referencePiece" id="referencePiece" class="block text-gray-700 text-left">Référence</label>
                                    <input type="numeric" name="referencePiece" id="referencePiece" value="{{ $p->referencePiece }}" class="w-full p-2 border border-gray-300 rounded mt-1" maxlength="255" required>

                                    <select name="exportablePiece" id="exportablePiece" class="w-full p-2 border border-gray-300 rounded mt-1">
                                        <option value="1" {{ $p->exportablePiece == 1 ? 'selected' : '' }}>Oui</option>
                                        <option value="0" {{ $p->exportablePiece == 0 ? 'selected' : '' }}>Non</option>
                                    </select>

                                    <label for="commentaire" name="commentaire" id="commentaire" class="block text-gray-700 text-left">Description</label>
                                    <textarea name="commentaire" id="commentaire" class="w-full p-2 border border-gray-300 rounded mt-1" required>{{ $p->commentaire }}</textarea>

                                    @if($p->photoPiece)
                                        <img src="data:image/jpeg;base64,{{ base64_encode($p->photoPiece) }}" alt="{{ $p->typePiece }} - {{$p->essence->varieteEssence}}" class="w-16 h-16 rounded-full float-right">
                                    @endif
                                    
                                    <label for="photoPiece" name="photoPiece" id="photoPiece" class="block text-gray-700 text-left">Modifier la photo</label>
                                    <input type="file" name="photoPiece" id="photoPiece" class="w-fit p-2 border border-gray-300 rounded mt-1">     
                                </div>
                                <div class="flex justify-end">
                                    <button type="button" onclick="closeModal({{ $p->idPiece }})" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-3 rounded mr-2">Annuler</button>
                                    <button type="submit" class="bg-red-800 hover:bg-red-950 text-white font-bold py-1 px-3 rounded">Enregistrer</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.piece.destroy', $p->idPiece) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette pièce ?')">Supprimer</button>
                </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    //Script pour ouvrir le modal
    function openModal(id) {
        document.getElementById('modal-' + id).classList.remove('hidden');
    }
    //Script pour fermer le modal
    function closeModal(id) {
        document.getElementById('modal-' + id).classList.add('hidden');
    }
</script>

</body>
</html>