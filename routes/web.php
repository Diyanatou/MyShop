<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Authentification (login, register, etc.)
Auth::routes();

// Page d’accueil publique
Route::get('/', function () {
    return view('welcome');
});

// Routes accessibles à tout utilisateur connecté
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    // Tableau de bord client
    Route::get('/client', function () {
        return view('client.dashboard');
    })->name('client.dashboard');
});

// Routes réservées aux administrateurs
Route::prefix('admin')
    ->middleware(['auth', 'admin'])  // Vérifie que l’utilisateur est connecté et admin
    ->name('admin.')                 // Préfixe pour les noms de route
    ->group(function () {

    // Tableau de bord admin
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Gestion des catégories (CRUD)
    Route::resource('categories', CategoryController::class);

    // Gestion des produits (CRUD)
    Route::resource('products', ProductController::class);
});
