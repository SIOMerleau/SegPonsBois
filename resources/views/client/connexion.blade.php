<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h1 class="text-2xl font-bold mb-4 text-center">Connexion</h1>

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('user.login') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" id="email" class="w-full px-3 py-2 border rounded-lg" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-bold mb-2">Mot de passe</label>
                    <input type="password" name="password" id="password" class="w-full px-3 py-2 border rounded-lg" required>
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white px-3 py-2 rounded-lg hover:bg-blue-600">
                    Se connecter
                </button>
            </form>

            <p class="text-sm text-center mt-4">
                Nouveau sur notre site ?
                <a href="{{ route('user.create') }}" class="text-blue-500 hover:underline">Inscrivez-vous</a>
            </p>
            <p class="text-sm text-center mt-4">
                <a href="/" class="text-blue-500 hover:underline">Retour à l'accueil</a>
            </p>
        </div>
    </div>

</body>
</html>
