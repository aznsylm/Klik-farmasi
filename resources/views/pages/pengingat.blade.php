@extends('layouts.app')

@section('title', 'Pengingat Minum Obat')

@section('content')
    <style>
        .form-control:focus {
            border-color: #0b5e91;
            box-shadow: 0 0 0 0.2rem rgba(11, 94, 145, 0.25);
        }
        
        .form-select:focus {
            border-color: #0b5e91;
            box-shadow: 0 0 0 0.2rem rgba(11, 94, 145, 0.25);
        }
        
        .text-primary {
            color: #0b5e91 !important;
        }
        
        .btn-primary {
            background-color: #0b5e91;
            border-color: #0b5e91;
        }
        
        .btn-primary:hover {
            background-color: #094d7a;
            border-color: #094d7a;
        }
        
        .btn-outline-primary {
            color: #0b5e91;
            border-color: #0b5e91;
        }
        
        .btn-outline-primary:hover {
            background-color: #0b5e91;
            border-color: #0b5e91;
            color: white;
        }
    </style>

    {{-- Form Pengingat Minum Obat --}}
    <section class="py-5" style="background-color: #0b5e91">
        <div class="container px-4">
            <!-- Form Pengingat -->
            <div class="card border-0 rounded-4 shadow-lg">
                <div class="card-header text-white text-center border-0 rounded-top-4 py-5 position-relative header-custom">
                    <h1 class="display-5 fw-bold mb-2 mt-3">Pengingat Minum Obat</h1>
                    <p class="mb-0" style="font-family: 'Open Sans', sans-serif; font-size: 22px; color: #fff;">Isi formulir di bawah ini untuk membuat pengingat minum obat</p>
                    <div class="header-shapes">
                        <div class="shape shape-1"></div>
                        <div class="shape shape-2"></div>
                        <div class="shape shape-3"></div>
                    </div>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <form id="formPengingat" method="POST" action="" class="needs-validation" novalidate>
                                @csrf
                                <div class="row g-4">
                                    <!-- Data Pasien Section -->
                                    <div class="col-12">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="feature text-white rounded-circle me-3" style="background-color: #0B5E91;">
                                                <i class="bi bi-person"></i>
                                            </div>
                                            <h3 class="fw-bold mb-0">Data Pasien</h3>
                                        </div>
                                        <hr class="mb-4">
                                    </div>

                                    <!-- Nama Pasien -->
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control shadow-sm" id="namaPasien" name="namaPasien" type="text" placeholder="Masukkan nama pasien" required />
                                            <label for="namaPasien"><i class="bi bi-person-badge me-1"></i>Nama Pasien</label>
                                            <div class="invalid-feedback">Nama pasien harus diisi</div>
                                        </div>
                                    </div>

                                    <!-- Jenis Kelamin -->
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select shadow-sm" id="jenisKelamin" name="jenisKelamin" required>
                                                <option value="" selected>Pilih</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                            <label for="jenisKelamin"><i class="bi bi-gender-ambiguous me-1"></i>Jenis Kelamin</label>
                                            <div class="invalid-feedback">Pilih jenis kelamin</div>
                                        </div>
                                    </div>

                                    <!-- Usia -->
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control shadow-sm" id="usia" name="usia" type="number" placeholder="Masukkan usia" required />
                                            <label for="usia"><i class="bi bi-calendar3 me-1"></i>Usia</label>
                                            <div class="invalid-feedback">Usia harus diisi</div>
                                        </div>
                                    </div>

                                    <!-- Nomor WhatsApp -->
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control shadow-sm" id="nomorWa" name="nomorWa" type="tel" placeholder="+62 812-3456-7890" pattern="^\+62\s?\d{3,4}-\d{3,4}-\d{3,4}$" required />
                                            <label for="nomorWa"><i class="bi bi-whatsapp me-1"></i>Nomor WhatsApp</label>
                                            <div class="invalid-feedback">Format: +62 812-3456-7890</div>
                                        </div>
                                        <div class="form-text text-muted">Format: +62 812-3456-7890</div>
                                    </div>

                                    <!-- Data Medis Section -->
                                    <div class="col-12 mt-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="feature text-white rounded-circle me-3" style="background-color: #0B5E91;">
                                                <i class="bi bi-heart-pulse"></i>
                                            </div>
                                            <h3 class="fw-bold mb-0">Data Medis</h3>
                                        </div>
                                        <hr class="mb-4">
                                    </div>

                                    <!-- Diagnosa Penyakit -->
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select shadow-sm" id="diagnosa" name="diagnosa" required>
                                                <option value="" selected>Pilih</option>
                                                <option value="Non-Komplikasi">Hipertensi Non-Komplikasi</option>
                                                <option value="Komplikasi">Hipertensi Komplikasi</option>
                                            </select>
                                            <label for="diagnosa"><i class="bi bi-clipboard2-pulse me-1"></i>Diagnosa Penyakit</label>
                                            <div class="invalid-feedback">Pilih diagnosa penyakit</div>
                                        </div>
                                    </div>

                                    <!-- Tekanan Darah -->
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control shadow-sm" id="tekananDarah" name="tekananDarah" type="text" placeholder="Contoh: 120/80 mmHg" required />
                                            <label for="tekananDarah"><i class="bi bi-activity me-1"></i>Tekanan Darah</label>
                                            <div class="invalid-feedback">Masukkan tekanan darah</div>
                                        </div>
                                        <div class="form-text text-muted">Contoh: 120/80 mmHg</div>
                                    </div>

                                    <!-- Daftar Obat Section -->
                                    <div class="col-12 mt-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="feature text-white rounded-circle me-3" style="background-color: #0B5E91;">
                                                <i class="bi bi-capsule"></i>
                                            </div>
                                            <h3 class="fw-bold mb-0">Daftar Obat</h3>
                                        </div>
                                        <hr class="mb-4">
                                    </div>

                                    <!-- Daftar Obat Container -->
                                    <div class="col-12">
                                        <div id="obatContainer" class="mb-4"></div>
                                        <div class="d-grid gap-2 col-md-6 mx-auto mb-4">
                                            <button type="button" class="btn btn-khusus btn-lg" id="tambahObat">
                                                <i class="bi bi-plus-circle me-2"></i> Tambah Obat
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Button Submit -->
                                    <div class="col-12 mt-4">
                                        @guest
                                            <button type="button" id="submitButton" class="btn btn-khusus btn-lg btn-submit w-100 py-3">
                                                <i class="bi bi-box-arrow-in-right me-2"></i> Submit
                                            </button>
                                        @endguest

                                        @auth
                                            <button type="submit" class="btn btn-primary btn-lg btn-submit w-100 py-3">
                                                <i class="bi bi-check-circle me-2"></i> Submit
                                            </button>
                                        @endauth
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pop-up -->
    <div class="popup-overlay" id="popupOverlay" style="display: none;">
        <div class="popup-content position-relative">
            <!-- Tombol Close -->
            <button id="closePopup" class="popup-close">&times;</button>
            <div class="text-center mb-4">
                <i class="bi bi-shield-lock text-primary" style="font-size: 3rem;"></i>
                <h2 class="mt-3 fw-bold">Login Diperlukan</h2>
                <p class="text-muted">Anda harus login terlebih dahulu untuk mengirimkan data.</p>
            </div>
            <div class="popup-buttons d-grid gap-2">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                    <i class="bi bi-person-plus me-2"></i> Register
                </a>
            </div>
        </div>
    </div>
@endsection