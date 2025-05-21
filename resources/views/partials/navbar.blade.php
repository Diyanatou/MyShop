<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ url('/') }}" class="text-xl font-semibold">🛍️</a>
        <div class="space-x-4">
            @guest
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Connexion</a>
                <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Inscription</a>
            @else
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-500 hover:underline">Accueil</a>
                    <a href="{{ route('admin.categories.index') }}" class="text-blue-500 hover:underline">Gestion des Catégories</a> <!-- Lien ajouté ici -->
                    <a href="{{ route('admin.products.index') }}" class="text-blue-500 hover:underline">
                Gestion des Produits
            </a>
                @else
                    <a href="{{ route('client.dashboard') }}" class="text-blue-500 hover:underline">Accueil Client</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline">Déconnexion</button>
                </form>
            @endguest
        </div>
    </div>
</nav>
