<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group.
|
*/

Route::middleware("guest:admin")->group(function() {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login_process', [AuthController::class, 'login'])->name('login_process');
});

Route::middleware('auth:admin')->group(function() {
    Route::resource('posts', PostController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
