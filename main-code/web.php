<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

// Définir une route pour la page d'accueil
Route::get('/', [HomeController::class,'index']);

// Groupe de routes nécessitant une authentification et vérification
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Routes pour l'AdminController
Route::get('/home',[AdminController::class,'index']); // Route vers la page d'accueil de l'admin
Route::get('/category_page',[AdminController::class,'category_page']); // Route vers la page des catégories
Route::post('/add_category',[AdminController::class,'add_category']); // Route pour ajouter une catégorie
Route::get('/cat_delete/{id}',[AdminController::class,'cat_delete']); // Route pour supprimer une catégorie
Route::get('/edit_category/{id}',[AdminController::class,'edit_category']); // Route pour éditer une catégorie
Route::post('/update_category/{id}',[AdminController::class,'update_category']); // Route pour mettre à jour une catégorie
Route::get('/add_book',[AdminController::class,'add_book']); // Route vers la page d'ajout d'un livre
Route::post('/store_book', [AdminController::class, 'store_book']); // Route pour stocker un nouveau livre
Route::get('/show_book',[AdminController::class,'show_book']); // Route pour afficher les livres
Route::get('/book_delete/{id}',[AdminController::class,'book_delete']); // Route pour supprimer un livre
Route::get('/edit_book/{id}',[AdminController::class,'edit_book']); // Route pour éditer un livre
Route::post('/update_book/{id}',[AdminController::class,'update_book']); // Route pour mettre à jour un livre

// Routes pour le HomeController
Route::get('/borrow_books/{id}', [HomeController::class, 'borrow_books']); // Route pour emprunter un livre
Route::get('/borrow_request',[AdminController::class,'borrow_request']); // Route pour voir les demandes d'emprunt
Route::get('/accepter/{id}',[AdminController::class,'accepter']); // Route pour accepter une demande d'emprunt
Route::get('/retourner/{id}',[AdminController::class,'retourner']); // Route pour retourner un livre
Route::get('/rejeter/{id}',[AdminController::class,'rejeter']); // Route pour rejeter une demande d'emprunt
Route::get('/book_history',[HomeController::class,'book_history']); // Route pour voir l'historique des emprunts
Route::get('/cancel/{id}',[HomeController::class,'cancel']); // Route pour annuler une demande d'emprunt
Route::get('/explorer',[HomeController::class,'explorer']); // Route vers la page d'exploration des livres
Route::get('/rechercher',[HomeController::class,'rechercher']); // Route pour rechercher des livres
Route::get('/cat_rechercher/{id}',[HomeController::class,'cat_rechercher']); // Route pour rechercher des livres par catégorie
