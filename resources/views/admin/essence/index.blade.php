<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Essence</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-300">
@include('partials.navbar')


<div class="container mx-auto mt-8">
    <div class="grid grid-rows-1 grid-cols-2">
        <div class="grid grid-rows-1 grid-cols-2">
            <div class="mt-4">
                <div class="bg-white shadow-md rounded p-3 w-72">
                    <p class="text-xl text-center">Nombre total d'essences</p>
                    <hr class="my-4">
                    <p class="text-center text-7xl font-bold text-lime-600 ">{{ $essences->count() }}</p>
             </div>
            </div>
        <div class="mt-4">
            <div class="bg-white shadow-md rounded p-3 w-72">
                <p class="text-xl text-center">Types d'essences différentes</p>
                <hr class="my-4">
                <p class="text-center text-7xl font-bold text-lime-600 "> {{ $essences->count('typeEssence') }}</p>
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
            <form action="{{ route('admin.essence.create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @METHOD('POST')
                <div class="grid grid-cols-3 grid-rows-1 gap-4">
                    <div>
                        <h2 class="text-2xl font-bold">Gérer les essences</h2>
                    </div>

                    <div> 
                        <input type="text" name="varieteEssence" id="varieteEssence" class="w-72 p-2 border border-gray-300 rounded mt-1" placeholder="Nom de l'essence" required>

                        <select name="typeEssence" id="typeEssence" class="w-72 p-2 border border-gray-300 rounded mt-1" required onchange="toggleCustomTypeInput()">
                            <option value="">Choisir un type d'essence</option>
                                @foreach($essences as $e)
                                    @if(!$loop->first && $essences->where('typeEssence', $e->typeEssence)->count() > 1)
                                        @continue
                                    @endif
                                        <option value="{{ $e->typeEssence }}">{{ $e->typeEssence }}</option>
                                @endforeach
                            <option value="custom">Ajouter un type</option>
                        </select>

                        <input type="text" name="customTypeEssence" id="customTypeEssence" class="w-72 p-2 border border-gray-300 rounded mt-1 hidden" placeholder="Nom du type personnalisé">

                        <input type="text" name="nomLatinEssence" id="nomLatinEssence" class="w-72 p-2 border border-gray-300 rounded mt-1" placeholder="Nom latin" required>

                        <select name="origineEssence" id="origineEssence" class="w-72 p-2 border border-gray-300 rounded mt-1" required onchange="toggleCustomOrigineInput()">
                            <option value="">Choisir une origine d'essence</option>
                            @foreach($essences as $e)
                                    @if(!$loop->first && $essences->where('origineEssence', $e->origineEssence)->count() > 1)
                                        @continue
                                    @endif
                                        <option value="{{ $e->origineEssence }}">{{ $e->origineEssence }}</option>
                                @endforeach
                            <option value="custom">Ajouter une origine</option>
                        </select>

                        <input type="text" name="customOrigineEssence" id="customOrigineEssence" class="w-72 p-2 border border-gray-300 rounded mt-1 hidden" placeholder="Origine d'essence personnalisé">

                        <input type="text" name="densiteEssence" id="densiteEssence" class="w-72 p-2 border border-gray-300 rounded mt-1" placeholder="Densité" required>

                        <select name="durabiliteEssence" id="durabiliteEssence" class="w-72 p-2 border border-gray-300 rounded mt-1" required onchange="toggleCustomDurabiliteInput()">
                            <option value="">Choisir la durabilité</option>
                            @foreach($essences as $e)
                                    @if(!$loop->first && $essences->where('durabiliteEssence', $e->durabiliteEssence)->count() > 1)
                                        @continue
                                    @endif
                                        <option value="{{ $e->durabiliteEssence }}">{{ $e->durabiliteEssence }}</option>
                                @endforeach
                            <option value="custom">Ajouter une durabilité</option>
                        </select>

                        <input type="text" name="customDurabiliteEssence" id="customDurabiliteEssence" class="w-72 p-2 border border-gray-300 rounded mt-1 hidden" placeholder="Durabilité d'essence personnalisé">

                        <textarea name="commentaireEssence" id="commentaireEssence" class="w-full p-2 border border-gray-300 rounded mt-1" placeholder="Commentaire" required></textarea>

                        <input type="file" name="photoEssence" id="photoEssence" class="w-fit p-2 border border-gray-300 rounded mt-1">

                        <button type="submit" class="w-full bg-lime-600 hover:bg-lime-800 text-white font-bold py-2 px-4 rounded mt-1">Ajouter une essence</button>
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
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-left">Variété</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-left">Type</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-right">Nom Latin</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-right">Origine</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-right">Densité</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-right">Durabilité</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-right">Commentaire</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-right">Photo</th>
                    <th class="py-2 px-4 bg-gray-200 font-bold uppercase text-sm text-gray-600 border-b border-gray-200 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($essences as $e)
                <tr>
                    <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $e->idEssence }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $e->varieteEssence }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $e->typeEssence }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $e->nomLatinEssence }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-right">{{ $e->origineEssence }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-right">{{ $e->densiteEssence }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-right">{{ $e->durabiliteEssence }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 text-right">{{ $e->commentaireEssence }}</td>
                    @if ($e->photoEssence)
                        <td class="py-2 px-4 border-b border-gray-200 text-right"><img 
                        src="data:image/jpeg;base64,{{ base64_encode($e->photoEssence) }}" 
                        alt="{{ $e->varieteEssence }}" 
                        class="w-16 h-16 rounded-full float-right"></td>
                    @else
                        <td>Aucune Photo</td>
                    @endif
                <td class="py-2 px-4 border-b border-gray-200 text-right">
                <button onclick="openModal({{ $e->idEssence }})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded">Modifier</button>
                

                <!-- Modal -->
                <div id="modal-{{ $e->idEssence }}" class="fixed z-10 inset-0 overflow-y-auto hidden">
                    <div class="flex items-center justify-center min-h-screen">
                        <div class="bg-white p-6 rounded shadow-lg">
                            <h2 class="text-xl text-left mb-4">Modifier l'essence</h2>
                            <form action="{{ route('admin.essence.update', $e->idEssence) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <div class="grid grid-cols-3 grid-rows-3 gap-3">

                                    <input type="hidden" name="idEssence" id="idEssence" value="{{ $e->idEssence }}">

                                    <div>
                                        <label for="varieteEssence" class="block text-gray-700 text-left">Variété</label>
                                        <input type="text" name="varieteEssence" id="varieteEssence" class="w-full p-2 border border-gray-300 rounded mt-1" value="{{$e->varieteEssence}}" required>
                                    </div>

                                    <div>
                                    <label for="typeEssence" class="block text-gray-700 text-left">Type Essence</label>
                                    <select name="typeEssence" id="typeEssence" class="block w-full p-2 border border-gray-300 rounded mt-1" required onchange="toggleCustomTypeInputModal()">
                                        <option value="">Choisir un type d'essence</option>
                                        @foreach($essences as $essence)
                                            @if(!$loop->first && $essences->where('typeEssence', $essence->typeEssence)->count() > 1)
                                                @continue
                                            @endif
                                            <option value="{{ $essence->typeEssence }}" {{ $essence->typeEssence == $e->typeEssence ? 'selected' : '' }}>{{ $essence->typeEssence }}</option>
                                        @endforeach
                                        <option value="custom">Ajouter un type</option>
                                    </select>
                                    <input type="text" name="customTypeEssence" id="customTypeEssence" class="w-full p-2 border border-gray-300 rounded mt-1 hidden" placeholder="Nom du type personnalisé" maxlength="15">
                                    </div>

                                    <div>
                                        <label for="nomLatinEssence" class="block text-gray-700 text-left">Nom latin</label>
                                        <input type="text" name="nomLatinEssence" id="nomLatinEssence" class="w-full p-2 border border-gray-300 rounded mt-1" value="{{$e->nomLatinEssence}}" required maxlength="30">
                                    </div>
                                    
                                    <div>
                                    <label for="origineEssence" class="block text-gray-700 text-left">Origine</label>
                                    <select name="origineEssence" id="origineEssence" class="block w-full p-2 border border-gray-300 rounded mt-1" required onchange="toggleCustomOrigineInputModal()">
                                        <option value="">Choisir une origine d'essence</option>
                                        @foreach($essences as $essence)
                                            @if(!$loop->first && $essences->where('origineEssence', $essence->origineEssence)->count() > 1)
                                                @continue
                                            @endif
                                        <option value="{{ $essence->origineEssence }}"{{ $essence->origineEssence == $e->origineEssence ? 'selected' : '' }}>{{ $essence->origineEssence }}</option>
                                        @endforeach
                                        <option value="custom">Ajouter une origine</option>
                                    </select>
                                    <input type="text" name="customOrigineEssence" id="customOrigineEssence" class="w-full p-2 border border-gray-300 rounded mt-1 hidden" placeholder="Origine d'essence personnalisé" maxlength="20">
                                    </div>

                                    <div>
                                        <label for="densiteEssence" class="block text-gray-700 text-left">Densité</label>
                                        <input type="text" name="densiteEssence" id="densiteEssence" class="w-full p-2 border border-gray-300 rounded mt-1" value="{{$e->densiteEssence}}" required maxlength="15">
                                    </div>

                                    <div>
                                    <label for="durabiliteEssence" class="block text-gray-700 text-left">Durabilité</label>
                                    <select name="durabiliteEssence" id="durabiliteEssence" class="block w-full p-2 border border-gray-300 rounded mt-1" required onchange="toggleCustomDurabiliteInputModal()">
                                        <option value="">Choisir la durabilité</option>
                                        @foreach($essences as $essence)
                                            @if(!$loop->first && $essences->where('durabiliteEssence', $essence->durabiliteEssence)->count() > 1)
                                                @continue
                                            @endif
                                                <option value="{{ $essence->durabiliteEssence }}"{{ $essence->durabiliteEssence == $e->durabiliteEssence ? 'selected' : '' }}>{{ $essence->durabiliteEssence }}</option>
                                        @endforeach
                                        <option value="custom">Ajouter une durabilité</option>
                                    </select>
                                    <input type="text" name="customDurabiliteEssence" id="customDurabiliteEssence" class="w-full p-2 border border-gray-300 rounded mt-1 hidden" placeholder="Durabilité d'essence personnalisé" maxlength="15">
                                    </div>

                                    <div>
                                        <label for="commentaireEssence" class="block text-gray-700 text-left">Commentaire</label>
                                        <textarea name="commentaireEssence" id="commentaireEssence" class="w-full p-2 border border-gray-300 rounded mt-1" required>{{ $e->commentaireEssence }}</textarea>
                                    </div>

                                    <div>
                                    <label for="photoEssence" name="photoEssence" id="photoEssence" class="block text-gray-700 text-left">Modifier la photo</label>
                                    <input type="file" name="photoEssence" id="photoEssence" class="w-full p-2 border border-gray-300 rounded mt-1">     
                                    </div>

                                    <div>
                                         @if($e->photoEssence)
                                        <img src="data:image/jpeg;base64,{{ base64_encode($e->photoEssence) }}" alt="{{ $e->varieteEssence }}" class="w-32 h-32 rounded-full float-left">
                                    @endif
                                    </div>

                                </div>


                                </div>
                                <div class="flex justify-end">
                                    <button type="button" onclick="closeModal({{ $e->idEssence }})" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-3 rounded mr-2">Annuler</button>
                                    <button type="submit" class="bg-lime-600 hover:bg-lime-800 text-white font-bold py-1 px-3 rounded">Enregistrer</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.essence.destroy', $e->idEssence) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette essence ?')">Supprimer</button>
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

    function toggleCustomTypeInput() {
        var select = document.getElementById('typeEssence');
        var customTypeInput = document.getElementById('customTypeEssence');
        if (select.value === 'custom') {
            customTypeInput.classList.remove('hidden');
            customTypeInput.setAttribute('required', 'required');
        } else {
            customTypeInput.classList.add('hidden');
            customTypeInput.removeAttribute('required');
        }
    }


    function toggleCustomOrigineInput() {
        var select = document.getElementById('origineEssence');
        var customTypeInput = document.getElementById('customOrigineEssence');
        if (select.value === 'custom') {
            customTypeInput.classList.remove('hidden');
            customTypeInput.setAttribute('required', 'required');
        } else {
            customTypeInput.classList.add('hidden');
            customTypeInput.removeAttribute('required');
        }
    }

    function toggleCustomDurabiliteInput() {
        var select = document.getElementById('durabiliteEssence');
        var customTypeInput = document.getElementById('customDurabiliteEssence');
        if (select.value === 'custom') {
            customTypeInput.classList.remove('hidden');
            customTypeInput.setAttribute('required', 'required');
        } else {
            customTypeInput.classList.add('hidden');
            customTypeInput.removeAttribute('required');
        }
    }


    //Pour les modals
    function toggleCustomTypeInputModal() {
        var modals = document.querySelectorAll('[id^="modal-"]');
        modals.forEach(function(modal) {
            var select = modal.querySelector('#typeEssence');
            var customTypeInput = modal.querySelector('#customTypeEssence');
            if (select && customTypeInput) {
                if (select.value === 'custom') {
                    customTypeInput.classList.remove('hidden');
                    customTypeInput.setAttribute('required', 'required');
                } else {
                    customTypeInput.classList.add('hidden');
                    customTypeInput.removeAttribute('required');
                }
            }
        });
    }

    function toggleCustomOrigineInputModal() {
        var modals = document.querySelectorAll('[id^="modal-"]');
        modals.forEach(function(modal) {
            var select = modal.querySelector('#origineEssence');
            var customTypeInput = modal.querySelector('#customOrigineEssence');
            if (select && customTypeInput) {
                if (select.value === 'custom') {
                    customTypeInput.classList.remove('hidden');
                    customTypeInput.setAttribute('required', 'required');
                } else {
                    customTypeInput.classList.add('hidden');
                    customTypeInput.removeAttribute('required');
                }
            }
        });
    }

    function toggleCustomDurabiliteInputModal() {
        var modals = document.querySelectorAll('[id^="modal-"]');
        modals.forEach(function(modal) {
            var select = modal.querySelector('#durabiliteEssence');
            var customTypeInput = modal.querySelector('#customDurabiliteEssence');
            if (select && customTypeInput) {
                if (select.value === 'custom') {
                    customTypeInput.classList.remove('hidden');
                    customTypeInput.setAttribute('required', 'required');
                } else {
                    customTypeInput.classList.add('hidden');
                    customTypeInput.removeAttribute('required');
                }
            }
        });
    }










</script>

</body>
</html>