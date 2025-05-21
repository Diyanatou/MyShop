@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-6">Modifier la catégorie</h2>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Nom de la catégorie</label>
            <input type="text" name="cat_name" id="cat_name" value="{{ $category->cat_name }}" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Mettre à jour</button>
            <a href="{{ route('admin.categories.index') }}" class="text-gray-600 hover:text-green-600">Annuler</a>
        </div>
    </form>
</div>
@endsection
