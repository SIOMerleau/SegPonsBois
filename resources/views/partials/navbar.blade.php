<!-- resources/views/partials/navbar.blade.php -->
@auth
<!-- Navbar LOGIN -->
<nav class="bg-white shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">
            <div class="flex space-x-4">
                    <a href="/" class="flex items-center py-5 px-2 text-gray-700 hover:text-gray-900">
                        <svg class="h-6 w-6 mr-1 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h5.586a1 1 0 01.707.293l1.414 1.414a1 1 0 00.707.293H19a1 1 0 011 1v11a1 1 0 01-1 1h-5.586a1 1 0 00-.707.293l-1.414 1.414a1 1 0 01-.707.293H4a1 1 0 01-1-1V5z" />
                        </svg>
                        <span class="font-bold text-xl">SegPonsBois</span>
                    </a>
            </div>
            
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('boutique') }}" class="py-5 px-3 text-gray-700 hover:text-gray-900">Boutique</a>
                <a href="{{ route('offres.index') }}" class="py-5 px-3 text-gray-700 hover:text-gray-900">Offre du Jour</a>
                <a href="{{ route('contact.create') }}" class="py-5 px-3 text-gray-700 hover:text-gray-900">Contact</a>
                <a href="{{ route('panier') }}" class="relative py-5 px-3 text-gray-700 hover:text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                </a>
                <a href="{{route('user.dashboard')}}" class="py-5 px-3 text-gray-700 hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </a>

                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="py-5 px-3 text-red-500 hover:text-red-600 transform transition-transform duration-300 hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 default-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                        </svg>
                    </a>
                    <style>
                        
                    </style>
                @endif

                <a href="{{ route('user.logout') }}" class="py-5 px-3 text-gray-700 hover:text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button class="mobile-menu-button">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Mobile-->
    <div class="mobile-menu hidden md:hidden">
        <a href="{{ route('boutique') }}" class="block py-2 px-4 text-sm hover:bg-gray-200">Boutique</a>
        <a href="{{ route('contact.create') }}" class="block py-2 px-4 text-sm hover:bg-gray-200">Contact</a>
        <a href="{{ route('panier') }}" class="block py-2 px-4 text-sm hover:bg-gray-200">Panier</a>
        <a href="{{route('user.dashboard')}}" class="block py-2 px-4 text-sm hover:bg-gray-200">Compte</a>
        @if(auth()->user()->is_admin)
            <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 text-sm hover:bg-gray-200">Admin Dashboard</a>
        @endif
        <a href="{{ route('user.logout') }}" class="block py-2 px-4 text-sm hover:bg-gray-200">Déconnexion</a>
    </div>
</nav>
@endauth

@guest
<!-- Navbar GUEST -->
<nav class="bg-white shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">
            <div class="flex space-x-4">
                <a href="/" class="flex items-center py-5 px-2 text-gray-700 hover:text-gray-900">
                    <svg class="h-6 w-6 mr-1 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h5.586a1 1 0 01.707.293l1.414 1.414a1 1 0 00.707.293H19a1 1 0 011 1v11a1 1 0 01-1 1h-5.586a1 1 0 00-.707.293l-1.414 1.414a1 1 0 01-.707.293H4a1 1 0 01-1-1V5z" />
                    </svg>
                    <span class="font-bold text-xl">SegPonsBois</span>
                </a>
            </div>
            
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('boutique') }}" class="py-5 px-3 text-gray-700 hover:text-gray-900">Boutique</a>
                <a href="{{ route('offres.index') }}" class="py-5 px-3 text-gray-700 hover:text-gray-900">Offre du Jour</a>
                <a href="{{ route('contact.create') }}" class="py-5 px-3 text-gray-700 hover:text-gray-900">Contact</a>
                <a href="{{ route('user.index') }}" class="py-5 px-3 text-gray-700 hover:text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                </a>
                <a href="{{ route('user.index') }}" class="py-5 px-3 text-gray-700 hover:text-gray-900">Connexion</a>
                <a href="{{ route('user.create') }}" class="py-5 px-3 text-gray-700 hover:text-gray-900">Inscription</a>
            </div>

            <!-- Bouton Mobile Menu -->
            <div class="md:hidden flex items-center">
                <button class="mobile-menu-button">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, hidden by default -->
    <div class="mobile-menu hidden md:hidden">
        <a href="{{ route('boutique') }}" class="block py-2 px-4 text-sm hover:bg-gray-200">Boutique</a>
        <a href="{{ route('contact.create') }}" class="block py-2 px-4 text-sm hover:bg-gray-200">Contact</a>
        <a href="{{ route('user.index') }}" class="block py-2 px-4 text-sm hover:bg-gray-200">Connexion</a>
        <a href="{{ route('user.create') }}" class="block py-2 px-4 text-sm hover:bg-gray-200">Inscription</a>
    </div>
</nav>
@endguest

<script>
    const btn = document.querySelector('.mobile-menu-button');
    const menu = document.querySelector('.mobile-menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>