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



<div class="py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-5xl font-bold text-center mb-8 text-gray-900">Boutique Essence</h1>

        <form method="GET" action="{{ route('essence.index') }}" class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 items-center">
            <div>
                <label for="durabiliteEssence" class="block text-2xl font-medium text-gray-700">Durabilité :</label>
                <select name="durabiliteEssence" id="durabiliteEssence" class="py-3 mt-0 sm:mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Toutes les durabilités</option>
                    <option value="Excellente" {{ request('durabiliteEssence') == 'Excellente' ? 'selected' : '' }}>Excellente</option>
                    <option value="Moyenne" {{ request('durabiliteEssence') == 'Moyenne' ? 'selected' : '' }}>Moyenne</option>
                    <option value="Faible" {{ request('durabiliteEssence') == 'Faible' ? 'selected' : '' }}>Faible</option>
                </select>
            </div>

            <div>
                <label for="typeEssence" class="block text-2xl font-medium text-gray-700">Type d'essence :</label>
                <select name="typeEssence" id="typeEssence" class="py-3 mt-0 sm:mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Tous les types</option>
                    <option value="Européenne" {{ request('typeEssence') == 'Européenne' ? 'selected' : '' }}>Européenne</option>
                    <option value="Exotique" {{ request('typeEssence') == 'Exotique' ? 'selected' : '' }}>Exotique</option>
                    <option value="Précieuse" {{ request('typeEssence') == 'Précieuse' ? 'selected' : '' }}>Précieuse</option>
                </select>
            </div>

            <div class="mt-7">
                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <p class="text-xl sm:text-2xl">Filtrer</p>
                </button>
            </div>
        </form>
    </div>
</div>

    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
    @foreach ($essence as $essence)
    <div class="bg-white rounded-lg shadow-lg overflow-hidden transition duration-300 hover:shadow- h-fit">
        <div class="p-6">
            <h2 class="text-xl font-semibold text-blue-600 mb-4 hover:text-blue-800 transition duration-300">
                {{ $essence->varieteEssence }}
            </h2>
            <div class="space-y-2 text-gray-700">
                <p><strong>Type :</strong> {{ $essence->typeEssence }}</p>
                <p><strong>Nom Latin :</strong> {{ $essence->nomLatinEssence }}</p>
                <p><strong>Origine :</strong> {{ $essence->origineEssence }}</p>
                <p><strong>Densité :</strong> {{ $essence->densiteEssence }}</p>
                <p><strong>Durabilité :</strong> {{ $essence->durabiliteEssence }}</p>
                <p class="line-clamp-3">{{ $essence->commentaireEssence }}</p>
            </div>
        </div>
        @if ($essence->photoEssence)
        <div class="relative pb-[100%] overflow-hidden"> <img
                src="data:image/jpeg;base64,{{ base64_encode($essence->photoEssence) }}"
                alt="{{ $essence->varieteEssence }}"
                class="absolute inset-0 w-fit h-fit object-cover">
        </div>
        @else
        <div class="bg-gray-100 p-6 text-center text-gray-500">
            <p>Photo non disponible</p>
        </div>
        @endif
    </div>
    @endforeach
</div>

</body>
@include('partials.footer')
</html>
