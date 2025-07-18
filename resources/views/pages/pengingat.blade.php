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

        /* Simple Notification Styles */
        .error-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 350px;
            background: #dc3545;
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }

        .error-notification.show {
            transform: translateX(0);
        }

        .success-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 350px;
            background: #28a745;
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }

        .success-notification.show {
            transform: translateX(0);
        }

        .notification-content {
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .notification-icon {
            font-size: 20px;
            flex-shrink: 0;
        }

        .notification-text {
            flex: 1;
        }

        .notification-title {
            font-weight: 600;
            margin-bottom: 4px;
            font-size: 14px;
        }

        .notification-message {
            font-size: 13px;
            opacity: 0.9;
        }

        .notification-close {
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
            padding: 0;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.7;
            transition: opacity 0.2s ease;
        }

        .notification-close:hover {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .error-notification,
            .success-notification {
                right: 10px;
                left: 10px;
                max-width: none;
            }
        }

        /* Section Headers */
        .section-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            border-left: 5px solid #0b5e91;
        }

        .section-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #0b5e91 0%, #1a7bb8 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        /* Form Controls Enhancement */
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-select:focus ~ label {
            color: #0b5e91;
            transform: scale(0.85) translateY(-0.5rem);
        }

        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(11, 94, 145, 0.15);
        }

        /* Button Enhancements */
        .btn-khusus {
            background: linear-gradient(135deg, #0b5e91 0%, #1a7bb8 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-khusus::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: all 0.5s;
        }

        .btn-khusus:hover::before {
            left: 100%;
        }

        .btn-khusus:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(11, 94, 145, 0.3);
        }

        .btn-submit {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            font-size: 18px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #20c997 0%, #28a745 100%);
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(40, 167, 69, 0.4);
        }

        /* Responsive improvements */
        @media (max-width: 768px) {
            .success-notification {
                right: 10px;
                left: 10px;
                max-width: none;
                transform: translateY(-100%);
            }
            
            .success-notification.show {
                transform: translateY(0);
            }
        }
    </style>

    <!-- Error Notification -->
    @if(session('error'))
        <div class="error-notification show" id="errorNotification">
            <div class="notification-content">
                <div class="notification-icon">
                    <i class="bi bi-exclamation-circle-fill"></i>
                </div>
                <div class="notification-text">
                    <div class="notification-title">Error</div>
                    <div class="notification-message">{{ session('error') }}</div>
                </div>
                <button type="button" class="notification-close" onclick="closeErrorNotification()">×</button>
            </div>
        </div>

        <script>
            setTimeout(function() {
                closeErrorNotification();
            }, 5000);

            function closeErrorNotification() {
                const notification = document.getElementById('errorNotification');
                if (notification) {
                    notification.classList.remove('show');
                    setTimeout(() => {
                        notification.remove();
                    }, 300);
                }
            }
        </script>
    @endif

    <!-- Success Notification -->
    @if(session('success'))
        <div class="success-notification show" id="successNotification">
            <div class="notification-content">
                <div class="notification-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div class="notification-text">
                    <div class="notification-title">Berhasil</div>
                    <div class="notification-message">{{ session('success') }}</div>
                </div>
                <button type="button" class="notification-close" onclick="closeNotification()">×</button>
            </div>
        </div>

        <script>
            setTimeout(function() {
                closeNotification();
            }, 5000);

            function closeNotification() {
                const notification = document.getElementById('successNotification');
                if (notification) {
                    notification.classList.remove('show');
                    setTimeout(() => {
                        notification.remove();
                    }, 300);
                }
            }
        </script>
    @endif
    
    {{-- Form Pengingat Minum Obat --}}
    <section class="py-5" style="background: linear-gradient(135deg, #0b5e91 0%, #1a7bb8 100%);">
        <div class="container px-4">
            <!-- Form Pengingat -->
            <div class="card main-card border-0 shadow-lg">
                <div class="card-header text-white text-center border-0 py-5 position-relative header-custom">
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
                            <form id="formPengingat" method="POST" action="{{ route('pengingat.store') }}" class="needs-validation" novalidate>
                                @csrf
                                <div class="row g-4">
                                    <!-- Data Medis Section -->
                                    <div class="col-12 mt-4">
                                        <div class="section-header">
                                            <div class="d-flex align-items-center">
                                                <div class="section-icon me-3">
                                                    <i class="bi bi-heart-pulse"></i>
                                                </div>
                                                <div>
                                                    <h3 class="fw-bold mb-1">Data Medis</h3>
                                                    <p class="text-muted mb-0">Informasi diagnosa dan kondisi medis</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Diagnosa Penyakit -->
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select shadow-sm" id="diagnosa" name="diagnosa" required>
                                                <option value="" selected>Pilih</option>
                                                <option value="Hipertensi-Non-Kehamilan">Hipertensi Non-Kehamilan</option>
                                                <option value="Hipertensi-Kehamilan">Hipertensi Kehamilan</option>
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
                                        <div class="section-header">
                                            <div class="d-flex align-items-center">
                                                <div class="section-icon me-3">
                                                    <i class="bi bi-capsule"></i>
                                                </div>
                                                <div>
                                                    <h3 class="fw-bold mb-1">Daftar Obat</h3>
                                                    <p class="text-muted mb-0">Tambahkan obat yang perlu diminum</p>
                                                </div>
                                            </div>
                                        </div>
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

                                    <!-- Pengingat Section -->
                                    <div class="col-12 mt-4">
                                        <div class="section-header">
                                            <div class="d-flex align-items-center">
                                                <div class="section-icon me-3">
                                                    <i class="bi bi-bell"></i>
                                                </div>
                                                <div>
                                                    <h3 class="fw-bold mb-1">Pengaturan Pengingat</h3>
                                                    <p class="text-muted mb-0">Atur waktu dan tanggal pengingat</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tanggal Mulai -->
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control shadow-sm" id="tanggal_mulai" name="tanggal_mulai" type="date" required />
                                            <label for="tanggal_mulai"><i class="bi bi-calendar-event me-1"></i>Tanggal Mulai Pengingat</label>
                                            <div class="invalid-feedback">Tanggal mulai harus diisi</div>
                                        </div>
                                    </div>

                                    <!-- Catatan (Opsional) -->
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control shadow-sm" id="catatan" name="catatan" placeholder="Catatan tambahan (opsional)" style="height: 100px"></textarea>
                                            <label for="catatan"><i class="bi bi-chat-left-text me-1"></i>Catatan (Opsional)</label>
                                        </div>
                                    </div>

                                    <!-- Button Submit -->
                                    <div class="col-12 mt-5">
                                        @guest
                                            <button type="button" id="submitButton" class="btn btn-khusus btn-lg btn-submit w-100 py-3">
                                                <i class="bi bi-box-arrow-in-right me-2"></i> Submit Pengingat
                                            </button>
                                        @endguest

                                        @auth
                                            <button type="submit" class="btn btn-primary btn-lg btn-submit w-100 py-3">
                                                <i class="bi bi-check-circle me-2"></i> Submit Pengingat
                                            </button>
                                        @endauth
                                    </div>
                                    
                                    <!-- Success Alert (Hidden by default) -->
                                    <div class="col-12 mt-3">
                                        <div class="alert alert-success alert-dismissible fade show d-none" id="successAlert" role="alert">
                                            <i class="bi bi-check-circle-fill me-2"></i>
                                            <strong>Berhasil!</strong> Data pengingat Anda telah disimpan.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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