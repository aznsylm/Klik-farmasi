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
    <section class="py-5">
        <div class="container px-4">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <h2 class="fw-bolder mb-3 text-primary" data-aos="fade-up">Pengingat Minum Obat</h2>
                <p class="lead text-muted mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Atur jadwal minum obat harian dengan mudah
                </p>
                <div class="d-flex justify-content-center mt-3" data-aos="fade-up" data-aos-delay="150">
                    <div class="section-divider mx-auto"></div>
                </div>
            </div>
            
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4 p-md-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <form id="formPengingat" method="POST" action="{{ route('pengingat.store') }}"
                                class="needs-validation" novalidate>
                                @csrf
                                <div class="row g-4">
                                    <!-- Data Medis Section -->
                                    <div class="col-12">
                                        <div class="step-header">
                                            <div class="step-number">1</div>
                                            <h4 class="step-title">Kondisi Kesehatan</h4>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <div class="input-wrapper">
                                                <label class="form-label">
                                                    Tekanan Darah Terakhir:
                                                </label>
                                                <div class="input-group {{ $errors->has('sistol') || $errors->has('diastol') || $errors->has('tekananDarah') ? 'is-invalid' : '' }}">
                                                    <input type="number" class="form-control" id="sistolInput" name="sistol" placeholder="140" min="50" max="250" required value="{{ old('sistol') }}">
                                                    <span class="input-group-text">/</span>
                                                    <input type="number" class="form-control" id="diastolInput" name="diastol" placeholder="90" min="50" max="150" required value="{{ old('diastol') }}">
                                                    <input type="hidden" id="tekananDarah" name="tekananDarah" value="{{ old('tekananDarah') }}">
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
                                        <div class="step-header">
                                            <div class="step-number">2</div>
                                            <h4 class="step-title">Daftar Obat</h4>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div id="obatContainer" class="mb-4"></div>
                                        <div class="add-drug-section">
                                            <p class="add-drug-text">Tambahkan obat pertama Anda</p>
                                            <button type="button" class="btn btn-primary btn-lg" id="tambahObat">
                                                Tambah Obat
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Pengaturan Pengingat Section -->
                                    <div class="col-12 mt-5">
                                        <div class="step-header">
                                            <div class="step-number">3</div>
                                            <h4 class="step-title">Waktu Pengingat</h4>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <div class="input-wrapper">
                                                <label for="tanggal_mulai" class="form-label">
                                                    Mulai Pengingat:
                                                </label>
                                                <input class="form-control {{ $errors->has('tanggal_mulai') ? 'is-invalid' : '' }}" id="tanggal_mulai" name="tanggal_mulai" type="date" 
                                                    min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+1 year')) }}" value="{{ old('tanggal_mulai', date('Y-m-d', strtotime('+1 day'))) }}" required />
                                            </div>
                                            @error('tanggal_mulai')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    <span>{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 mt-5">
                                        <div class="submit-section">
                                            @guest
                                                <p class="submit-text text-center">Masuk ke akun untuk menyimpan pengingat</p>
                                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#loginModal">
                                                    Masuk ke Akun
                                                </button>
                                            @endguest
                                            @auth
                                                @if(auth()->user()->role === 'pasien')
                                                    <button type="submit" class="btn btn-primary btn-lg">
                                                        Simpan Pengingat
                                                    </button>
                                                @else
                                                    <div class="alert alert-info">
                                                        Fitur ini hanya untuk pasien. Anda login sebagai {{ auth()->user()->role === 'admin' ? 'Admin' : 'Super Admin' }}.
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
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <h4 class="fw-bold mb-3">Login Diperlukan</h4>
                    <p class="text-muted mb-4">Masuk untuk menyimpan pengingat obat Anda</p>
                    <div class="d-grid gap-3">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                             Masuk ke Akun
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                             Daftar Gratis
                        </a>
                    </div>
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
/* Step Headers */
.step-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 30px;
    padding: 20px;
    background: #f8f9fa;
    border: 2px solid #0B5E91;
}

