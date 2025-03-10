<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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
    //USER
    Route::get('/logout', [UserController::class, 'doLogout'])->name('logout');
    Route::get('/delete-account', [UserController::class, 'deleteAccount'])->name('deleteAccount');

    
    // Se le pasa el id del post que se quiere ver
    Route::get('/post/{id}', [PostController::class, 'showPost'])->name('post');
    Route::get('/posts', [PostController::class, 'showAllPosts'])->name('posts');
    Route::get('/form-post', [PostController::class, 'showFormPost'])->name('post-form');
    
    // POSTs
    Route::get('/create-post', [PostController::class, 'showFormPost'])->name('create-post');
    Route::post('/create-post', [PostController::class, 'createPost'])->name('create-post');
    Route::post('/post/{id}/like', [PostController::class, 'likePost'])->name('like-post');
    Route::delete('/post/{id}', [PostController::class, 'deletePost'])->name('delete-post');

    // COMMENT
    Route::get('/post/{id}/comment', [CommentController::class, 'showCommentForm'])->name('comment-form');
    Route::post('/post/{id}/comment', [CommentController::class, 'commentPost'])->name('comment-post');
});
