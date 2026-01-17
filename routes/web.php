<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengingatObatController;
use App\Http\Controllers\TekananDarahController;
use App\Http\Controllers\TestController;



Route::get('/', [PageController::class, 'beranda'])->name('beranda');

// Testing WhatsApp Service
Route::get('/test-wa', [TestController::class, 'testWhatsApp']);
Route::get('/test-pengingat', [TestController::class, 'testPengingat']);

// PWA Routes
Route::get('/offline', function () {
    return response()->file(public_path('offline.html'));
})->name('offline');

Route::get('/tanya-jawab/hipertensi-kehamilan', [PageController::class, 'tanyaJawabKehamilan'])->name('tanya-jawab.kehamilan');
Route::get('/tanya-jawab/hipertensi-non-kehamilan', [PageController::class, 'tanyaJawabNonKehamilan'])->name('tanya-jawab.non-kehamilan');
Route::get('/artikel', [PageController::class, 'artikel'])->name('artikel');
Route::get('/artikel/hipertensi-kehamilan', [PageController::class, 'artikelKehamilan'])->name('artikel.kehamilan');
Route::get('/artikel/hipertensi-non-kehamilan', [PageController::class, 'artikelNonKehamilan'])->name('artikel.non-kehamilan');
Route::get('/artikel/hipertensi-kehamilan/{slug}', [PageController::class, 'artikelDetail'])->name('artikel.detail.kehamilan');
Route::get('/artikel/hipertensi-non-kehamilan/{slug}', [PageController::class, 'artikelDetail'])->name('artikel.detail.non-kehamilan');
Route::get('/unduhan', [PageController::class, 'unduhan'])->name('unduhan');
Route::get('/download/{id}/track', [PageController::class, 'trackDownload'])->name('download.track');
Route::get('/pengingat', [PengingatObatController::class, 'showForm'])->name('pengingat');
Route::get('/berita', [PageController::class, 'berita'])->name('pages.berita');
Route::get('/petunjuk', [PageController::class, 'petunjuk'])->name('petunjuk');
Route::get('/tim-pengelola', [PageController::class, 'timPengelola'])->name('tim-pengelola');
Route::post('/pengingat', [PengingatObatController::class, 'store'])->name('pengingat.store');

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->isSuperAdmin()) {
        return redirect()->route('superadmin.dashboard');
    } elseif ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'pasien') {
        return redirect()->route('user.dashboard');
    }
})->middleware(['auth'])->name('dashboard');

// Dashboard Super Admin
Route::middleware(['auth', 'superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\SuperAdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin', [\App\Http\Controllers\SuperAdminController::class, 'admin'])->name('admin');
    Route::get('/pasien', [\App\Http\Controllers\SuperAdminController::class, 'pasien'])->name('pasien');
    
    Route::post('/users', [\App\Http\Controllers\SuperAdminController::class, 'storeUser'])->name('storeUser');
    Route::put('/users/{id}', [\App\Http\Controllers\SuperAdminController::class, 'updateUser'])->name('updateUser');
    Route::delete('/users/{id}', [\App\Http\Controllers\SuperAdminController::class, 'deleteUser'])->name('deleteUser');
});

