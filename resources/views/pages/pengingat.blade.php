@extends('layouts.app')

@section('title', 'Pengingat Minum Obat')

@section('content')
    <section class="py-5">
        <div class="container px-5">
            <!-- Form Pengingat -->
            <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5 shadow">
                <div class="text-center mb-5">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3">
                        <i class="bi bi-alarm" style="font-size: 2rem;"></i>
                    </div>
                    <h1 class="fw-bold">Pengingat Minum Obat</h1>
                    <p class="lead fw-normal text-muted mb-0">Isi formulir di bawah ini untuk membuat pengingat minum obat</p>
                </div>
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6">
                        <form id="formPengingat" method="POST" action="">
                            @csrf
                            <!-- Nama Pasien -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="namaPasien" name="namaPasien" type="text" placeholder="Masukkan nama pasien" required />
                                <label for="namaPasien">Nama Pasien</label>
                            </div>
                            <!-- Jenis Kelamin -->
                            <div class="form-floating mb-3">
                                <select class="form-select" id="jenisKelamin" name="jenisKelamin" required>
                                    <option value="" selected>Pilih</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <label for="jenisKelamin">Jenis Kelamin</label>
                            </div>
                            <!-- Usia -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="usia" name="usia" type="number" placeholder="Masukkan usia" required />
                                <label for="usia">Usia</label>
                            </div>
                            <!-- Nomor WhatsApp -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="nomorWa" name="nomorWa" type="tel" placeholder="+62 812-3456-7890" pattern="^\+62\s?\d{3,4}-\d{3,4}-\d{3,4}$" required />
                                <label for="nomorWa">Nomor WhatsApp</label>
                            </div>
                            <!-- Diagnosa Penyakit -->
                            <div class="form-floating mb-3">
                                <select class="form-select" id="diagnosa" name="diagnosa" required>
                                    <option value="" selected>Pilih</option>
                                    <option value="Non-Komplikasi">Hipertensi Non-Komplikasi</option>
                                    <option value="Komplikasi">Hipertensi Komplikasi</option>
                                </select>
                                <label for="diagnosa">Diagnosa Penyakit</label>
                            </div>
                            <!-- Tekanan Darah -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="tekananDarah" name="tekananDarah" type="text" placeholder="Contoh: 120/80 mmHg" required />
                                <label for="tekananDarah">Tekanan Darah</label>
                            </div>
                            <!-- Daftar Obat -->
                            <div id="daftarObat" class="mb-3 mt-5">
                                <label class="form-label"><strong>Daftar Obat</strong></label>
                                <div id="obatContainer"></div>
                                <button type="button" class="btn btn-primary mt-2" id="tambahObat">
                                    <i class="bi bi-plus-circle"></i> Tambah Obat
                                </button>
                            </div>
                            <!-- Button Submit -->
                            @guest
                                <button type="button" id="submitButton" class="btn btn-primary btn-submit w-100">
                                    <i class="bi bi-box-arrow-in-right me-2"></i> Submit
                                </button>
                            @endguest

                            @auth
                                <button type="submit" class="btn btn-primary btn-submit w-100">
                                    <i class="bi bi-check-circle me-2"></i> Submit
                                </button>
                            @endauth
                        </form>
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
            <h2>Login Diperlukan</h2>
            <p>Anda harus login terlebih dahulu untuk mengirimkan data.</p>
            <div class="popup-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-success">Register</a>
            </div>
        </div>
    </div>

    <style>
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
        }

        .popup-content {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.3s ease-in-out;
        }

        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            cursor: pointer;
        }

        .popup-buttons .btn {
            margin: 5px;
        }

        /* Form Styling */
        .form-floating .form-control {
            border-radius: 8px;
        }

        .btn-submit {
            padding: 15px 0;
            font-size: 1.1rem;
            font-weight: bold;
            border: none;
            border-radius: 50px;
            background-color: #007bff;
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-submit:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-submit:active {
            transform: translateY(0);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const diagnosa = document.getElementById('diagnosa');
            const tambahObat = document.getElementById('tambahObat');
            const obatContainer = document.getElementById('obatContainer');
            const form = document.getElementById('formPengingat');
            let totalObat = 0;

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
                obatContainer.innerHTML = '';
                tambahObat.disabled = false;

                if (diagnosa.value === 'Non-Komplikasi') {
                    tambahObat.dataset.maxObat = 2;
                    tambahObat.dataset.minObat = 1; // Minimal 1 obat
                } else if (diagnosa.value === 'Komplikasi') {
                    tambahObat.dataset.maxObat = 5;
                    tambahObat.dataset.minObat = 2; // Minimal 2 obat
                }
            });

            // Tambah obat
            tambahObat.addEventListener('click', function () {
                const maxObat = parseInt(tambahObat.dataset.maxObat || 0);
            
                if (totalObat < maxObat) {
                    totalObat++;
            
                    const obatDiv = document.createElement('div');
                    obatDiv.classList.add('mb-3');
                    obatDiv.innerHTML = `
                        <div class="mb-2">
                            <label for="namaObat${totalObat}" class="form-label">Obat ke-${totalObat}</label>
                            <select class="form-select" id="namaObat${totalObat}" name="namaObat[]" required>
                                <option value="">Pilih Obat</option>
                                ${daftarObat.map(obat => `<option value="${obat}">${obat}</option>`).join('')}
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="jumlahObat${totalObat}" class="form-label">Jumlah Obat</label>
                            <select class="form-select" id="jumlahObat${totalObat}" name="jumlahObat[]" required>
                                <option value="30 tablet/bulan">30 tablet/bulan</option>
                                <option value="60 tablet/bulan">60 tablet/bulan</option>
                                <option value="90 tablet/bulan">90 tablet/bulan</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="waktuMinum${totalObat}" class="form-label">Waktu Minum Obat</label>
                            <select class="form-select" id="waktuMinum${totalObat}" name="waktuMinum[]" required>
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
                        </div>
                    `;
                    obatContainer.appendChild(obatDiv);
                }
            
                if (totalObat === maxObat) {
                    tambahObat.disabled = true;
                }
            });

            // Validasi sebelum submit
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const minObat = parseInt(tambahObat.dataset.minObat || 0);

                if (totalObat < minObat) {
                    alert(`Silakan tambahkan minimal ${minObat} obat.`);
                } else {
                    alert('Form berhasil disubmit!');
                    form.submit();
                }
            });

            document.getElementById('submitButton').addEventListener('click', function () {
                document.getElementById('popupOverlay').style.display = 'flex';
            });

            document.getElementById('closePopup').addEventListener('click', function () {
                document.getElementById('popupOverlay').style.display = 'none';
            });
        });
    </script>
@endsection