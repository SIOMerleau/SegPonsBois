<footer class="bg-gray-800 text-white py-8 relative bottom-0 w-full mt-4 sm:mt-80">
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      <div class="text-center sm:text-left"> <h3 class="text-lg font-semibold mb-4 text-yellow-500">Nom du collège</h3>
        <ul>
          <li><a href="#" class="hover:underline">Emile Combes</a></li>
          <li><a href="#" class="hover:underline">17800 PONS</a></li>
        </ul>
      </div>
      <div class="text-center sm:text-left"> <h3 class="text-lg font-semibold mb-4 text-yellow-500">Liens utiles</h3>
        <ul>
          <li><a href="/" class="hover:underline">Accueil</a></li>
          <li><a href="{{route('user.create')}}" class="hover:underline">S'inscrire</a></li>
          <li><a href="https://github.com/SIOMerleau/essences-mvc" target="_blank" class="hover:underline">GitHub</a></li>
        </ul>
      </div>
      <div class="text-center sm:text-left"> <h3 class="text-lg font-semibold mb-4 text-yellow-500">Nos produits</h3>
        <ul>
          <li><a href="{{route('essence.index')}}" class="hover:underline">Nos essences</a></li>
          <li><a href="{{route('produit.index')}}" class="hover:underline">Boutique</a></li>
          <li><a href="{{route('offres.index')}}" class="hover:underline">Offre du jour</a></li>
        </ul>
      </div>
      <div class="text-center sm:text-left"> <h3 class="text-lg font-semibold mb-4 text-yellow-500">Nous contacter</h3>
        <ul>
          <li><a href="{{route('contact.create')}}" class="hover:underline">Formulaire de contact</a></li>
          <li><a href="#" class="hover:underline">mail : </a></li>
          <li><a href="#" class="hover:underline">tel : +33 </a></li>
        </ul>
      </div>
    </div>
    <div class="border-t border-gray-700 mt-8"></div>
  </div>
</footer>