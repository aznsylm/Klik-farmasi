<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

Route::get('/', [PageController::class, 'beranda'])->name('beranda');
Route::get('/tanya-jawab', [PageController::class, 'tanyaJawab'])->name('tanya-jawab');
Route::get('/artikel', [PageController::class, 'artikel'])->name('artikel');
Route::get('/artikel/{slug}', [PageController::class, 'artikelDetail'])->name('artikel.detail');
Route::get('/unduhan/modul', [PageController::class, 'unduhanModul'])->name('unduhan.modul');
Route::get('/unduhan/flayer', [PageController::class, 'unduhanFlayer'])->name('unduhan.flayer');
Route::get('/pengingat', [PageController::class, 'pengingat'])->name('pengingat');
Route::get('/berita', [PageController::class, 'berita'])->name('pages.berita');
Route::get('/petunjuk', [PageController::class, 'petunjuk'])->name('petunjuk');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->user()->role === 'user') {
        return redirect()->route('user.dashboard');
    }
})->middleware(['auth'])->name('dashboard');

// Dashboard Admin
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // Buat view untuk admin
    })->name('dashboard');

    // Kelola Data User
    Route::get('/users', [AdminController::class, 'index'])->name('users');
    Route::get('/users/{id}', [AdminController::class, 'show'])->name('userDetail');
    Route::get('/users/{id}/edit', [AdminController::class, 'edit'])->name('userEdit');
    Route::put('/users/{id}', [AdminController::class, 'update'])->name('userUpdate');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('deleteUser');

    // Kelola Artikel
    Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class);
    // Kelola Berita
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
    // Kelola Tanya Jawab
    Route::resource('faqs', \App\Http\Controllers\Admin\FaqController::class);
    // Kelola Unduhan
    Route::resource('downloads', \App\Http\Controllers\Admin\DownloadController::class);
    // Kelola Testimoni
    Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class);
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
