@extends('layouts.app')
@section('title', 'Pengingat Minum Obat - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Buat pengingat minum obat untuk hipertensi. Atur jadwal obat harian dengan mudah dan dapatkan notifikasi tepat waktu.">
    <meta name="keywords" content="pengingat obat, jadwal minum obat, hipertensi, manajemen obat, alarm obat">
    <meta name="author" content="Tim Farmasi Universitas Alma Ata">
@endpush

@section('content')
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <section class="py-4">
        <div class="container px-4">
            <!-- Header Section -->
            <div class="text-center mb-4">
                <h2 class="fw-bold mb-2 text-primary">Buat Pengingat Minum Obat</h2>
            </div>

            <div class="card border-0 shadow-lg pengingat-main-card">
                <div class="card-body p-4">
                    <form id="formPengingat" method="POST" action="{{ route('pengingat.store') }}" class="needs-validation"
                        novalidate>
                        @csrf

                        <!-- Main Layout -->
                        <div class="row g-4">
                            <!-- Left Column: Tekanan Darah & Tanggal -->
                            <div class="col-lg-4">
                                <!-- Tekanan Darah Card -->
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-header bg-primary text-white py-2">
                                        <h6 class="mb-0 fw-bold">TEKANAN DARAH</h6>
                                    </div>
                                    <div class="card-body p-3">
                                        <p class="text-muted small mb-3">Masukkan tekanan darah terakhir</p>
                                        <div class="row g-2 mb-3">
                                            <div class="col-6">
                                                <label class="form-label small mb-1">Sistol</label>
                                                <input type="number" class="form-control form-control-sm" id="sistolInput"
                                                    name="sistol" placeholder="140" min="50" max="250" required
                                                    value="{{ old('sistol') }}">
                                                @error('sistol')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small mb-1">Diastol</label>
                                                <input type="number" class="form-control form-control-sm" id="diastolInput"
                                                    name="diastol" placeholder="90" min="50" max="150" required
                                                    value="{{ old('diastol') }}">
                                                @error('diastol')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Tanggal Mulai -->
                                        <div class="mt-4">
                                            <div class="card bg-light border-0">
                                                <div class="card-header bg-secondary text-white py-2">
                                                    <h6 class="mb-0 fw-bold">MULAI PENGINGAT</h6>
                                                </div>
                                                <div class="card-body p-3">
                                                    <input class="form-control form-control-sm" id="tanggal_mulai"
                                                        name="tanggal_mulai" type="date" min="{{ date('Y-m-d') }}"
                                                        max="{{ date('Y-m-d', strtotime('+1 year')) }}"
                                                        value="{{ old('tanggal_mulai', date('Y-m-d', strtotime('+1 day'))) }}"
                                                        required />
                                                    @error('tanggal_mulai')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column: Obat -->
                            <div class="col-lg-8">
                                <div class="card bg-light border-0 h-100">
                                    <div
                                        class="card-header bg-primary text-white py-2 d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 fw-bold">OBAT ANDA</h6>
                                        <span class="badge bg-light text-dark" id="obatCounter">0/5 obat</span>
                                    </div>
                                    <div class="card-body p-3">
                                        <div id="obatContainer">
                                            <!-- Obat items will be added here -->
                                        </div>
                                        <button type="button" class="btn btn-outline-primary btn-sm w-100 mt-2"
                                            id="tambahObat">
                                            Tambah Obat Pertama
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Section -->
                        <div class="text-center mt-4">
                            @guest
                                <p class="text-muted text-center mb-3">Masuk ke akun untuk menyimpan pengingat</p>
                                <button type="button" class="btn btn-primary btn-lg px-5" data-bs-toggle="modal"
                                    data-bs-target="#loginModal">
                                    Masuk ke Akun
                                </button>
                            @endguest
                            @auth
                                @if (auth()->user()->role === 'pasien')
                                    <button type="submit" class="btn btn-success btn-lg px-5">
                                        AKTIFKAN PENGINGAT
                                    </button>
                                @else
                                    <div class="alert alert-info">
                                        Fitur ini hanya untuk pasien. Anda login sebagai
                                        {{ auth()->user()->role === 'admin' ? 'Admin' : 'Super Admin' }}.
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <h4 class="fw-bold mb-3">Login Diperlukan</h4>
                    <p class="text-muted text-center mb-4">Masuk untuk menyimpan pengingat obat Anda</p>
                    <div class="d-grid gap-3">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Masuk ke Akun</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">Daftar Gratis</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Variables
            let totalObat = 0;
            const maxObat = 5;
            const minObat = 1;

            const obatContainer = document.getElementById('obatContainer');
            const tambahObat = document.getElementById('tambahObat');
            const formPengingat = document.getElementById('formPengingat');
            const sistolInput = document.getElementById('sistolInput');
            const diastolInput = document.getElementById('diastolInput');
            const tekananDarahHidden = document.getElementById('tekananDarah');
            const obatCounter = document.getElementById('obatCounter');

            // Daftar obat
            const daftarObat = [
                "Verapamil tab 80 mg",
                "Verapamil tab lepas lambat 240 mg",
                "Valsartan tab 80 mg",
                "Valsartan tab 160 mg",
                "Telmisartan tab 40 mg",
                "Telmisartan tab 80 mg",
                "Ramipril tab 2,5 mg",
                "Ramipril tab 5 mg",
                "Amlodipin tab 5 mg",
                "Amlodipin tab 10 mg",
                "Atenolol tab 50 mg",
                "Atenolol tab 100 mg",
                "Bisoprolol tab 2,5 mg",
                "Bisoprolol tab 5 mg",
                "Bisoprolol tab 10 mg",
                "Diltiazem kapsul lepas lambat 100 mg",
                "Diltiazem kapsul lepas lambat 200 mg",
                "Hidroklorotiazid tab 25 mg",
                "Imidapril tab 5 mg",
                "Imidapril tab 10 mg",
                "Irbesartan tab 150 mg",
                "Irbesartan tab 300 mg",
                "Kandesartan tab 8 mg",
                "Kandesartan tab 16 mg",
                "Kaptopril tab 12,5 mg",
                "Kaptopril tab 25 mg",
                "Kaptopril tab 50 mg",
                "Klonidin tab 0,15 mg",
                "Lisinopril tab 5 mg",
                "Lisinopril tab 10 mg",
                "Metildopa tab 250 mg",
                "Nifedipin tab 10 mg",
                "Furosemid tab 20 mg",
                "Furosemid tab 40 mg",
            ];

            // Update counter
            function updateObatCounter() {
                obatCounter.textContent = `${totalObat}/${maxObat} obat`;
            }

            // Update blood pressure hidden field
            function updateTekananDarah() {
                if (sistolInput.value && diastolInput.value) {
                    tekananDarahHidden.value = sistolInput.value + '/' + diastolInput.value;
                }
            }

            // Add event listeners for blood pressure inputs
            sistolInput.addEventListener('input', updateTekananDarah);
            diastolInput.addEventListener('input', updateTekananDarah);

            // Add obat function
            function addObat() {
                if (totalObat >= maxObat) return;

                totalObat++;
                const obatId = totalObat;

                const obatDiv = document.createElement('div');
                obatDiv.className = 'obat-item border rounded p-3 mb-3 bg-white';

                obatDiv.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="fw-bold text-primary">Obat #${obatId}</span>
                <button type="button" class="btn btn-outline-danger btn-sm remove-obat">Hapus</button>
            </div>
            <div class="row g-2">
                <div class="col-12">
                    <select class="form-select form-select-sm" name="namaObat[]" required>
                        <option value="">-- Pilih Obat --</option>
                        ${daftarObat.map(obat => `<option value="${obat}">${obat}</option>`).join('')}
                    </select>
                </div>
                <div class="col-4">
                    <select class="form-select form-select-sm" name="waktuMinum[]" required>
                        <option value="">Jam</option>
                        <option value="06:00">06:00</option>
                        <option value="07:00">07:00</option>
                        <option value="08:00">08:00</option>
                        <option value="09:00">09:00</option>
                        <option value="12:00">12:00</option>
                        <option value="13:00">13:00</option>
                        <option value="15:00">15:00</option>
                        <option value="18:00">18:00</option>
                        <option value="19:00">19:00</option>
                        <option value="20:00">20:00</option>
                        <option value="21:00">21:00</option>
                    </select>
                </div>
                <div class="col-4">
                    <select class="form-select form-select-sm" name="jumlahObat[]" required>
                        <option value="">Jumlah</option>
                        <option value="30 tablet/bulan">30 tablet</option>
                        <option value="60 tablet/bulan">60 tablet</option>
                        <option value="90 tablet/bulan">90 tablet</option>
                    </select>
                </div>
                <div class="col-4">
                    <select class="form-select form-select-sm" name="suplemen[]">
                        <option value="">Suplemen</option>
                        <option value="Asam folat">Asam Folat</option>
                        <option value="Zat besi">Zat Besi</option>
                        <option value="Kalsium">Kalsium</option>
                        <option value="Suplemen Multivitamin">Multivitamin</option>
                    </select>
                </div>
            </div>
        `;

                obatContainer.appendChild(obatDiv);
                updateObatCounter();
                updateTambahObatButton();
            }

            // Remove obat function using event delegation
            function removeObatItem(obatElement) {
                if (obatElement) {
                    obatElement.remove();
                    totalObat--;
                    updateObatNumbers();
                    updateObatCounter();
                    updateTambahObatButton();
                }
            }

            // Update obat numbers after removal
            function updateObatNumbers() {
                const obatItems = document.querySelectorAll('.obat-item');
                obatItems.forEach((item, index) => {
                    const numberSpan = item.querySelector('span');
                    numberSpan.textContent = `Obat #${index + 1}`;
                });
            }

            // Update tambah obat button
            function updateTambahObatButton() {
                if (totalObat === 0) {
                    tambahObat.textContent = 'Tambah Obat Pertama';
                    tambahObat.disabled = false;
                } else if (totalObat < maxObat) {
                    tambahObat.textContent = `Tambah Obat Ke-${totalObat + 1}`;
                    tambahObat.disabled = false;
                } else {
                    tambahObat.textContent = 'Maksimal 5 Obat';
                    tambahObat.disabled = true;
                }
            }

            // Tambah obat event listener
            tambahObat.addEventListener('click', addObat);

            // Event delegation for remove buttons
            obatContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-obat')) {
                    const obatItem = e.target.closest('.obat-item');
                    removeObatItem(obatItem);
                }
            });

            // Form validation and submission
            if (formPengingat) {
                formPengingat.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Update hidden field
                    updateTekananDarah();

                    // Basic validation
                    const sistol = parseInt(sistolInput.value);
                    const diastol = parseInt(diastolInput.value);

                    let errorMessage = '';

                    // Check blood pressure
                    if (!sistol || !diastol) {
                        errorMessage = 'Mohon isi tekanan darah dengan lengkap.';
                    } else if (sistol < 50 || sistol > 250 || diastol < 50 || diastol > 150) {
                        errorMessage = 'Nilai tekanan darah tidak valid. Sistol: 50-250, Diastol: 50-150.';
                    } else if (totalObat === 0) {
                        errorMessage = 'Silakan tambahkan minimal satu obat.';
                    } else {
                        // Check obat validation
                        const obatItems = document.querySelectorAll('.obat-item');
                        let isValid = true;

                        obatItems.forEach((item, index) => {
                            const namaObat = item.querySelector('select[name="namaObat[]"]').value;
                            const waktuMinum = item.querySelector('select[name="waktuMinum[]"]')
                                .value;
                            const jumlahObat = item.querySelector('select[name="jumlahObat[]"]')
                                .value;

                            if (!namaObat || !waktuMinum || !jumlahObat) {
                                errorMessage =
                                    `Mohon lengkapi data obat #${index + 1} (nama obat, jam, dan jumlah wajib diisi).`;
                                isValid = false;
                                return false;
                            }
                        });

                        if (isValid) {
                            // All validation passed - submit form
                            const submitBtn = this.querySelector('button[type="submit"]');
                            if (submitBtn) {
                                submitBtn.innerHTML =
                                    '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
                                submitBtn.disabled = true;
                            }

                            setTimeout(() => {
                                this.submit();
                            }, 500);
                            return;
                        }
                    }

                    // Show error message
                    if (errorMessage) {
                        alert(errorMessage);
                    }
                });
            }

            // Initialize
            updateObatCounter();
            updateTambahObatButton();
        });
    </script>

    <style>
        /* Custom styles for compact layout */
        .card {
            border-radius: 8px;
        }

        .pengingat-main-card {
            max-width: 1000px;
            margin: 0 auto;
        }

        /* Force white text color for card headers */
        .card-header h6 {
            color: #ffffff !important;
        }

        .card-header .badge {
            color: #333333 !important;
        }

        .obat-item {
            transition: all 0.3s ease;
        }

        .obat-item:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .form-select-sm,
        .form-control-sm {
            font-size: 0.875rem;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .container {
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
            }

            .pengingat-main-card {
                margin: 0 0.25rem !important;
                max-width: none !important;
            }

            .card-body {
                padding: 0.75rem !important;
            }

            .obat-item {
                padding: 0.5rem !important;
            }

            .row.g-4 {
                gap: 1rem !important;
            }

            .text-center.mb-4 h2 {
                font-size: 1.5rem !important;
                margin-bottom: 1rem !important;
            }

            .btn-lg {
                padding: 0.75rem 2rem !important;
                font-size: 1rem !important;
            }

            section.py-4 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding-left: 0.25rem !important;
                padding-right: 0.25rem !important;
            }

            .pengingat-main-card {
                margin: 0 !important;
            }

            .card-body {
                padding: 0.5rem !important;
            }
        }

        /* Button animations */
        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
    </style>
@endpush