// Dashboard Admin
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Kelola Data Pasien
    Route::get('/pasien', [AdminController::class, 'index'])->name('pasien');
    Route::get('/pasien/create', [AdminController::class, 'create'])->name('pasienCreate');
    Route::post('/pasien', [AdminController::class, 'addPasien'])->name('addPasien');
    Route::get('/pasien/{id}', [AdminController::class, 'show'])->name('pasienDetail');
    Route::put('/pasien/{id}', [AdminController::class, 'update'])->name('pasienUpdate');
    Route::delete('/pasien/{id}', [AdminController::class, 'destroy'])->name('deletePasien');

    // Kelola Artikel
    Route::resource('artikel', \App\Http\Controllers\Admin\ArticleController::class)->parameters(['artikel' => 'article']);
    // Kelola Berita
    Route::resource('berita', \App\Http\Controllers\Admin\NewsController::class)->parameters(['berita' => 'news']);
    // Kelola Tanya Jawab
    Route::resource('tanya-jawab', \App\Http\Controllers\Admin\FaqController::class)->parameters(['tanya-jawab' => 'faq']);
    // Kelola Unduhan
    Route::resource('unduhan', \App\Http\Controllers\Admin\DownloadController::class)->parameters(['unduhan' => 'download']);
    // Kelola Testimoni
    Route::resource('testimoni', \App\Http\Controllers\Admin\TestimonialController::class)->parameters(['testimoni' => 'testimonial']);
    
    // Kelola Kode Pendaftaran
    Route::get('/kode-pendaftaran', [\App\Http\Controllers\Admin\KodePendaftaranController::class, 'index'])->name('kode-pendaftaran.index');
    Route::post('/kode-pendaftaran', [\App\Http\Controllers\Admin\KodePendaftaranController::class, 'store'])->name('kode-pendaftaran.store');
    Route::patch('/kode-pendaftaran/{kodePendaftaran}/status', [\App\Http\Controllers\Admin\KodePendaftaranController::class, 'updateStatus'])->name('kode-pendaftaran.update-status');
    
    
    // Reset Password Pasien
    Route::post('/pasien/{id}/reset-password', [AdminController::class, 'resetPassword'])->name('pasien.resetPassword');
    
    // Check duplicate email/phone
    Route::post('/check-duplicate', [AdminController::class, 'checkDuplicate'])->name('check-duplicate');
    
    // Kelola Obat Pasien
    Route::post('/obat', [\App\Http\Controllers\DetailObatController::class, 'store'])->name('obat.store');
    Route::put('/obat/{id}', [\App\Http\Controllers\DetailObatController::class, 'update'])->name('obat.update');
    Route::delete('/obat/{id}', [\App\Http\Controllers\DetailObatController::class, 'destroy'])->name('obat.delete');
    Route::post('/obat/update-status', [\App\Http\Controllers\DetailObatController::class, 'adminUpdateStatus'])->name('obat.update-status');
    
    // Kelola Tekanan Darah Pasien
    Route::get('/pasien/{id}/tekanan-darah/chart', [TekananDarahController::class, 'getAdminChartData'])->name('pasien.tekanan-darah.chart');
    Route::get('/pasien/{id}/tekanan-darah/records', [TekananDarahController::class, 'getAdminRecords'])->name('pasien.tekanan-darah.records');
    Route::get('/pasien/{id}/tekanan-darah/dates', [TekananDarahController::class, 'getExistingDates'])->name('pasien.tekanan-darah.dates');
    Route::get('/pasien/{id}/tekanan-darah/pdf', [TekananDarahController::class, 'generatePDFReport'])->name('pasien.tekanan-darah.pdf');
    Route::post('/tekanan-darah', [TekananDarahController::class, 'adminStore'])->name('tekanan-darah.store');
    Route::put('/tekanan-darah/{id}', [TekananDarahController::class, 'adminUpdate'])->name('tekanan-darah.update');
    Route::delete('/tekanan-darah/{id}', [TekananDarahController::class, 'adminDelete'])->name('tekanan-darah.delete');
});

// Dashboard User - Multiple Pages
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':pasien'])->prefix('user')->name('user.')->group(function () {
    // Dashboard - Overview
    Route::get('/dashboard', function() {
        $user = auth()->user();
        $latestPengingat = $user->pengingatObat()->latest()->first();
        return view('user.dashboard', compact('user', 'latestPengingat'));
    })->name('dashboard');
    
    // Tekanan Darah - Chart & Input
    Route::get('/tekanan-darah', [TekananDarahController::class, 'userIndex'])->name('tekanan-darah');
    
    // Daftar Obat
    Route::get('/obat', function() {
        $user = auth()->user();
        $latestPengingat = $user->pengingatObat()->latest()->first();
        return view('user.obat', compact('latestPengingat'));
    })->name('obat');
    
    // Konsultasi
    Route::get('/konsultasi', function() {
        return view('user.konsultasi');
    })->name('konsultasi');
    
    // PDF Download
    Route::get('/tekanan-darah/pdf', [TekananDarahController::class, 'generateUserPDFReport'])->name('tekanan-darah.pdf');
});

// API Routes for Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/api/blood-pressure-data', [TekananDarahController::class, 'getChartData']);
    Route::post('/api/save-blood-pressure', [TekananDarahController::class, 'store']);
    Route::put('/api/user-blood-pressure/{id}', [TekananDarahController::class, 'userUpdate']);
    Route::post('/api/obat/update-status', [\App\Http\Controllers\DetailObatController::class, 'updateStatus'])->name('user.obat.update-status');
});

// Legacy routes for backward compatibility
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':pasien'])->group(function () {
    Route::post('/tekanan-darah', [TekananDarahController::class, 'store'])->name('tekanan-darah.store');
    Route::get('/tekanan-darah/chart', [TekananDarahController::class, 'getChartData'])->name('tekanan-darah.chart');
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




