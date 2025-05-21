<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }
public function store(Request $request)
{
    // ✅ Étape 1 : validation des champs
    $request->validate([
        'pro_name' => 'required|string|max:255',
        'pro_price' => 'required|numeric',
        'pro_desc' => 'required|string',
        'categories_id' => 'required|exists:categories,id',
        'pro_image' => 'required|file|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048',
    ]);

    // ✅ Étape 2 : renommer et enregistrer physiquement le fichier image
    $originalName = pathinfo($request->file('pro_image')->getClientOriginalName(), PATHINFO_FILENAME);
    $extension = $request->file('pro_image')->getClientOriginalExtension();
    $imageName = $originalName . '.2025.' . $extension;

    // Enregistre dans "storage/app/public/uploads"
    $request->file('pro_image')->storeAs('uploads', $imageName, 'public');

    // ✅ Étape 3 : création du produit avec image renommée
    Product::create([
       'pro_name' => $request->pro_name,
    'pro_price' => $request->pro_price,
    'pro_desc' => $request->pro_desc,
    'categories_id' => $request->categories_id, // Enregistrement de l’ID
    'pro_image' => $imageName,
    'users_id' => auth()->id(),
    ]);
    // ✅ Étape 4 : redirection avec succès
    return redirect()->route('admin.products.index')->with('success', 'Produit ajouté avec succès !');
}
public function index()
{
    $products = Product::with('category')->latest()->get(); // si tu veux afficher la liste
    return view('admin.products.index', compact('products'));
}
public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete(); // Suppression douce si `SoftDeletes` est utilisé

    return redirect()->route('admin.products.index')->with('success', 'Produit supprimé avec succès.');
}
public function edit($id)
{
    $product = Product::findOrFail($id);
    $categories = \App\Models\Category::all();
    return view('admin.products.edit', compact('product', 'categories'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'pro_name' => 'required|string|max:255',
        'pro_price' => 'required|numeric',
        'pro_desc' => 'required|string',
        'categories_id' => 'required|exists:categories,id',
        'pro_image' => 'nullable|file|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048',
    ]);

    $product = Product::findOrFail($id);

    // Gérer l'image si une nouvelle est uploadée
    if ($request->hasFile('pro_image')) {
        $originalName = pathinfo($request->file('pro_image')->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $request->file('pro_image')->getClientOriginalExtension();
        $imageName = $originalName . '.2025.' . $extension;
        $request->file('pro_image')->storeAs('uploads', $imageName, 'public');
        $product->pro_image = $imageName;
    }

    // Mettre à jour les autres champs
    $product->update([
        'pro_name' => $request->pro_name,
        'pro_price' => $request->pro_price,
        'pro_desc' => $request->pro_desc,
        'categories_id' => $request->categories_id,
        'pro_image' => $product->pro_image,
    ]);

    return redirect()->route('admin.products.index')->with('success', 'Produit modifié avec succès !');
}

}