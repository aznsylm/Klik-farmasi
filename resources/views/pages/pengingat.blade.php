@extends('layouts.app')

@section('title', 'Pengingat Minum Obat')

@section('content')
    {{-- Form Pengingat Minum Obat --}}
    <section class="py-5 dotted-bg">
        <div class="container px-4">
            <!-- Form Pengingat -->
            <div class="card border-0 rounded-4 shadow-lg">
                <div class="card-header text-white text-center border-0 rounded-top-4 py-5 position-relative header-custom">
                    <div class="header-icon">
                        <i class="bi bi-alarm"></i>
                    </div>
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
                                            <div class="feature bg-primary text-white rounded-circle me-3">
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
                                            <div class="feature bg-primary text-white rounded-circle me-3">
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
                                            <div class="feature bg-primary text-white rounded-circle me-3">
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
                                            <button type="button" class="btn btn-primary btn-lg" id="tambahObat">
                                                <i class="bi bi-plus-circle me-2"></i> Tambah Obat
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Button Submit -->
                                    <div class="col-12 mt-4">
                                        @guest
                                            <button type="button" id="submitButton" class="btn btn-primary btn-lg btn-submit w-100 py-3">
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

    <style>
        /* General Styling */
        body {
            background-color: #f8f9fa;
        }
        
        .feature {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Card Styling */
        .card {
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        /* Dotted Background */
        .dotted-bg {
            background-color: #f8f9fa;
            background-image: radial-gradient(#0d6efd20 1px, transparent 1px);
            background-size: 20px 20px;
            position: relative;
        }
        
        /* Custom Header Styling */
        .header-custom {
            background-color: #0B5E91;
            overflow: hidden;
        }
        
        .header-icon {
            width: 90px;
            height: 90px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            position: relative;
            z-index: 2;
            border: 5px solid rgba(255,255,255,0.3);
        }
        
        .header-icon i {
            font-size: 3rem;
            color: #0d6efd;
        }
        
        .header-shapes .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.2;
        }
        
        .header-shapes .shape-1 {
            width: 120px;
            height: 120px;
            background-color: white;
            top: -30px;
            right: -30px;
        }
        
        .header-shapes .shape-2 {
            width: 80px;
            height: 80px;
            background-color: white;
            bottom: -20px;
            left: 10%;
        }
        
        .header-shapes .shape-3 {
            width: 60px;
            height: 60px;
            background-color: white;
            top: 20px;
            left: -20px;
        }
        
        /* Form Controls */
        .form-control, .form-select {
            border: 1px solid #dee2e6;
            padding: 0.75rem 1rem;
            height: calc(3.5rem + 2px);
            font-size: 1rem;
            transition: all 0.2s ease-in-out;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        
        .form-floating > label {
            padding: 0.75rem 1rem;
        }
        
        /* Obat Card Styling */
        .obat-card {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            background-color: #fff;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            position: relative;
            transition: all 0.3s ease;
        }
        
        .obat-card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .obat-number {
            position: absolute;
            top: -10px;
            left: -10px;
            width: 30px;
            height: 30px;
            background-color: #0d6efd;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .remove-obat {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            color: #dc3545;
            font-size: 1.25rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .remove-obat:hover {
            transform: scale(1.2);
        }
        
        /* Button Styling */
        .btn-submit {
            border-radius: 50px;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(13, 110, 253, 0.25);
            transition: all 0.3s ease;
        }
        
        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(13, 110, 253, 0.3);
        }
        
        .btn-submit:active {
            transform: translateY(0);
        }
        
        /* Pop-up Styling */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            backdrop-filter: blur(5px);
        }
        
        .popup-content {
            background: #fff;
            border-radius: 1rem;
            padding: 2.5rem;
            width: 90%;
            max-width: 450px;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
            animation: fadeInUp 0.4s ease-out;
        }
        
        .popup-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #6c757d;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .popup-close:hover {
            color: #0d6efd;
            transform: rotate(90deg);
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .card-header {
                padding: 2rem 1rem;
            }
            
            .card-body {
                padding: 1.5rem;
            }
            
            .popup-content {
                padding: 1.5rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const diagnosa = document.getElementById('diagnosa');
            const tambahObat = document.getElementById('tambahObat');
            const obatContainer = document.getElementById('obatContainer');
            const form = document.getElementById('formPengingat');
            let totalObat = 0;
            let obatItems = [];

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

            // Atur jumlah maksimal obat berdasarkan diagnosa
            diagnosa.addEventListener('change', function () {
                totalObat = 0;
                obatItems = [];
                obatContainer.innerHTML = '';
                tambahObat.disabled = false;

                if (diagnosa.value === 'Non-Komplikasi') {
                    tambahObat.dataset.maxObat = 2;
                    tambahObat.dataset.minObat = 1; // Minimal 1 obat
                } else if (diagnosa.value === 'Komplikasi') {
                    tambahObat.dataset.maxObat = 5;
                    tambahObat.dataset.minObat = 2; // Minimal 2 obat
                }
                
                // Tampilkan pesan informasi
                const maxObat = parseInt(tambahObat.dataset.maxObat || 0);
                const minObat = parseInt(tambahObat.dataset.minObat || 0);
                
                if (maxObat > 0) {
                    const infoMsg = document.createElement('div');
                    infoMsg.className = 'alert alert-info d-flex align-items-center';
                    infoMsg.innerHTML = `
                        <i class="bi bi-info-circle-fill me-2"></i>
                        <div>
                            Untuk diagnosa ini, Anda perlu menambahkan minimal ${minObat} dan maksimal ${maxObat} obat.
                        </div>
                    `;
                    obatContainer.appendChild(infoMsg);
                }
            });

            // Tambah obat
            tambahObat.addEventListener('click', function () {
                const maxObat = parseInt(tambahObat.dataset.maxObat || 0);
            
                if (totalObat < maxObat) {
                    totalObat++;
                    
                    const obatDiv = document.createElement('div');
                    obatDiv.classList.add('obat-card');
                    obatDiv.dataset.obatId = totalObat;
                    
                    obatDiv.innerHTML = `
                        <div class="obat-number">${totalObat}</div>
                        <button type="button" class="remove-obat" data-obat-id="${totalObat}">
                            <i class="bi bi-x-circle-fill"></i>
                        </button>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="namaObat${totalObat}" class="form-label fw-bold">
                                    <i class="bi bi-capsule me-2"></i>Pilih Obat
                                </label>
                                <select class="form-select shadow-sm" id="namaObat${totalObat}" name="namaObat[]" required>
                                    <option value="">Pilih Obat</option>
                                    ${daftarObat.map(obat => `<option value="${obat}">${obat}</option>`).join('')}
                                </select>
                                <div class="invalid-feedback">Pilih obat</div>
                            </div>
                            <div class="col-md-6">
                                <label for="jumlahObat${totalObat}" class="form-label fw-bold">
                                    <i class="bi bi-123 me-2"></i>Jumlah Obat
                                </label>
                                <select class="form-select shadow-sm" id="jumlahObat${totalObat}" name="jumlahObat[]" required>
                                    <option value="30 tablet/bulan">30 tablet/bulan</option>
                                    <option value="60 tablet/bulan">60 tablet/bulan</option>
                                    <option value="90 tablet/bulan">90 tablet/bulan</option>
                                </select>
                                <div class="invalid-feedback">Pilih jumlah obat</div>
                            </div>
                            <div class="col-md-6">
                                <label for="waktuMinum${totalObat}" class="form-label fw-bold">
                                    <i class="bi bi-clock me-2"></i>Waktu Minum Obat
                                </label>
                                <select class="form-select shadow-sm" id="waktuMinum${totalObat}" name="waktuMinum[]" required>
                                    <option value="">Pilih Waktu</option>
                                    <option value="06:00">06.00</option>
                                    <option value="07:00">07.00</option>
                                    <option value="09:00">09.00</option>
                                    <option value="12:00">12.00</option>
                                    <option value="13:00">13.00</option>
                                    <option value="15:00">15.00</option>
                                    <option value="18:00">18.00</option>
                                    <option value="19:00">19.00</option>
                                    <option value="21:00">21.00</option>
                                </select>
                                <div class="invalid-feedback">Pilih waktu minum obat</div>
                            </div>
                        </div>
                    `;
                    
                    // Tambahkan ke container
                    obatContainer.appendChild(obatDiv);
                    obatItems.push(totalObat);
                    
                    // Tambahkan event listener untuk tombol hapus
                    const removeButton = obatDiv.querySelector('.remove-obat');
                    removeButton.addEventListener('click', function() {
                        const obatId = this.dataset.obatId;
                        removeObat(obatId);
                    });
                }
            
                if (totalObat === maxObat) {
                    tambahObat.disabled = true;
                }
            });
            
            // Fungsi untuk menghapus obat
            function removeObat(obatId) {
                const obatElement = document.querySelector(`.obat-card[data-obat-id="${obatId}"]`);
                if (obatElement) {
                    obatElement.remove();
                    
                    // Update array obatItems
                    const index = obatItems.indexOf(parseInt(obatId));
                    if (index > -1) {
                        obatItems.splice(index, 1);
                    }
                    
                    totalObat--;
                    tambahObat.disabled = false;
                    
                    // Perbarui nomor urut obat yang tersisa
                    updateObatNumbers();
                }
            }
            
            // Fungsi untuk memperbarui nomor urut obat
            function updateObatNumbers() {
                const obatCards = document.querySelectorAll('.obat-card');
                obatCards.forEach((card, index) => {
                    const numberElement = card.querySelector('.obat-number');
                    if (numberElement) {
                        numberElement.textContent = index + 1;
                    }
                });
            }

            // Validasi sebelum submit
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                
                if (!form.checkValidity()) {
                    e.stopPropagation();
                    form.classList.add('was-validated');
                    return;
                }

                const minObat = parseInt(tambahObat.dataset.minObat || 0);

                if (totalObat < minObat) {
                    // Tampilkan pesan error
                    const errorMsg = document.createElement('div');
                    errorMsg.className = 'alert alert-danger alert-dismissible fade show mt-3';
                    errorMsg.innerHTML = `
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Silakan tambahkan minimal ${minObat} obat.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    `;
                    
                    // Cek apakah sudah ada pesan error
                    const existingError = form.querySelector('.alert-danger');
                    if (existingError) {
                        existingError.remove();
                    }
                    
                    form.prepend(errorMsg);
                    
                    // Scroll ke atas form
                    form.scrollIntoView({ behavior: 'smooth' });
                } else {
                    // Tampilkan loading state pada tombol submit
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Memproses...';
                        submitBtn.disabled = true;
                        
                        // Simulasi submit (bisa dihapus pada implementasi sebenarnya)
                        setTimeout(() => {
                            form.submit();
                        }, 500);
                    } else {
                        form.submit();
                    }
                }
            });

            // Popup untuk guest user
            document.getElementById('submitButton')?.addEventListener('click', function () {
                document.getElementById('popupOverlay').style.display = 'flex';
                document.body.style.overflow = 'hidden'; // Prevent scrolling when popup is open
            });

            document.getElementById('closePopup')?.addEventListener('click', function () {
                document.getElementById('popupOverlay').style.display = 'none';
                document.body.style.overflow = ''; // Restore scrolling
            });
            
            // Form validation styling
            const inputs = document.querySelectorAll('.form-control, .form-select');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.checkValidity()) {
                        this.classList.add('is-valid');
                        this.classList.remove('is-invalid');
                    } else if (this.value !== '') {
                        this.classList.add('is-invalid');
                        this.classList.remove('is-valid');
                    }
                });
            });
        });
    </script>
@endsection