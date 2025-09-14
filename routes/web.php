<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengingatObatController;
use App\Http\Controllers\TekananDarahController;



Route::get('/', [PageController::class, 'beranda'])->name('beranda');
Route::get('/tanya-jawab/hipertensi-kehamilan', [PageController::class, 'tanyaJawabKehamilan'])->name('tanya-jawab.kehamilan');
Route::get('/tanya-jawab/hipertensi-non-kehamilan', [PageController::class, 'tanyaJawabNonKehamilan'])->name('tanya-jawab.non-kehamilan');
Route::get('/artikel', [PageController::class, 'artikel'])->name('artikel');
Route::get('/artikel/hipertensi-kehamilan', [PageController::class, 'artikelKehamilan'])->name('artikel.kehamilan');
Route::get('/artikel/hipertensi-non-kehamilan', [PageController::class, 'artikelNonKehamilan'])->name('artikel.non-kehamilan');
Route::get('/artikel/hipertensi-kehamilan/{slug}', [PageController::class, 'artikelDetail'])->name('artikel.detail.kehamilan');
Route::get('/artikel/hipertensi-non-kehamilan/{slug}', [PageController::class, 'artikelDetail'])->name('artikel.detail.non-kehamilan');
Route::get('/unduhan', [PageController::class, 'unduhan'])->name('unduhan');
Route::get('/pengingat', [PengingatObatController::class, 'showForm'])->name('pengingat');
Route::get('/berita', [PageController::class, 'berita'])->name('pages.berita');
Route::get('/petunjuk', [PageController::class, 'petunjuk'])->name('petunjuk');
Route::get('/tim-pengelola', [PageController::class, 'timPengelola'])->name('tim-pengelola');
Route::post('/pengingat', [PengingatObatController::class, 'store'])->name('pengingat.store');

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
        return redirect()->route('superadmin.users', ['role' => 'admin']);
    })->name('dashboard');

    // Tambahkan route kelola admin & pasien
    Route::get('/users', [AdminController::class, 'index'])->name('users');

    Route::get('/users/create', [AdminController::class, 'create'])->name('users.create');
    Route::post('/users/create-admin', [AdminController::class, 'addAdmin'])->name('addAdmin');
    Route::post('/users/create-pasien', [AdminController::class, 'addPasien'])->name('addPasien');
    Route::get('/users/{id}', [AdminController::class, 'show'])->name('userDetail');
    Route::get('/users/{id}/edit', [AdminController::class, 'edit'])->name('userEdit');
    Route::put('/users/{id}', [AdminController::class, 'update'])->name('userUpdate');
    Route::post('/pengingat/{id}/stop', [PengingatObatController::class, 'stopPengobatan'])->name('pengingat.stop');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('deleteUser');


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
    
    // Kelola Pengingat Obat
    Route::post('/pengingat/{id}/stop', [PengingatObatController::class, 'stopPengobatan'])->name('pengingat.stop');

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
    Route::get('/kode-pendaftaran/create', [\App\Http\Controllers\Admin\KodePendaftaranController::class, 'create'])->name('kode-pendaftaran.create');
    Route::post('/kode-pendaftaran', [\App\Http\Controllers\Admin\KodePendaftaranController::class, 'store'])->name('kode-pendaftaran.store');
    Route::patch('/kode-pendaftaran/{kodePendaftaran}/status', [\App\Http\Controllers\Admin\KodePendaftaranController::class, 'updateStatus'])->name('kode-pendaftaran.update-status');
    
    // Kelola Catatan Admin
    Route::post('/catatan', [\App\Http\Controllers\CatatanAdminController::class, 'simpan'])->name('catatan.simpan');
    Route::put('/catatan/{id}', [\App\Http\Controllers\CatatanAdminController::class, 'update'])->name('catatan.update');
    Route::delete('/catatan/{id}', [\App\Http\Controllers\CatatanAdminController::class, 'hapus'])->name('catatan.hapus');
    
    // Reset Password Pasien
    Route::post('/pasien/{id}/reset-password', [AdminController::class, 'resetPassword'])->name('pasien.resetPassword');
    
    // Kelola Obat Pasien
    Route::post('/obat', [\App\Http\Controllers\DetailObatController::class, 'store'])->name('obat.store');
    Route::put('/obat/{id}', [\App\Http\Controllers\DetailObatController::class, 'update'])->name('obat.update');
    Route::delete('/obat/{id}', [\App\Http\Controllers\DetailObatController::class, 'destroy'])->name('obat.delete');
    
    // Kelola Tekanan Darah Pasien
    Route::get('/pasien/{id}/tekanan-darah/chart', [TekananDarahController::class, 'getAdminChartData'])->name('pasien.tekanan-darah.chart');
    Route::get('/pasien/{id}/tekanan-darah/pdf', [TekananDarahController::class, 'generatePDFReport'])->name('pasien.tekanan-darah.pdf');
    Route::post('/tekanan-darah', [TekananDarahController::class, 'adminStore'])->name('tekanan-darah.store');
    Route::put('/tekanan-darah/{id}', [TekananDarahController::class, 'adminUpdate'])->name('tekanan-darah.update');
    Route::delete('/tekanan-darah/{id}', [TekananDarahController::class, 'adminDelete'])->name('tekanan-darah.delete');
});

// Dashboard User
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':pasien'])->group(function () {
    // Dashboard
    Route::get('/user/dashboard', [PengingatObatController::class, 'index'])->name('user.dashboard');
    

    
    // Tekanan Darah routes
    Route::post('/tekanan-darah', [TekananDarahController::class, 'store'])->name('tekanan-darah.store');
    Route::get('/tekanan-darah/chart', [TekananDarahController::class, 'getChartData'])->name('tekanan-darah.chart');
    Route::post('/catatan', [TekananDarahController::class, 'updateCatatan'])->name('catatan.update');
    
    // Catatan dari Admin
    Route::get('/catatan-admin', [\App\Http\Controllers\CatatanAdminController::class, 'getCatatanPasien'])->name('catatan-admin.get');
    Route::post('/catatan-admin/{id}/baca', [\App\Http\Controllers\CatatanAdminController::class, 'tandaiSudahBaca'])->name('catatan-admin.baca');
    
    // Download PDF Report
    Route::get('/tekanan-darah/pdf', [TekananDarahController::class, 'generateUserPDFReport'])->name('user.tekanan-darah.pdf');
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




