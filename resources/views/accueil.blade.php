<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
       body {
            position: relative;
            background-image: url("{{asset('background.webp')}}");
            background-size: cover;
            background-attachment: fixed;
        }

    .title-container {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%); /* Center the title horizontally and vertically */
      text-align: center; /* Center text within the container */
      z-index: 1; /* Ensure title appears on top of background elements */
    }

    h1 {
      color: rgb(255, 255, 255); /* White text for better contrast */
      text-shadow: 0 0 3px black; /* Add a subtle shadow for depth */
      font-size: 5xl; /* Increase font size for emphasis */
      margin: 0; /* Remove default margin for better positioning */
      
    }

    .card {
        margin-top: 100px; /* Add margin-top to move the cards down */
    }
    </style>
</head>
<body class="bg-gray-100 font-sans">
 
    @include('partials.navbar')

    <div class="container mx-auto py-12 px-4">
        <h1 class="text-4xl font-bold text-center mb-8 ">Bienvenue sur SegPonsBois</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            <div class="card bg-white shadow-md rounded-lg p-6 flex flex-col items-center hover:scale-105 transition duration-300">
              
                <h2 class="text-2xl font-bold mb-4 text-brown-800">Notre Boutique</h2>
                <p class="text-gray-700 mb-4 text-center">Découvrez une variété d'essences de qualité.</p>
                <a href="{{ route('boutique') }}" class="inline-block px-6 py-3 rounded-md bg-green-500 hover:bg-green-600 text-white font-medium transition duration-300 w-full text-center">Voir la Boutique</a>
            </div>

            <div class="card bg-white shadow-md rounded-lg p-6 flex flex-col items-center hover:scale-105 transition duration-300">
               
                <h2 class="text-2xl font-bold mb-4 text-brown-800">Rejoignez-nous</h2>
                <p class="text-gray-700 mb-4 text-center">Inscrivez-vous pour pouvoir acheter nos essences.</p>
                <a href="{{ route('user.create') }}" class="inline-block px-6 py-3 rounded-md bg-teal-500 hover:bg-teal-600 text-white font-medium transition duration-300 w-full text-center">S'inscrire</a>
            </div>

            <div class="card bg-white shadow-md rounded-lg p-6 flex flex-col items-center hover:scale-105 transition duration-300">
               
                <h2 class="text-2xl font-bold mb-4 text-brown-800">Offre du Jour</h2>
                <p class="text-gray-700 mb-4 text-center">Ne manquez pas notre offre exclusive du jour.</p>
                <a href="{{ route('offres.index') }}" class="inline-block px-6 py-3 rounded-md bg-orange-500 hover:bg-orange-600 text-white font-medium transition duration-300 w-full text-center">Voir l'Offre du Jour</a>
            </div>

            <div class="card bg-white shadow-md rounded-lg p-6 flex flex-col items-center hover:scale-105 transition duration-300">
               
                <h2 class="text-2xl font-bold mb-4 text-brown-800">Nous contacter</h2>
                <p class="text-gray-700 mb-4 text-center">Une question ? Besoin d'aide ? Contactez-nous !</p>
                <a href="{{ route('contact.create') }}" class="inline-block px-6 py-3 rounded-md bg-amber-500 hover:bg-amber-600 text-white font-medium transition duration-300 w-full text-center">Nous contacter</a>
            </div>

        </div>
    </div>

    @include('partials.footer')

</body>
</html>