.step-number {
    background: #0B5E91;
    color: white;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.2rem;
}

.step-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
}

/* Add Drug Section */
.add-drug-section {
    text-align: center;
    padding: 40px 20px;
    background: #f8f9fa;
    border: 2px solid #0B5E91;
    margin-bottom: 20px;
}

.add-drug-text {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 20px;
}

/* Submit Section */
.submit-section {
    text-align: center;
    padding: 40px 20px;
    background: #f8f9fa;
    border: 2px solid #0B5E91;
}

.submit-text {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 20px;
}

/* Form Controls */
.form-control:focus, .form-select:focus {
    border-color: #0B5E91;
    box-shadow: 0 0 0 0.2rem rgba(11, 94, 145, 0.25);
}

.form-select, .form-control {
    min-height: 50px;
    font-weight: 500;
    border: 2px solid #e9ecef;
}

.form-label {
    font-weight: 700;
    margin-bottom: 10px;
    color: #2c3e50;
    font-size: 1.1rem;
}

.btn-lg {
    min-height: 50px;
    font-weight: 700;
    padding: 12px 30px;
}

.input-group-text {
    font-weight: 700;
    font-size: 1.2rem;
    background: #f8f9fa;
    border: 2px solid #e9ecef;
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
    margin-top: 8px;
    font-weight: 500;
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
    width: 90%;
    max-width: 400px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.validation-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #0B5E91;
    margin-bottom: 1rem;
}

.validation-message {
    font-size: 1rem;
    color: #333;
    margin-bottom: 1.5rem;
    line-height: 1.5;
}

.validation-btn {
    background-color: #0B5E91;
    color: white;
    border: none;
    padding: 0.75rem 2rem;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s;
}

.validation-btn:hover {
    background-color: #094a73;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .container {
        padding: 0.5rem;
    }
    
    .card-body {
        padding: 1rem !important;
    }
    
    .step-header {
        padding: 15px;
        gap: 10px;
    }
    
    .step-number {
        width: 35px;
        height: 35px;
        font-size: 1rem;
    }
    
    .step-title {
        font-size: 1.1rem;
    }
    
    .add-drug-section, .submit-section {
        padding: 25px 15px;
    }
    
    .form-select, .form-control {
        min-height: 45px;
        font-size: 1rem;
    }
    
    .btn-lg {
        font-size: 1rem;
        padding: 10px 20px;
        min-height: 45px;
    }
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
    
    
    // Form validation with popup
    if (form) {
        form.onsubmit = function(e) {
            e.preventDefault();
            
            const s = +sistol.value, d = +diastol.value;
            const obatCards = document.querySelectorAll('.obat-card');
            
            let errorMessage = '';
            
            // Check tekanan darah
            if (!s || !d) {
                errorMessage = 'Mohon isi kedua nilai tekanan darah (sistol dan diastol).';
            }
            else if (s < 50 || s > 250 || d < 50 || d > 150) {
                errorMessage = 'Nilai tekanan darah tidak valid. Sistol harus 50-250, Diastol harus 50-150.';
            }
            // Check if no drugs added
            else if (obatCards.length === 0) {
                errorMessage = 'Silakan tambahkan minimal satu obat terlebih dahulu.';
            }
            // Check drug details - Universal validation
            else {
                let drugError = false;
                obatCards.forEach((card, index) => {
                    const namaObat = card.querySelector('select[name="namaObat[]"]');
                    const jumlahObat = card.querySelector('select[name="jumlahObat[]"]').value;
                    const waktuMinum = card.querySelector('select[name="waktuMinum[]"]').value;
                    
                    // Universal validation: nama obat, jumlah, waktu wajib
                    if (!namaObat.value || !jumlahObat || !waktuMinum) {
                        errorMessage = `Mohon lengkapi data obat ke-${index + 1} (nama obat, jumlah, dan waktu minum).`;
                        drugError = true;
                        return;
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
