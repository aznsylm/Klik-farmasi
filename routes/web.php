<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

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
    $role = auth()->user()->role;
    if ($role === 'super_admin') {
        return redirect()->route('superadmin.dashboard');
    } elseif ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role === 'pasien') {
        return redirect()->route('user.dashboard');
    }
})->middleware(['auth'])->name('dashboard');

// Dashboard Super Admin
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':super_admin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('superadmin.dashboard');
    })->name('dashboard');

    // Tambahkan route kelola admin & pasien
    Route::get('/users', [AdminController::class, 'index'])->name('users');
    Route::post('/users', [AdminController::class, 'addPasien'])->name('addPasien');
    Route::get('/users/{id}', [AdminController::class, 'show'])->name('userDetail');
    Route::get('/users/{id}/edit', [AdminController::class, 'edit'])->name('userEdit');
    Route::put('/users/{id}', [AdminController::class, 'update'])->name('userUpdate');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('deleteUser');

    // Tambahkan juga route khusus kelola admin jika ingin dipisah
    Route::post('/add-admin', [AdminController::class, 'addAdmin'])->name('addAdmin');
});

// Dashboard Admin
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Kelola Data Pasien
    Route::get('/pasien', [AdminController::class, 'index'])->name('pasien');
    Route::get('/pasien/create', [AdminController::class, 'create'])->name('pasienCreate');
    Route::post('/pasien', [AdminController::class, 'addPasien'])->name('addPasien');
    Route::get('/pasien/{id}', [AdminController::class, 'show'])->name('pasienDetail');
    Route::get('/pasien/{id}/edit', [AdminController::class, 'edit'])->name('pasienEdit');
    Route::put('/pasien/{id}', [AdminController::class, 'update'])->name('pasienUpdate');
    Route::delete('/pasien/{id}', [AdminController::class, 'destroy'])->name('deletePasien');

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
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':pasien'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard'); 
    })->name('user.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister'])->name('register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

