@extends('layouts.medicio')

@section('title', 'Pengingat Minum Obat - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Buat pengingat minum obat untuk hipertensi. Atur jadwal obat harian dengan mudah dan dapatkan notifikasi tepat waktu.">
    <meta name="keywords" content="pengingat obat, jadwal minum obat, hipertensi, manajemen obat, alarm obat">
    <meta name="author" content="Tim Farmasi Universitas Alma Ata">

    <!-- Custom CSS for Pengingat -->
    <style>
        /* Medicine Item Styling */
        .medicine-item {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .medicine-item:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .medicine-header {
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .medicine-title {
            color: var(--accent-color);
            font-weight: 600;
            margin-bottom: 0;
        }

        /* Remove Button Styling */
        .remove-medicine {
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }

        .remove-medicine:hover {
            background: #c82333;
        }

        /* Alert Styling */
        .alert {
            border-radius: 10px;
            border: none;
        }

        /* Form Control Styling */
        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(var(--accent-color-rgb), 0.25);
        }

        /* Modal Styling */
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .medicine-item {
                padding: 15px;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Alert Messages -->
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

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Pengingat Minum Obat</h1>
                        <p class="mb-0">Atur jadwal minum obat hipertensi dengan mudah dan dapatkan notifikasi otomatis
                            via WhatsApp</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="current">Pengingat Obat</li>
                </ol>
            </div>
        </nav>
    </div>
    <!-- End Page Title -->

    <!-- Main Form Section -->
    <section id="appointment" class="appointment section light-background">

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <form id="formPengingat" method="POST" action="{{ route('pengingat.store') }}" role="form"
                class="php-email-form">
                @csrf

                <!-- Hidden field for tekanan darah -->
                <input type="hidden" id="tekananDarah" name="tekanan_darah" value="">

                <!-- First Row: Blood Pressure -->
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input type="number" class="form-control" id="sistolInput" name="sistol"
                            placeholder="Sistol (mmHg)" min="50" max="250" required value="{{ old('sistol') }}">
                        @error('sistol')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group mt-3 mt-md-0">
                        <input type="number" class="form-control" id="diastolInput" name="diastol"
                            placeholder="Diastol (mmHg)" min="50" max="150" required
                            value="{{ old('diastol') }}">
                        @error('diastol')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Second Row: Start Date -->
                <div class="row">
                    <div class="col-md-12 form-group mt-3">
                        <input class="form-control" id="tanggal_mulai" name="tanggal_mulai" type="date"
                            min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+1 year')) }}"
                            value="{{ old('tanggal_mulai', date('Y-m-d', strtotime('+1 day'))) }}" required />
                        @error('tanggal_mulai')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Medicine Container -->
                <div id="obatContainer" class="mt-4">
                    <!-- Obat items will be added here -->
                </div>

                <!-- Add Medicine Button -->
                <div class="form-group mt-3">
                    <button type="button" class="btn btn-primary w-100" id="tambahObat">
                        <i class="bi bi-plus-circle me-2"></i>
                        @auth
                            {{ auth()->user()->puskesmas === 'godean_2' ? 'Tambah Suplemen Pertama' : 'Tambah Obat Pertama' }}
                        @else
                            Tambah Obat Pertama
                        @endauth
                    </button>
                </div>

                <!-- Submit Section -->
                <div class="text-center mt-4">
                    @guest
                        <div class="alert alert-info mb-3">
                            <i class="bi bi-info-circle me-2"></i>
                            Masuk ke akun untuk menyimpan pengingat obat Anda
                        </div>
                        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
                            data-bs-target="#loginModal">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Masuk ke Akun
                        </button>
                    @endguest
                    @auth
                        @if (auth()->user()->role === 'pasien')
                            <button type="submit" class="btn btn-success btn-lg px-5">
                                <i class="bi bi-bell me-2"></i>
                                AKTIFKAN PENGINGAT
                            </button>
                        @else
                            <div class="alert alert-warning mb-0">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                Fitur ini hanya untuk pasien. Anda login sebagai
                                {{ auth()->user()->role === 'admin' ? 'Admin' : 'Super Admin' }}.
                            </div>
                        @endif
                    @endauth
                </div>
                <!-- Counter Display -->
                <div class="text-center mt-2">
                    <small class="text-muted">
                        <span id="obatCounter">
                            @auth
                                {{ auth()->user()->puskesmas === 'godean_2' ? '0/5 suplemen' : '0/5 obat' }}
                            @else
                                0/5 obat
                            @endauth
                        </span>
                    </small>
                </div>
            </form>
        </div>
    </section>

    <!-- How it Works Section -->
    <section class="py-5 light-background">
        <div class="container">
            <div class="section-title text-center mb-5" data-aos="fade-up">
                <h2>Cara Kerja Pengingat</h2>
                <p>Ikuti langkah mudah untuk mengatur pengingat obat Anda</p>
            </div>

            <div class="row gy-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 80px; height: 80px;">
                            <i class="bi bi-person-plus" style="font-size: 2rem;"></i>
                        </div>
                        <h5 class="fw-bold">1. Daftar/Masuk</h5>
                        <p class="text-muted">Buat akun atau masuk untuk menyimpan pengingat</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-center">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 80px; height: 80px;">
                            <i class="bi bi-capsule" style="font-size: 2rem;"></i>
                        </div>
                        <h5 class="fw-bold">2. Atur Obat</h5>
                        <p class="text-muted">Masukkan jenis obat dan jadwal minum</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-center">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 80px; height: 80px;">
                            <i class="bi bi-whatsapp" style="font-size: 2rem;"></i>
                        </div>
                        <h5 class="fw-bold">3. Terima Notifikasi</h5>
                        <p class="text-muted">Dapatkan pengingat via WhatsApp sesuai jadwal</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-center">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 80px; height: 80px;">
                            <i class="bi bi-heart-pulse" style="font-size: 2rem;"></i>
                        </div>
                        <h5 class="fw-bold">4. Kontrol Tekanan</h5>
                        <p class="text-muted">Pantau tekanan darah dengan teratur</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-5">
                    <div class="mb-4">
                        <i class="bi bi-box-arrow-in-right text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Login Diperlukan</h4>
                    <p class="text-muted mb-4">Masuk untuk menyimpan dan mengelola pengingat obat Anda dengan aman</p>
                    <div class="d-grid gap-3">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Masuk ke Akun
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-person-plus me-2"></i>
                            Daftar Gratis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 800,
                once: true
            });

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

            // Check user's puskesmas for conditional logic
            @auth
            const isGodean2 = {{ auth()->user()->puskesmas === 'godean_2' ? 'true' : 'false' }};
        @else
            const isGodean2 = false;
        @endauth

        // Set required attributes based on puskesmas
        const suplemenRequired = isGodean2 ? 'required' : '';

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
            const itemType = isGodean2 ? 'suplemen' : 'obat';
            obatCounter.textContent = `${totalObat}/${maxObat} ${itemType}`;
        }

        // Update blood pressure hidden field
        function updateTekananDarah() {
            if (sistolInput.value && diastolInput.value) {
                tekananDarahHidden.value = sistolInput.value + '/' + diastolInput.value;
            }
        }

        // Add event listeners for blood pressure inputs
        sistolInput.addEventListener('input', updateTekananDarah); diastolInput.addEventListener('input',
            updateTekananDarah);

        // Add obat function
        function addObat() {
            if (totalObat >= maxObat) return;

            totalObat++;
            const obatId = totalObat;

            const obatDiv = document.createElement('div');
            obatDiv.className = 'medicine-item border rounded p-3 mb-3';

            const itemType = isGodean2 ? 'Suplemen' : 'Obat';
            const obatRequired = isGodean2 ? '' : 'required';
            const suplemenRequired = isGodean2 ? 'required' : '';

            obatDiv.innerHTML = `
                    <div class="medicine-header d-flex justify-content-between align-items-center mb-2">
                        <h6 class="medicine-title">
                            <i class="bi bi-capsule me-1"></i>
                            ${itemType} #${obatId}
                        </h6>
                        <button type="button" class="btn btn-outline-danger btn-sm remove-medicine">
                            <i class="bi bi-trash me-1"></i>Hapus
                        </button>
                    </div>
                    
                    <!-- Medicine Selection Row -->
                    <div class="row g-2">
                        <div class="col-md-12 form-group">
                            <select class="form-select" name="namaObat[]" ${obatRequired}>
                                <option value="">-- ${isGodean2 ? 'Pilih Obat (Opsional)' : 'Pilih Obat'} --</option>
                                ${daftarObat.map(obat => `<option value="${obat}">${obat}</option>`).join('')}
                            </select>
                        </div>
                    </div>
                    
                    <!-- Medicine Details Row -->
                    <div class="row g-2 mt-2">
                        <div class="col-md-4 form-group">
                            <select class="form-select" name="waktuMinum[]" required>
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
                        <div class="col-md-4 form-group">
                            <select class="form-select" name="jumlahObat[]" required>
                                <option value="">Jumlah</option>
                                <option value="30 tablet/bulan">30 tablet</option>
                                <option value="60 tablet/bulan">60 tablet</option>
                                <option value="90 tablet/bulan">90 tablet</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <select class="form-select" name="suplemen[]" ${suplemenRequired}>
                                <option value="">${isGodean2 ? 'Pilih Suplemen' : 'Suplemen (Opsional)'}</option>
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
            const obatItems = document.querySelectorAll('.medicine-item');
            const itemType = isGodean2 ? 'Suplemen' : 'Obat';
            obatItems.forEach((item, index) => {
                const header = item.querySelector('.medicine-title');
                header.innerHTML = `<i class="bi bi-capsule me-1"></i>${itemType} #${index + 1}`;
            });
        }

        // Update tambah obat button
        function updateTambahObatButton() {
            const itemType = isGodean2 ? 'Suplemen' : 'Obat';

            if (totalObat === 0) {
                tambahObat.innerHTML = `<i class="bi bi-plus-circle me-2"></i>Tambah ${itemType} Pertama`;
                tambahObat.disabled = false;
            } else if (totalObat < maxObat) {
                tambahObat.innerHTML =
                    `<i class="bi bi-plus-circle me-2"></i>Tambah ${itemType} Ke-${totalObat + 1}`;
                tambahObat.disabled = false;
            } else {
                tambahObat.innerHTML = `Maksimal ${maxObat} ${itemType}`;
                tambahObat.disabled = true;
            }
        }

        // Add obat button event listener
        tambahObat.addEventListener('click', addObat);

        // Event delegation for remove buttons
        obatContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-medicine') || e.target.closest('.remove-medicine')) {
                const obatItem = e.target.closest('.medicine-item');
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
                    const itemType = isGodean2 ? 'suplemen' : 'obat';
                    errorMessage = `Silakan tambahkan minimal satu ${itemType}.`;
                } else {
                    // Check obat validation
                    const obatItems = document.querySelectorAll('.medicine-item');
                    let isValid = true;
                    const itemType = isGodean2 ? 'suplemen' : 'obat';

                    obatItems.forEach((item, index) => {
                        const namaObat = item.querySelector('select[name="namaObat[]"]').value;
                        const waktuMinum = item.querySelector('select[name="waktuMinum[]"]').value;
                        const jumlahObat = item.querySelector('select[name="jumlahObat[]"]').value;
                        const suplemen = item.querySelector('select[name="suplemen[]"]').value;

                        // Conditional validation based on puskesmas
                        if (isGodean2) {
                            // For Godean 2: suplemen required, obat optional
                            if (!suplemen || !waktuMinum || !jumlahObat) {
                                errorMessage =
                                    `Mohon lengkapi data ${itemType} #${index + 1} (suplemen, jam, dan jumlah wajib diisi).`;
                                isValid = false;
                                return false;
                            }
                        } else {
                            // For others: obat required, suplemen optional  
                            if (!namaObat || !waktuMinum || !jumlahObat) {
                                errorMessage =
                                    `Mohon lengkapi data ${itemType} #${index + 1} (nama obat, jam, dan jumlah wajib diisi).`;
                                isValid = false;
                                return false;
                            }
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

                        this.submit();
                        return;
                    }
                }

                // Show error message
                if (errorMessage) {
                    // Create error alert div
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-danger alert-dismissible fade show mt-3';
                    alertDiv.innerHTML = `
                        ${errorMessage}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;

                    // Insert at top of form
                    const form = document.getElementById('formPengingat');
                    const existingAlert = form.querySelector('.alert');
                    if (existingAlert) existingAlert.remove();
                    form.insertBefore(alertDiv, form.firstChild);

                    // Scroll to top
                    alertDiv.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });
                }
            });
        }

        // Initialize
        updateObatCounter(); updateTambahObatButton();

        console.log('Halaman Pengingat Obat (Medicio) siap!');
        });
    </script>
@endpush
