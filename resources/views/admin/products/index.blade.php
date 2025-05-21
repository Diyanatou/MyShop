@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Produits</h1>

    <!-- Lien vers la page de création de produit -->
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Ajouter un produit</a>

    @if (session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>
                        @if($product->pro_image)
                            <img src="{{ asset('storage/uploads/' . $product->pro_image) }}" alt="Image produit" width="100">
                        @else
                            <span>Pas d’image</span>
                        @endif
                    </td>
                    <td>{{ $product->pro_name }}</td>
                    <td>{{ $product->pro_price }} FCFA</td>
                    <td>
                        {{ $product->category ? $product->category->cat_name : 'Non défini' }}
                    </td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}">Modifier</a> |
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer ce produit ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
