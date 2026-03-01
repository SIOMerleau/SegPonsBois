<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de Bord</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

@include('partials.navbar')

<div class="flex flex-col justify-center">
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8">Bienvenue, {{ Auth::user()->name }}</h1>
    <p class="text-gray-700">Ceci est votre tableau de bord.</p>
  </div>

  <div class="container mx-auto px-4 pb-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Modifier les informations</h2>
        <form action="{{ route('user.update') }}" method="POST">
          @csrf
          <div class="flex flex-col space-y-4">
            <div class="flex items-center">
              <label for="name" class="w-1/3 text-gray-700">Nom</label>
              <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded-lg" value="{{ Auth::user()->name }}" maxlength="">
            </div>
            <div class="flex items-center">
              <label for="username" class="w-1/3 text-gray-700">Prénom</label>
              <input type="text" id="username" name="username" class="w-full px-3 py-2 border rounded-lg" value="{{ Auth::user()->username }}">
            </div>
            <div class="flex items-center">
              <label for="telephone" class="w-1/3 text-gray-700">Téléphone</label>
              <input type="text" id="telephone" name="telephone" class="w-full px-3 py-2 border rounded-lg" value="{{ Auth::user()->telephone }}">
            </div>
            <div class="flex items-center">
              <label for="code_postal" class="w-1/3 text-gray-700">Code Postal</label>
              <input type="text" id="code_postal" name="code_postal" class="w-full px-3 py-2 border rounded-lg" value="{{ Auth::user()->code_postal }}">
            </div>
            <div class="flex items-center">
              <label for="ville" class="w-1/3 text-gray-700">Ville</label>
              <input type="text" id="ville" name="ville" class="w-full px-3 py-2 border rounded-lg" value="{{ Auth::user()->ville }}">
            </div>
            <div class="flex items-center">
              <label for="adresse" class="w-1/3 text-gray-700">Adresse</label>
              <input type="text" id="adresse" name="adresse" class="w-full px-3 py-2 border rounded-lg" value="{{ Auth::user()->adresse }}">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Enregistrer</button>
          </div>
        </form>
      </div>
      </div>
  </div>
</div>

@include('partials.footer')
</body>
</html>