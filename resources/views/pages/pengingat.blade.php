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
                <div class="notification-icon"></div>
                <div class="notification-text">
                    <div class="notification-title">Berhasil</div>
                    <div class="notification-message">{{ session('success') }}</div>
                </div><button type="button" class="notification-close" onclick="closeNotification()">×</button>
            </div>
        </div>
    @endif
    @if (session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    {{-- Form Pengingat Minum Obat --}}
    <section class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container px-4">
            
            <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <div class="card-header" >
                    <h2>Form Pengingat Obat</h2>
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
                                            <div class="text-center mb-3">
                                                <h3 class="fw-bold mb-2" style="font-size: 2rem; color: #0B5E91;">LANGKAH 1</h3>
                                                <h4 class="fw-bold text-dark mb-1" style="font-size: 1.5rem;">Kondisi Kesehatan Anda</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <div class="input-wrapper">
                                                <label for="diagnosa" class="form-label fw-bold text-dark mb-3" style="font-size: 1.3rem;">
                                                    Jenis Hipertensi Anda:
                                                </label>
                                                <div class="input-with-tooltip">
                                                    <select class="form-select shadow-sm {{ $errors->has('diagnosa') ? 'is-invalid' : '' }}" id="diagnosa" name="diagnosa" required style="font-size: 1.2rem; padding: 1rem;">
                                                        <option value="" selected hidden>-- Pilih salah satu --</option>
                                                        <option value="Hipertensi-Non-Kehamilan" {{ old('diagnosa') == 'Hipertensi-Non-Kehamilan' ? 'selected' : '' }}>Hipertensi Non-Kehamilan</option>
                                                        <option value="Hipertensi-Kehamilan" {{ old('diagnosa') == 'Hipertensi-Kehamilan' ? 'selected' : '' }}>Hipertensi saat Hamil</option>
                                                        <option value="Kehamilan" {{ old('diagnosa') == 'Kehamilan' ? 'selected' : '' }}>Kehamilan</option>
                                                    </select>
                                                    <div class="info-icon" data-tooltip="Aturan: Semua kategori minimal 1 dan maksimal 5 obat/suplemen">
                                                        <i class="fas fa-question-circle"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('diagnosa')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    <span>{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <div class="input-wrapper">
                                                <label class="form-label fw-bold text-dark mb-3" style="font-size: 1.3rem;">
                                                    Tekanan Darah Terakhir:
                                                </label>
                                                <div class="input-with-tooltip">
                                                    <div class="input-group shadow-sm {{ $errors->has('sistol') || $errors->has('diastol') || $errors->has('tekananDarah') ? 'is-invalid' : '' }}" style="font-size: 1.2rem;">
                                                        <input type="number" class="form-control" id="sistolInput" name="sistol" placeholder="140" min="50" max="250" required style="font-size: 1.2rem; padding: 1rem;" value="{{ old('sistol') }}">
                                                        <span class="input-group-text" style="font-size: 1.5rem; font-weight: bold;">/</span>
                                                        <input type="number" class="form-control" id="diastolInput" name="diastol" placeholder="90" min="50" max="150" required style="font-size: 1.2rem; padding: 1rem;" value="{{ old('diastol') }}">
                                                        <input type="hidden" id="tekananDarah" name="tekananDarah" value="{{ old('tekananDarah') }}">
                                                    </div>
                                                    <div class="info-icon" data-tooltip="Angka sistol (50-250) dan diastol (50-150)">
                                                        <i class="fas fa-question-circle"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('sistol')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    <span>{{ $message }}</span>
                                                </div>
                                            @enderror
                                            @error('diastol')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    <span>{{ $message }}</span>
                                                </div>
                                            @enderror
                                            @error('tekananDarah')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    <span>{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Daftar Obat Section -->
                                    <div class="col-12 mt-5">
                                        <div class="bg-light p-4 rounded-4 border border-2 mb-4" style="border-color: #0B5E91 !important;">
                                            <div class="text-center mb-3">
                                                <h3 class="fw-bold mb-2" style="font-size: 2rem; color: #0B5E91;">LANGKAH 2</h3>
                                                <h4 class="fw-bold text-dark mb-1" style="font-size: 1.5rem;">Obat-Obat Anda</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div id="obatContainer" class="mb-4"></div>
                                        <div class="text-center  mb-4 p-5 rounded-4 border border-3" style="background: rgba(11, 94, 145, 0.1); border-color: #0B5E91 !important;">
                                            <p class="fs-4 text-dark mb-4 fw-bold text-center">
                                                Klik tombol di bawah untuk menambah obat pertama Anda
                                            </p>
                                            <button type="button" class="btn btn-lg px-5 py-4 text-center" id="tambahObat" style="font-size: 1.4rem; border-radius: 15px; min-height: 70px; background-color: #0B5E91; border: none; color: white;">
                                                TAMBAH OBAT PERTAMA
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Pengaturan Pengingat Section -->
                                    <div class="col-12 mt-5">
                                        <div class="bg-light p-4 rounded-4 border border-2 mb-4" style="border-color: #0B5E91 !important;">
                                            <div class="text-center mb-3">
                                                <h3 class="fw-bold mb-2" style="font-size: 2rem; color: #0B5E91;">LANGKAH 3</h3>
                                                <h4 class="fw-bold text-dark mb-1" style="font-size: 1.5rem;">Atur Waktu Pengingat</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <div class="input-wrapper">
                                                <label for="tanggal_mulai" class="form-label fw-bold text-dark mb-3" style="font-size: 1.3rem;">
                                                    Mulai Pengingat:
                                                </label>
                                                <div class="input-with-tooltip">
                                                    <input class="form-control shadow-sm {{ $errors->has('tanggal_mulai') ? 'is-invalid' : '' }}" id="tanggal_mulai" name="tanggal_mulai" type="date" style="font-size: 1.2rem; padding: 1rem;" 
                                                        min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+1 year')) }}" value="{{ old('tanggal_mulai', date('Y-m-d', strtotime('+1 day'))) }}" required />
                                                    <div class="info-icon" data-tooltip="Kapan Anda ingin mulai mendapat pengingat minum obat. Default: Besok (bisa diubah sesuai kebutuhan)">
                                                        <i class="fas fa-question-circle"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('tanggal_mulai')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    <span>{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <div class="input-wrapper">
                                                <label for="catatan" class="form-label fw-bold text-dark mb-3" style="font-size: 1.3rem;">
                                                    Catatan Khusus (Boleh Dikosongkan):
                                                </label>
                                                <div class="input-with-tooltip">
                                                    <textarea class="form-control shadow-sm {{ $errors->has('catatan') ? 'is-invalid' : '' }}" id="catatan" name="catatan" style="height: 120px; font-size: 1.1rem; padding: 1rem;"
                                                        placeholder="Tulis keluhan atau catatan khusus jika ada..." maxlength="500">{{ old('catatan') }}</textarea>
                                                    <div class="info-icon" data-tooltip="Keluhan selama pengobatan, efek samping obat, atau catatan khusus lainnya">
                                                        <i class="fas fa-question-circle"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('catatan')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    <span>{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <div class="text-center p-5 rounded-4 border border-2" style="background: rgba(11, 94, 145, 0.1); border-color: #0B5E91 !important;">
                                            <h4 class="fw-bold text-dark mb-3" style="font-size: 1.8rem;">Siap Menyimpan Pengingat?</h4>
                                            @guest
                                                <p class="fs-5 text-dark mb-4">
                                                    Anda perlu masuk ke akun terlebih dahulu untuk menyimpan pengingat obat
                                                </p>
                                                <button type="button" class="btn btn-lg px-5 py-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#loginModal" style="font-size: 1.4rem; border-radius: 15px; background-color: #0B5E91; border: none; color: white;">
                                                    MASUK KE AKUN
                                                </button>
                                                <p class="text-muted mt-3 mb-0 fs-6">
                                                    Gratis dan aman
                                                </p>
                                            @endguest
                                            @auth
                                                @if(auth()->user()->role === 'pasien')
                                                    <p class="fs-5 text-dark mb-4">
                                                        Klik tombol di bawah untuk menyimpan pengingat obat Anda
                                                    </p>
                                                    <button type="submit" class="btn btn-lg px-5 py-4 shadow-sm" style="font-size: 1.4rem; border-radius: 15px; background-color: #0B5E91; border: none; color: white;">
                                                        SIMPAN PENGINGAT SAYA
                                                    </button>
                                                @else
                                                    <p class="fs-5 text-dark mb-4">
                                                        Anda login sebagai {{ auth()->user()->role === 'admin' ? 'Admin' : 'Super Admin' }}. Fitur ini hanya untuk pasien.
                                                    </p>
                                                    <div class="alert alert-info">
                                                        Hanya pasien yang dapat menyimpan pengingat obat. Anda dapat melihat form ini untuk keperluan administrasi.
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="alert alert-success alert-dismissible fade show d-none"
                                            id="successAlert" role="alert"><strong>Berhasil!</strong> Data
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

<!-- Validation Popup -->
<div class="validation-popup" id="validationPopup">
    <div class="validation-container">
        <h4 class="validation-title">Mohon Lengkapi Data</h4>
        <div class="validation-message" id="validationMessage"></div>
        <button type="button" class="validation-btn" onclick="closeValidationPopup()">Mengerti</button>
    </div>
</div>
@endsection

@push('scripts')
<style>
/* Optimized CSS - Mobile First Responsive */
.form-control:focus, .form-select:focus {
    border-color: #0B5E91;
    box-shadow: 0 0 0 0.2rem rgba(11, 94, 145, 0.25);
}

.form-select, .form-control {
    min-height: 50px;
    font-weight: 500;
}

.form-label {
    font-weight: 700 !important;
    margin-bottom: 0.8rem !important;
}

.btn-lg {
    min-height: 50px;
    font-weight: 700;
}

.card-header {
    background-color: #0B5E91 !important;
    color: white !important;
    text-align: center !important;
    padding: 2rem 1rem !important;
}

.card-header h2 {
    font-size: 1.8rem !important;
    font-weight: 700 !important;
    margin-bottom: 0 !important;
    color: white !important;
}

.card-header p {
    font-size: 1rem !important;
    margin-bottom: 0 !important;
    margin-top: 0.5rem !important;
    opacity: 0.9 !important;
    color: white !important;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .container {
        padding: 0.5rem;
    }
    
    .card-body {
        padding: 1rem !important;
    }
    
    .form-select, .form-control {
        font-size: 1rem !important;
        padding: 0.75rem !important;
    }
    
    .btn-lg {
        font-size: 1.1rem !important;
        padding: 0.75rem 1.5rem !important;
    }
    
    .input-group-text {
        font-size: 1.2rem !important;
    }
    
    h3 {
        font-size: 1.5rem !important;
    }
    
    h4 {
        font-size: 1.2rem !important;
    }
}

/* Tablet Responsive */
@media (min-width: 769px) and (max-width: 1024px) {
    .form-select, .form-control {
        min-height: 55px;
    }
    
    .card-header {
        padding: 2.5rem 1.5rem !important;
    }
    
    .card-header h2 {
        font-size: 2.2rem !important;
    }
}

/* Desktop */
@media (min-width: 1025px) {
    .form-select, .form-control {
        min-height: 60px;
    }
    
    .card-header {
        padding: 3rem 1.5rem !important;
    }
    
    .card-header h2 {
        font-size: 2.5rem !important;
    }
}

/* Error styling */
.is-invalid {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
}

.input-group.is-invalid {
    border-color: #dc3545;
}

.input-group.is-invalid .form-control {
    border-color: #dc3545;
}

.error-message {
    display: flex;
    align-items: center;
    gap: 5px;
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 5px;
    font-weight: 500;
}

.error-message i {
    font-size: 0.8rem;
}

/* Input wrapper with tooltip */
.input-with-tooltip {
    position: relative;
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
}

.input-with-tooltip .form-select,
.input-with-tooltip .form-control,
.input-with-tooltip .input-group {
    flex: 1;
    min-width: 0;
}

.info-icon {
    color: #6c757d;
    cursor: help;
    font-size: 0.9rem;
}

.info-icon:hover {
    color: #0B5E91;
}

/* Tooltip */
.info-icon[data-tooltip]:hover::after {
    content: attr(data-tooltip);
    position: absolute;
    bottom: 125%;
    right: 0;
    background: #333;
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 0.8rem;
    white-space: nowrap;
    z-index: 1000;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    max-width: 300px;
    white-space: normal;
    text-align: center;
}

.info-icon[data-tooltip]:hover::before {
    content: '';
    position: absolute;
    bottom: 115%;
    right: 10px;
    border: 5px solid transparent;
    border-top-color: #333;
    z-index: 1000;
}

/* Validation Popup */
.validation-popup {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.6);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 1000;
}

.validation-popup.show {
    display: flex;
}

.validation-container {
    background-color: white;
    padding: 2rem;
    border-radius: 15px;
    width: 90%;
    max-width: 400px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.validation-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #0B5E91;
    margin-bottom: 1rem;
}

.validation-message {
    font-size: 1.1rem;
    color: #333;
    margin-bottom: 1.5rem;
    line-height: 1.5;
}

.validation-btn {
    background-color: #0B5E91;
    color: white;
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 10px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s;
}

.validation-btn:hover {
    background-color: #094a73;
}
</style>

<script>
// Optimized form validation
document.addEventListener('DOMContentLoaded', function() {
    const sistol = document.getElementById('sistolInput');
    const diastol = document.getElementById('diastolInput');
    const hidden = document.getElementById('tekananDarah');
    const form = document.getElementById('formPengingat');
    
    function update() {
        if (sistol.value && diastol.value) {
            hidden.value = sistol.value + '/' + diastol.value;
        }
    }
    
    if (sistol && diastol) {
        sistol.oninput = diastol.oninput = update;
    }
    
    // Input sanitization
    const catatan = document.getElementById('catatan');
    if (catatan) {
        catatan.oninput = e => e.target.value = e.target.value.replace(/[<>"']/g, '');
    }
    
    // Form validation with popup
    if (form) {
        form.onsubmit = function(e) {
            e.preventDefault();
            
            const diagnosa = document.getElementById('diagnosa').value;
            const s = +sistol.value, d = +diastol.value;
            const obatCards = document.querySelectorAll('.obat-card');
            
            let errorMessage = '';
            
            // Check diagnosa
            if (!diagnosa) {
                errorMessage = 'Silakan pilih jenis hipertensi Anda terlebih dahulu.';
            }
            // Check tekanan darah
            else if (!s || !d) {
                errorMessage = 'Mohon isi kedua nilai tekanan darah (sistol dan diastol).';
            }
            else if (s < 50 || s > 250 || d < 50 || d > 150) {
                errorMessage = 'Nilai tekanan darah tidak valid. Sistol harus 50-250, Diastol harus 50-150.';
            }
            // Check if no drugs added
            else if (obatCards.length === 0) {
                errorMessage = 'Silakan tambahkan minimal satu obat terlebih dahulu.';
            }
            // Check drug details
            else {
                let drugError = false;
                const isKehamilan = diagnosa === 'Kehamilan';
                obatCards.forEach((card, index) => {
                    const namaObat = card.querySelector('select[name="namaObat[]"]');
                    const jumlahObat = card.querySelector('select[name="jumlahObat[]"]').value;
                    const waktuMinum = card.querySelector('select[name="waktuMinum[]"]').value;
                    const suplemen = card.querySelector('select[name="suplemen[]"]');
                    
                    if (isKehamilan) {
                        // Untuk kehamilan: suplemen, jumlah, waktu wajib
                        if (!suplemen.value || !jumlahObat || !waktuMinum) {
                            errorMessage = `Mohon lengkapi data suplemen ke-${index + 1} (jenis suplemen, jumlah, dan waktu minum).`;
                            drugError = true;
                            return;
                        }
                    } else {
                        // Untuk non-kehamilan: nama obat, jumlah, waktu wajib
                        if (!namaObat.value || !jumlahObat || !waktuMinum) {
                            errorMessage = `Mohon lengkapi data obat ke-${index + 1} (nama obat, jumlah, dan waktu minum).`;
                            drugError = true;
                            return;
                        }
                    }
                });
                
                if (drugError) {
                    // Error message already set
                } else {
                    // All validation passed
                    update();
                    form.submit();
                    return;
                }
            }
            
            // Show validation popup
            if (errorMessage) {
                showValidationPopup(errorMessage);
            }
        };
    }
});

// Validation popup functions
function showValidationPopup(message) {
    document.getElementById('validationMessage').textContent = message;
    document.getElementById('validationPopup').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeValidationPopup() {
    document.getElementById('validationPopup').classList.remove('show');
    document.body.style.overflow = 'auto';
}

// Close popup when clicking outside
document.addEventListener('click', function(e) {
    const popup = document.getElementById('validationPopup');
    if (e.target === popup) {
        closeValidationPopup();
    }
});
</script>


@endpush
