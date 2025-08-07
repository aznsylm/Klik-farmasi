@extends('layouts.app')
@section('title', 'Pengingat Minum Obat - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description" content="Buat pengingat minum obat untuk hipertensi. Atur jadwal obat harian dengan mudah dan dapatkan notifikasi tepat waktu.">
    <meta name="keywords" content="pengingat obat, jadwal minum obat, hipertensi, manajemen obat, alarm obat">
    <meta name="author" content="Tim Farmasi Universitas Alma Ata">
@endpush

@section('content')
    @if (session('error'))
        <div class="error-notification show" id="errorNotification">
            <div class="notification-content">
                <div class="notification-icon"><i class="bi bi-exclamation-circle-fill"></i></div>
                <div class="notification-text">
                    <div class="notification-title">Error</div>
                    <div class="notification-message">{{ session('error') }}</div>
                </div><button type="button" class="notification-close" onclick="closeErrorNotification()">×</button>
            </div>
        </div>
    @endif
    @if (session('success'))
        <div class="success-notification show" id="successNotification">
            <div class="notification-content">
                <div class="notification-icon"><i class="bi bi-check-circle-fill"></i></div>
                <div class="notification-text">
                    <div class="notification-title">Berhasil</div>
                    <div class="notification-message">{{ session('success') }}</div>
                </div><button type="button" class="notification-close" onclick="closeNotification()">×</button>
            </div>
        </div>
    @endif
    {{-- Form Pengingat Minum Obat --}}
    <section class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container px-4">
            <!-- Header Section -->
            <div class="text-center mb-5" data-aos="fade-up">
                <h1 class="display-4 fw-bold mb-4" style="font-size: 3rem; color: #0B5E91;">Pengingat Minum Obat</h1>
                <p class="fs-4 text-dark mx-auto fw-medium" style="max-width: 700px; line-height: 1.6;">
                    Bantu Anda ingat minum obat setiap hari.<br>
                    <span style="color: #0B5E91;">Isi form ini dengan mudah, langkah demi langkah.</span>
                </p>
                <div class="d-flex justify-content-center mt-4">
                    <div class="bg-gradient" style="width: 120px; height: 6px; background: linear-gradient(90deg, #0B5E91, #baa971); border-radius: 3px;"></div>
                </div>
            </div>
            
            <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;" data-aos="fade-up" data-aos-delay="100">
                <div class="card-header text-white text-center py-5 position-relative" style="background-color: #0B5E91;">
                    <h2 class="mb-0 fw-bold" style="font-size: 2.5rem;">📋 Form Pengingat Obat</h2>
                    <p class="mb-0 mt-2 fs-5 opacity-90">Ikuti 3 langkah mudah di bawah ini</p>
                    <div class="position-absolute top-0 end-0 opacity-25" style="font-size: 8rem; line-height: 1; margin-top: -2rem; margin-right: -1rem;">
                        <i class="bi bi-capsule"></i>
                    </div>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <form id="formPengingat" method="POST" action="{{ route('pengingat.store') }}"
                                class="needs-validation" novalidate>
                                @csrf
                                <div class="row g-4">
                                    <!-- Data Medis Section -->
                                    <div class="col-12">
                                        <div class="bg-light p-4 rounded-4 border border-2 mb-4" style="border-color: #0B5E91 !important;">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center me-4" style="width: 70px; height: 70px; background-color: #0B5E91;">
                                                    <i class="bi bi-heart-pulse text-white" style="font-size: 1.8rem;"></i>
                                                </div>
                                                <div>
                                                    <h3 class="fw-bold mb-2" style="font-size: 2rem; color: #0B5E91;">LANGKAH 1</h3>
                                                    <h4 class="fw-bold text-dark mb-1" style="font-size: 1.5rem;">Ceritakan Kondisi Kesehatan Anda</h4>
                                                    <p class="text-dark mb-0 fs-5">Kami perlu tahu jenis hipertensi dan tekanan darah terakhir</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label for="diagnosa" class="form-label fw-bold text-dark mb-3" style="font-size: 1.3rem;">
                                                <i class="bi bi-clipboard2-pulse me-2" style="color: #0B5E91;"></i>Jenis Hipertensi Anda:
                                            </label>
                                            <select class="form-select shadow-sm" id="diagnosa" name="diagnosa" required style="font-size: 1.2rem; padding: 1rem;">
                                                <option value="" selected hidden>-- Pilih salah satu --</option>
                                                <option value="Hipertensi-Non-Kehamilan">Hipertensi Non-Kehamilan</option>
                                                <option value="Hipertensi-Kehamilan">Hipertensi saat Hamil</option>
                                            </select>
                                            <div class="form-text mt-2 fs-6 text-dark">Pilih sesuai dengan kondisi Anda saat ini</div>
                                            <div class="invalid-feedback fs-6">Mohon pilih jenis hipertensi Anda</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label for="tekananDarah" class="form-label fw-bold text-dark mb-3" style="font-size: 1.3rem;">
                                                <i class="bi bi-activity me-2" style="color: #0B5E91;"></i>Tekanan Darah Terakhir:
                                            </label>
                                            <input class="form-control shadow-sm" id="tekananDarah" name="tekananDarah" type="text"
                                                placeholder="Contoh: 140/90" required style="font-size: 1.2rem; padding: 1rem;" />
                                            <div class="form-text mt-2 fs-6 text-dark">
                                                <strong>Cara mengisi:</strong> Angka atas/angka bawah (contoh: 140/90)<br>
                                                <em>Lihat hasil cek tekanan darah terakhir Anda</em>
                                            </div>
                                            <div class="invalid-feedback fs-6">Mohon masukkan tekanan darah terakhir</div>
                                        </div>
                                    </div>
                                    <!-- Daftar Obat Section -->
                                    <div class="col-12 mt-5">
                                        <div class="bg-light p-4 rounded-4 border border-2 mb-4" style="border-color: #baa971 !important;">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center me-4" style="width: 70px; height: 70px; background-color: #baa971;">
                                                    <i class="bi bi-capsule text-white" style="font-size: 1.8rem;"></i>
                                                </div>
                                                <div>
                                                    <h3 class="fw-bold mb-2" style="font-size: 2rem; color: #baa971;">LANGKAH 2</h3>
                                                    <h4 class="fw-bold text-dark mb-1" style="font-size: 1.5rem;">Masukkan Obat-Obat Anda</h4>
                                                    <p class="text-dark mb-0 fs-5">Tambahkan semua obat hipertensi yang harus diminum rutin</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div id="obatContainer" class="mb-4"></div>
                                        <div class="text-center mb-4 p-5 rounded-4 border border-3" style="background: rgba(186, 169, 113, 0.1); border-color: #baa971 !important;">
                                            <div class="mb-4">
                                                <i class="bi bi-plus-circle-fill" style="font-size: 3rem; color: #baa971;"></i>
                                            </div>
                                            <p class="fs-4 text-dark mb-4 fw-bold">
                                                Klik tombol di bawah untuk menambah obat pertama Anda
                                            </p>
                                            <button type="button" class="btn btn-lg px-5 py-4" id="tambahObat" style="font-size: 1.4rem; border-radius: 15px; min-height: 70px; background-color: #baa971; border: none; color: white;">
                                                <i class="bi bi-plus-circle me-3"></i>TAMBAH OBAT PERTAMA
                                            </button>
                                            <p class="text-muted mt-3 mb-0 fs-6">
                                                <i class="bi bi-lightbulb me-1"></i>
                                                Siapkan resep dokter untuk memudahkan pengisian
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Pengaturan Pengingat Section -->
                                    <div class="col-12 mt-5">
                                        <div class="bg-light p-4 rounded-4 border border-2 mb-4" style="border-color: #0B5E91 !important;">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center me-4" style="width: 70px; height: 70px; background-color: #0B5E91;">
                                                    <i class="bi bi-bell text-white" style="font-size: 1.8rem;"></i>
                                                </div>
                                                <div>
                                                    <h3 class="fw-bold mb-2" style="font-size: 2rem; color: #0B5E91;">LANGKAH 3</h3>
                                                    <h4 class="fw-bold text-dark mb-1" style="font-size: 1.5rem;">Atur Waktu Pengingat</h4>
                                                    <p class="text-dark mb-0 fs-5">Tentukan kapan pengingat mulai aktif dan catatan khusus</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label for="tanggal_mulai" class="form-label fw-bold text-dark mb-3" style="font-size: 1.3rem;">
                                                <i class="bi bi-calendar-event me-2" style="color: #0B5E91;"></i>Mulai Pengingat Tanggal:
                                            </label>
                                            <input class="form-control shadow-sm" id="tanggal_mulai" name="tanggal_mulai" type="date" required style="font-size: 1.2rem; padding: 1rem;" />
                                            <div class="form-text mt-2 fs-6 text-dark">
                                                <strong>Pilih tanggal:</strong> Kapan Anda ingin mulai mendapat pengingat minum obat<br>
                                                <em>Biasanya dimulai dari besok</em>
                                            </div>
                                            <div class="invalid-feedback fs-6">Mohon pilih tanggal mulai pengingat</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label for="catatan" class="form-label fw-bold text-dark mb-3" style="font-size: 1.3rem;">
                                                <i class="bi bi-chat-left-text me-2" style="color: #0B5E91;"></i>Catatan Khusus (Boleh Dikosongkan):
                                            </label>
                                            <textarea class="form-control shadow-sm" id="catatan" name="catatan" style="height: 120px; font-size: 1.1rem; padding: 1rem;"
                                                placeholder="Tulis catatan khusus jika ada..."></textarea>
                                            <div class="form-text mt-2 fs-6 text-dark">
                                                <strong>Contoh catatan:</strong><br>
                                                • Diminum setelah makan<br>
                                                • Jangan diminum bersamaan dengan susu<br>
                                                • Obat membuat mengantuk
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <div class="text-center p-5 rounded-4 border border-2" style="background: rgba(11, 94, 145, 0.1); border-color: #0B5E91 !important;">
                                            <div class="mb-4">
                                                <i class="bi bi-check-circle-fill" style="font-size: 3rem; color: #baa971;"></i>
                                            </div>
                                            <h4 class="fw-bold text-dark mb-3" style="font-size: 1.8rem;">Siap Menyimpan Pengingat?</h4>
                                            @guest
                                                <p class="fs-5 text-dark mb-4">
                                                    Anda perlu masuk ke akun terlebih dahulu untuk menyimpan pengingat obat
                                                </p>
                                                <button type="button" class="btn btn-lg px-5 py-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#loginModal" style="font-size: 1.4rem; border-radius: 15px; background-color: #0B5E91; border: none; color: white;">
                                                    <i class="bi bi-box-arrow-in-right me-3"></i>MASUK KE AKUN
                                                </button>
                                                <p class="text-muted mt-3 mb-0 fs-6">
                                                    <i class="bi bi-shield-check me-1"></i>
                                                    Gratis dan aman
                                                </p>
                                            @endguest
                                            @auth
                                                <p class="fs-5 text-dark mb-4">
                                                    Klik tombol di bawah untuk menyimpan pengingat obat Anda
                                                </p>
                                                <button type="submit" class="btn btn-lg px-5 py-4 shadow-sm" style="font-size: 1.4rem; border-radius: 15px; background-color: #baa971; border: none; color: white;">
                                                    <i class="bi bi-check-circle me-3"></i>SIMPAN PENGINGAT SAYA
                                                </button>
                                            @endauth
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="alert alert-success alert-dismissible fade show d-none"
                                            id="successAlert" role="alert"><i
                                                class="bi bi-check-circle-fill me-2"></i><strong>Berhasil!</strong> Data
                                            pengingat Anda telah disimpan.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bootstrap Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-5">
                    <div class="bg-primary bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                        <i class="bi bi-shield-lock text-white" style="font-size: 2rem;"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Login Diperlukan</h4>
                    <p class="text-muted mb-4">Anda harus login terlebih dahulu untuk menyimpan pengingat obat dan mengakses fitur eksklusif lainnya.</p>
                    <div class="d-grid gap-3">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                             Masuk ke Akun
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg rounded-pill">
                             Daftar Gratis
                        </a>
                    </div>
                    <p class="text-muted mt-4 mb-0">
                        <small>Gratis dan hanya butuh 2 menit</small>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<style>
/* Minimal custom enhancements */
.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label,
.form-floating > .form-select ~ label {
    color: #0B5E91;
}

.form-control:focus,
.form-select:focus {
    border-color: #0B5E91;
    box-shadow: 0 0 0 0.2rem rgba(11, 94, 145, 0.25);
}

.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.btn {
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
}

#obatContainer .card {
    border: 1px solid #e3f2fd;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
}

#obatContainer .card-header {
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
    border-bottom: 1px solid #90caf9;
}

/* Elderly-friendly enhancements */
.form-select, .form-control {
    min-height: 60px;
    font-weight: 500;
}

.form-label {
    font-weight: 700 !important;
    margin-bottom: 0.8rem !important;
}

.btn-lg {
    min-height: 60px;
    font-weight: 700;
}

.form-text {
    font-weight: 500;
    line-height: 1.5;
}

/* High contrast for better readability */
.text-dark {
    color: #212529 !important;
}

.border-2 {
    border-width: 3px !important;
}

/* Focus states for accessibility */
.form-select:focus, .form-control:focus {
    border-width: 3px;
    border-color: #0B5E91 !important;
    box-shadow: 0 0 0 0.3rem rgba(11, 94, 145, 0.4);
}

.btn:focus {
    box-shadow: 0 0 0 0.3rem rgba(186, 169, 113, 0.4);
}
</style>


@endpush
