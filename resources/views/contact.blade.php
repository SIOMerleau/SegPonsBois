<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

@include('partials.navbar')
<body>
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Contactez-nous</h2>
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="mb-4 flex space-x-4">
                        <div class="w-1/2">
                            <label for="nomVisiteur" class="block text-gray-700">Nom<span class="text-red-500">*</span></label>
                            <input type="text" id="nomVisiteur" name="nomVisiteur" maxlength="30"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ auth()->check() ? auth()->user()->name : old('nomVisiteur') }}" required>
                        </div>
                        <div class="w-1/2">
                            <label for="prenomVisiteur" class="block text-gray-700">Prénom<span class="text-red-500">*</span></label>
                            <input type="text" id="prenomVisiteur" name="prenomVisiteur" maxlength="30"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ auth()->check() ? auth()->user()->username : old('prenomVisiteur') }}" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="mailVisiteur" class="block text-gray-700">Email<span class="text-red-500">*</span></label>
                        <input type="email" id="mailVisiteur" name="mailVisiteur" maxlength="40"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ auth()->check() ? auth()->user()->email : old('mailVisiteur') }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="telVisiteur" class="block text-gray-700">Téléphone</label>
                        <input type="text" id="telVisiteur" name="telVisiteur" maxlength="15" inputmode="numeric"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('telVisiteur') }}">
                    </div>
                    <div class="mb-4">
                        <label for="messageContact" class="block text-gray-700">Message<span class="text-red-500">*</span></label>
                        <textarea id="messageContact" maxlength="300" name="messageContact" rows="4"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>{{ old('messageContact') }}</textarea>
                        <p class="text-gray-400 text-sm">300 caractères max</p>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Envoyer</button>
                    </div>
                </form>
                @if(session('success'))
                <div class="container mx-auto px-4 py-4">
                <div class="max-w-lg mx-auto bg-green-100 p-4 rounded-lg shadow-lg">
                    <p class="text-green-800">{{ session('success') }}</p>
                </div>

                @elseif(session('error'))
                <div class="container mx-auto px-4 py-4">
                <div class="max-w-lg mx-auto bg-red-100 p-4 rounded-lg shadow-lg">
                    <p class="text-red-800">{{ session('error') }}</p>
                </div>
            </div>
        @endif
            </div>
        </div>
        
</body>
@include('partials.footer')
</html>