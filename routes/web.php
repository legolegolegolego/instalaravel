<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

//TODO: Dejar el home para una bienvenida con opciones de logueo y registro
// y después del login, una pagina "principal" donde están todos los posts

// GETs
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::get('/register', [UserController::class, 'showRegister'])->name('register');

// POSTs
Route::post('/login', [UserController::class, 'doLogin'])->name('login');
Route::post('/register', [UserController::class, 'doRegister'])->name('register');

// Authenticated need it
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [UserController::class, 'doLogout'])->name('logout');
    Route::get('/delete-account', [UserController::class, 'deleteAccount'])->name('deleteAccount');
});
