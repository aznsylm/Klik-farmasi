@extends('layouts.app')
@section('title', 'Pengingat Minum Obat')
@section('content')
    <style>
        .main-card {
            border-radius: 20px !important;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .1) !important
        }

        .header-custom {
            background: linear-gradient(135deg, #0b5e91 0%, #1a7bb8 100%) !important;
            position: relative;
            overflow: hidden
        }

        .header-shapes {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            overflow: hidden
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, .1);
            border-radius: 50%
        }

        .shape-1 {
            width: 100px;
            height: 100px;
            top: -50px;
            right: -50px;
            animation: float 6s ease-in-out infinite
        }

        .shape-2 {
            width: 60px;
            height: 60px;
            bottom: -30px;
            left: -30px;
            animation: float 8s ease-in-out infinite reverse
        }

        .shape-3 {
            width: 80px;
            height: 80px;
            top: 50%;
            left: 10%;
            animation: float 7s ease-in-out infinite
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px)
            }

            50% {
                transform: translateY(-20px)
            }
        }

        .section-header {
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 1rem;
            margin-bottom: 2rem
        }

        .section-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #0b5e91 0%, #1a6fa0 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem
        }

        .form-floating {
            position: relative
        }

        .form-floating>.form-control,
        .form-floating>.form-select {
            height: calc(3.5rem + 2px);
            line-height: 1.25;
            padding: 1rem .75rem .25rem
        }

        .form-floating>label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            padding: 1rem .75rem;
            pointer-events: none;
            border: 1px solid transparent;
            transform-origin: 0 0;
            transition: opacity .1s ease-in-out, transform .1s ease-in-out
        }

        .form-floating>.form-control:focus~label,
        .form-floating>.form-control:not(:placeholder-shown)~label,
        .form-floating>.form-select~label {
            opacity: .65;
            transform: scale(.85) translateY(-.5rem) translateX(.15rem)
        }

        .form-control:focus {
            border-color: #0b5e91;
            box-shadow: 0 0 0 .2rem rgba(11, 94, 145, .25)
        }

        .form-select:focus {
            border-color: #0b5e91;
            box-shadow: 0 0 0 .2rem rgba(11, 94, 145, .25)
        }

        .btn-khusus {
            background: linear-gradient(135deg, #baa971 0%, #d4c589 100%);
            border: none;
            color: white;
            padding: .75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all .3s ease;
            box-shadow: 0 4px 15px rgba(186, 169, 113, .3)
        }

        .btn-khusus:hover {
            background: linear-gradient(135deg, #a89660 0%, #c2b378 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(186, 169, 113, .4);
            color: white
        }

        .btn-submit {
            font-size: 1.1rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px
        }

        .obat-item {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            position: relative;
            transition: all .3s ease
        }

        .obat-item:hover {
            border-color: #0b5e91;
            box-shadow: 0 4px 15px rgba(11, 94, 145, .1)
        }

        .obat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: .5rem;
            border-bottom: 1px solid #dee2e6
        }

        .obat-number {
            background: linear-gradient(135deg, #0b5e91 0%, #1a6fa0 100%);
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: .9rem
        }

        .btn-hapus {
            background: #dc3545;
            border: none;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .3s ease
        }

        .btn-hapus:hover {
            background: #c82333;
            transform: scale(1.1)
        }

        .waktu-minum {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: .5rem;
            position: relative
        }

        .waktu-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: .75rem
        }

        .waktu-label {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: .25rem .75rem;
            border-radius: 15px;
            font-size: .8rem;
            font-weight: 600
        }

        .btn-hapus-waktu {
            background: #dc3545;
            border: none;
            color: white;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            transition: all .3s ease
        }

        .btn-hapus-waktu:hover {
            background: #c82333;
            transform: scale(1.1)
        }

        .btn-tambah-waktu {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            color: white;
            padding: .5rem 1rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all .3s ease;
            font-size: .9rem
        }

        .btn-tambah-waktu:hover {
            background: linear-gradient(135deg, #218838 0%, #1e7e34 100%);
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(40, 167, 69, .3)
        }

        .error-notification,
        .success-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .15);
            transform: translateX(100%);
            transition: transform .3s ease;
            border-left: 4px solid
        }

        .error-notification {
            border-left-color: #dc3545
        }

        .success-notification {
            border-left-color: #28a745
        }

        .error-notification.show,
        .success-notification.show {
            transform: translateX(0)
        }

        .notification-content {
            display: flex;
            align-items: flex-start;
            padding: 1rem
        }

        .notification-icon {
            margin-right: .75rem;
            font-size: 1.5rem
        }

        .error-notification .notification-icon {
            color: #dc3545
        }

        .success-notification .notification-icon {
            color: #28a745
        }

        .notification-text {
            flex-grow: 1
        }

        .notification-title {
            font-weight: 700;
            margin-bottom: .25rem;
            color: #2c3e50
        }

        .notification-message {
            color: #6c757d;
            font-size: .9rem;
            line-height: 1.4
        }

        .notification-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #6c757d;
            cursor: pointer;
            padding: 0;
            margin-left: .5rem;
            transition: color .3s ease
        }

        .notification-close:hover {
            color: #2c3e50
        }

        @media (max-width:768px) {
            .main-card {
                margin: 1rem
            }

            .header-custom {
                padding: 2rem 1rem !important
            }

            .section-icon {
                width: 40px;
                height: 40px;
                font-size: 1rem
            }

            .obat-item {
                padding: 1rem
            }

            .waktu-minum {
                padding: .75rem
            }

            .error-notification,
            .success-notification {
                max-width: calc(100% - 2rem);
                right: 1rem;
                left: 1rem
            }
        }
    </style>
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
    <section class="py-5" style="background:linear-gradient(135deg, #0b5e91 0%, #1a7bb8 100%);">
        <div class="container px-4">
            <div class="card main-card border-0 shadow-lg">
                <div class="card-header text-white text-center border-0 py-5 position-relative header-custom">
                    <h1 class="display-5 fw-bold mb-2 mt-3">Pengingat Minum Obat</h1>
                    <p class="mb-0" style="font-family:'Open Sans', sans-serif;font-size:22px;color:#fff;">Isi formulir di
                        bawah ini untuk membuat pengingat minum obat</p>
                    <div class="header-shapes">
                        <div class="shape shape-1"></div>
                        <div class="shape shape-2"></div>
                        <div class="shape shape-3"></div>
                    </div>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <form id="formPengingat" method="POST" action="{{ route('pengingat.store') }}"
                                class="needs-validation" novalidate>
                                @csrf
                                <div class="row g-4">
                                    <div class="col-12 mt-4">
                                        <div class="section-header">
                                            <div class="d-flex align-items-center">
                                                <div class="section-icon me-3"><i class="bi bi-heart-pulse"></i></div>
                                                <div>
                                                    <h3 class="fw-bold mb-1">Data Medis</h3>
                                                    <p class="text-muted mb-0">Informasi diagnosa dan kondisi medis</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3"><select class="form-select shadow-sm" id="diagnosa"
                                                name="diagnosa" required>
                                                <option value="" selected>Pilih</option>
                                                <option value="Hipertensi-Non-Kehamilan">Hipertensi Non-Kehamilan</option>
                                                <option value="Hipertensi-Kehamilan">Hipertensi Kehamilan</option>
                                            </select><label for="diagnosa"><i
                                                    class="bi bi-clipboard2-pulse me-1"></i>Diagnosa Penyakit</label>
                                            <div class="invalid-feedback">Pilih diagnosa penyakit</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3"><input class="form-control shadow-sm"
                                                id="tekananDarah" name="tekananDarah" type="text"
                                                placeholder="Contoh: 120/80 mmHg" required /><label for="tekananDarah"><i
                                                    class="bi bi-activity me-1"></i>Tekanan Darah</label>
                                            <div class="invalid-feedback">Masukkan tekanan darah</div>
                                        </div>
                                        <div class="form-text text-muted">Contoh: 120/80 mmHg</div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <div class="section-header">
                                            <div class="d-flex align-items-center">
                                                <div class="section-icon me-3"><i class="bi bi-capsule"></i></div>
                                                <div>
                                                    <h3 class="fw-bold mb-1">Daftar Obat</h3>
                                                    <p class="text-muted mb-0">Tambahkan obat yang perlu diminum</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div id="obatContainer" class="mb-4"></div>
                                        <div class="d-grid gap-2 col-md-6 mx-auto mb-4"><button type="button"
                                                class="btn btn-khusus btn-lg" id="tambahObat"><i
                                                    class="bi bi-plus-circle me-2"></i> Tambah Obat
                                            </button></div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <div class="section-header">
                                            <div class="d-flex align-items-center">
                                                <div class="section-icon me-3"><i class="bi bi-bell"></i></div>
                                                <div>
                                                    <h3 class="fw-bold mb-1">Pengaturan Pengingat</h3>
                                                    <p class="text-muted mb-0">Atur waktu dan tanggal pengingat</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3"><input class="form-control shadow-sm"
                                                id="tanggal_mulai" name="tanggal_mulai" type="date" required /><label
                                                for="tanggal_mulai"><i class="bi bi-calendar-event me-1"></i>Tanggal Mulai
                                                Pengingat</label>
                                            <div class="invalid-feedback">Tanggal mulai harus diisi</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control shadow-sm" id="catatan" name="catatan" placeholder="Catatan tambahan (opsional)"
                                                style="height:100px"></textarea><label for="catatan"><i
                                                    class="bi bi-chat-left-text me-1"></i>Catatan (Opsional)</label>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-5">
                                        @guest
                                            <button type="button" id="submitButton"
                                                class="btn btn-khusus btn-lg btn-submit w-100 py-3"><i
                                                    class="bi bi-box-arrow-in-right me-2"></i> Submit Pengingat
                                            </button>
                                        @endguest
                                        @auth
                                            <button type="submit" class="btn btn-primary btn-lg btn-submit w-100 py-3"><i
                                                    class="bi bi-check-circle me-2"></i> Submit Pengingat
                                            </button>
                                        @endauth
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
    <div class="popup-overlay" id="popupOverlay" style="display:none;">
        <div class="popup-content position-relative"><button id="closePopup" class="popup-close">&times;</button>
            <div class="text-center mb-4"><i class="bi bi-shield-lock text-primary" style="font-size:3rem;"></i>
                <h2 class="mt-3 fw-bold">Login Diperlukan</h2>
                <p class="text-muted">Anda harus login terlebih dahulu untuk mengirimkan data.</p>
            </div>
            <div class="popup-buttons d-grid gap-2"><a href="{{ route('login') }}" class="btn btn-primary btn-lg"><i
                        class="bi bi-box-arrow-in-right me-2"></i> Login
                </a><a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg"><i
                        class="bi bi-person-plus me-2"></i> Register
                </a></div>
        </div>
    </div>
@endsection
