<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// GETs
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::get('/register', [UserController::class, 'showRegister'])->name('register');

// POSTs
Route::post('/login', [UserController::class, 'doLogin'])->name('login');
Route::post('/register', [UserController::class, 'doRegister'])->name('register');