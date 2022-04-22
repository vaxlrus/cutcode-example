<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('home');

Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

Route::get('/contacts', [\App\Http\Controllers\IndexController::class, 'showContactForm'])->name('contacts');
Route::post('/contacts_form_process', [\App\Http\Controllers\IndexController::class, 'contactFormHandler'])->name('contacts_form_process');

Route::middleware("auth")->group(function() {
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    Route::post('/posts/comment/{id}', [\App\Http\Controllers\PostController::class, 'comment'])->name('comment');
});

Route::middleware("guest")->group(function() {
    // URL /login используется по умолчанию в middleware auth для редиректа
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login_process', [\App\Http\Controllers\AuthController::class, 'login'])->name('login_process');

    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register_process', [\App\Http\Controllers\AuthController::class, 'register'])->name('register_process');
});
