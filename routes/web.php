<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Ini adalah file routes utama untuk aplikasi kamu.
| Termasuk route otentikasi dan dashboard portal berita.
|
*/

// Arahkan root ke login (jika belum login)
Route::get('/', function () {
    return redirect()->route('login');
});

// =============== AUTH ROUTES =============== //
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ============ DASHBOARD (BERITA) ============ //
    Route::get('/dashboard', [NewsController::class, 'index'])->name('dashboard');
    Route::get('/search', [NewsController::class, 'search'])->name('search');
    Route::get('/kategori/{category}', [NewsController::class, 'showByCategory'])->name('news.category');

});
