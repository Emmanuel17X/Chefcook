<?php

use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CookController;
use App\Http\Controllers\CommentController;
use App\Models\Recette;

Route::get('/', function () {
    $recettes = Recette::latest()->get();
    return view('accueil',[
        'recettes' => $recettes
    ]);
})->name('accueil');

Route::get('/inscription', function(){
    return view('auth.inscription');
})->middleware('guest')->name('inscription');

Route::post('/inscription', [GuestController::class, 'register'])->middleware('guest')->name('register');
Route::get('/connexion', [GuestController::class, 'login'])->middleware('guest')->name('connexion');
Route::post('/connexion', [GuestController::class, 'login_now'])->middleware('guest')->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [CookController::class, 'profile'])->name('profil');
    Route::get('/profile/recipe', [CookController::class, 'recipe'])->name('recipe');
    Route::post('/profile/recipe', [CookController::class, 'store'])->name('store');
    Route::get('/recette/{id}', [CookController::class, 'recette']);
    Route::post('/recette/{id}/comment', [CommentController::class, 'create']);
    Route::post('/recette/{id}/note', [CookController::class, 'note']);
    Route::post('/logout', [CookController::class, 'logout'])->name('logout');
    Route::get('/admin', [CookController::class, 'admin'])->name('admin');
});



