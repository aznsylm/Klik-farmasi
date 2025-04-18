<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

Route::get('/', [PageController::class, 'beranda'])->name('tanya-jawab');
Route::get('/tanya-jawab', [PageController::class, 'tanyaJawab'])->name('tanya-jawab');
Route::get('/artikel', [PageController::class, 'artikel'])->name('artikel');
Route::get('/unduhan', [PageController::class, 'unduhan'])->name('unduhan');
Route::get('/pengingat', [PageController::class, 'pengingat'])->name('pengingat');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->user()->role === 'user') {
        return redirect()->route('user.dashboard');
    }
})->middleware(['auth'])->name('dashboard');

// Dashboard Admin
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); // Buat view untuk admin
    })->name('admin.dashboard');

    // Tambahkan route untuk mengelola data user
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');
});

// Dashboard User
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard'); // Buat view untuk user
    })->name('user.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
