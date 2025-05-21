@extends('layouts.app') {{-- ou ton layout admin si tu en as un --}}

@section('content')
<div class="container">
    <h2>Ajouter un produit</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
             @csrf
        <div>
            <label>Nom du produit :</label>
            <input type="text" name="pro_name" value="{{ old('pro_name') }}" required>
        </div>

        <div>
            <label>Prix :</label>
            <input type="text" name="pro_price" value="{{ old('pro_price') }}" required>
        </div>

        <div>
            <label>Description :</label>
            <textarea name="pro_desc" required>{{ old('pro_desc') }}</textarea>
        </div>
        <div>
    <label>Catégorie :</label>
    <select name="categories_id" required>
        <option value="">-- Choisir une catégorie --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('categories_id') == $category->id ? 'selected' : '' }}>
                {{ $category->cat_name }}
            </option>
        @endforeach
    </select>
</div>
        <div>
            <label for="pro_image">Image :</label>
            <input type="file" name="pro_image" required>
        </div>

        <button type="submit">Ajouter</button>
    </form>
</div>
@endsection
