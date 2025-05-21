@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Modifier le produit</h2>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Nom du produit :</label>
        <input type="text" name="pro_name" value="{{ old('pro_name', $product->pro_name) }}" required><br><br>

        <label>Prix :</label>
        <input type="number" name="pro_price" value="{{ old('pro_price', $product->pro_price) }}" required><br><br>

        <label>Description :</label><br>
        <textarea name="pro_desc" rows="4" required>{{ old('pro_desc', $product->pro_desc) }}</textarea><br><br>

        <label>Catégorie :</label>
        <select name="categories_id" required>
            <option value="">-- Choisir une catégorie --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $product->categories_id == $category->id ? 'selected' : '' }}>
                    {{ $category->cat_name }}
                </option>
            @endforeach
        </select><br><br>

        <label>Image actuelle :</label><br>
        <img src="{{ asset('storage/uploads/' . $product->pro_image) }}" width="150"><br><br>

        <label>Changer l’image :</label>
        <input type="file" name="pro_image"><br><br>

        <button type="submit">Enregistrer les modifications</button>
    </form>
</div>
@endsection
