@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Liste des catégories</h1>

    <!-- Bouton pour afficher la modale -->
    <div class="mb-4 text-right">
        <button onclick="document.getElementById('addCategoryModal').classList.remove('hidden')" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Ajouter une catégorie
        </button>
    </div>

    <!-- Table des catégories -->
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-gray-100 text-left text-gray-600 uppercase text-sm">
                <th class="py-3 px-4 border-b">Nom</th>
                <th class="py-3 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($categories as $category)
            <tr class="hover:bg-gray-50">
                <td class="py-3 px-4 border-b">{{ $category->cat_name ?? 'Nom de la catégorie non défini' }}</td>
                <td class="py-3 px-4 border-b flex space-x-2">
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 text-sm">
                        Modifier
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="2" class="py-3 px-4 text-center text-gray-500">Aucune catégorie trouvée.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<!-- MODALE D'AJOUT -->
<div id="addCategoryModal" class="fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center hidden z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg relative">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Ajouter une catégorie</h2>

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="cat_name" class="block text-gray-700">Nom de la catégorie</label>
                <input type="text" name="cat_name" id="cat_name" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="document.getElementById('addCategoryModal').classList.add('hidden')" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Annuler</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Ajouter</button>
            </div>
        </form>

        <!-- Bouton de fermeture en haut à droite -->
        <button onclick="document.getElementById('addCategoryModal').classList.add('hidden')" class="absolute top-2 right-2 text-gray-500 hover:text-red-500">&times;</button>
    </div>
</div>
@endsection
