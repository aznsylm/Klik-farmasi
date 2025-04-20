<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengingat</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Tambahkan jika menggunakan CSS --> --}}
    <style>
        /* Styling untuk pop-up */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            position: relative; /* Tambahkan ini */
            background: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .popup-content button {
            margin-top: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .popup-content .login-btn {
            background-color: #007bff;
            color: white;
        }

        .popup-content .register-btn {
            background-color: #28a745;
            color: white;
        }

        #closePopup {
            position: absolute;
            top: -5px;
            right: 10px;
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
        }

        /* Container Styling */
        .container {
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        /* Form Title */
        h2 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #333;
        }

        /* Labels */
        .form-label {
            font-weight: 500;
            color: #555;
        }

        /* Inputs and Selects */
        .form-control, .form-select {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        /* Buttons */
        .btn {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            border-radius: 5px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        /* Obat Section */
        #daftarObat {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
        }

        #daftarObat label {
            font-weight: bold;
            color: #333;
        }

        /* Obat Items */
        #obatContainer .mb-3 {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            background-color: #f8f9fa;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .row .col-md-4, .row .col-md-6 {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav style="background-color: #f8f9fa; padding: 10px;">
        <ul style="list-style: none; display: flex; gap: 15px; margin: 0; padding: 0;">
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li><a href="{{ url('/artikel') }}">Artikel</a></li>
            <li><a href="{{ url('/tanya-jawab') }}">Tanya Jawab</a></li>
            <li><a href="{{ url('/unduhan') }}">Unduhan</a></li>
            <li><a href="{{ url('/pengingat') }}">Pengingat</a></li>
        </ul>

        <!-- Auth Buttons -->
        <div style="display: flex; gap: 10px;">
            @guest
                <a href="{{ route('login') }}" style="text-decoration: none; padding: 5px 10px; background-color: #007bff; color: white; border-radius: 5px;">Login</a>
                <a href="{{ route('register') }}" style="text-decoration: none; padding: 5px 10px; background-color: #28a745; color: white; border-radius: 5px;">Register</a>
            @endguest

            @auth
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="text-decoration: none; padding: 5px 10px; background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </nav>

    <!-- Konten Utama -->
    <main style="padding: 20px;">
        <div class="container my-5">
            <h2 class="text-center mb-4">Pengingat Minum Obat</h2>
            <form id="formPengingat">
                <!-- Nama Pasien -->
                <div class="mb-3">
                    <label for="namaPasien" class="form-label">Nama Pasien</label>
                    <input type="text" class="form-control" id="namaPasien" name="namaPasien" placeholder="Masukkan nama pasien" required>
                </div>

                <!-- Jenis Kelamin, Usia, Nomor WA (1 Row) -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenisKelamin" name="jenisKelamin" required>
                            <option value="">Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="usia" class="form-label">Usia</label>
                        <input type="number" class="form-control" id="usia" name="usia" placeholder="Masukkan usia" required>
                    </div>
                    <div class="col-md-4">
                        <label for="nomorWa" class="form-label">Nomor WhatsApp</label>
                        <input type="tel" class="form-control" id="nomorWa" name="nomorWa" placeholder="+62 812-3456-7890" pattern="^\+62\s?\d{3,4}-\d{3,4}-\d{3,4}$" required>
                    </div>
                </div>

                <!-- Diagnosa dan Tekanan Darah (1 Row) -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="diagnosa" class="form-label">Diagnosa Penyakit</label>
                        <select class="form-select" id="diagnosa" name="diagnosa" required>
                            <option value="">Pilih</option>
                            <option value="Non-Komplikasi">Hipertensi Non-Komplikasi</option>
                            <option value="Komplikasi">Hipertensi Komplikasi</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="tekananDarah" class="form-label">Tekanan Darah</label>
                        <input type="text" class="form-control" id="tekananDarah" name="tekananDarah" placeholder="Contoh: 120/80 mmHg" required>
                    </div>
                </div>

                <!-- Daftar Obat -->
                <div id="daftarObat" class="mb-3 mt-5">
                    <label class="form-label"><strong>Daftar Obat</strong></label>
                    <div id="obatContainer"></div>
                    <button type="button" class="btn btn-primary mt-2" id="tambahObat">Tambah Obat</button>
                </div>

                <!-- Button Submit -->
                @guest
                    <button type="button" id="submitButton" style="padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        Submit
                    </button>
                @endguest

                @auth
                    <button type="submit" style="padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        Submit
                    </button>
                @endauth
            </form>
        </div>
    </main>

    <!-- Pop-up -->
    <div class="popup-overlay" id="popupOverlay">
        <div class="popup-content">
            <!-- Tombol Close -->
            <button id="closePopup" style="position: absolute;  background: none; border: none; font-size: 28px; cursor: pointer;">&times;</button>
            
            <p>Anda harus login terlebih dahulu untuk mengirimkan data.</p>
            <a href="{{ route('login') }}"><button class="login-btn">Login</button></a>
            <a href="{{ route('register') }}"><button class="register-btn">Register</button></a>
        </div>
    </div>

    <!-- Footer -->
    <footer style="background-color: #f8f9fa; padding: 10px; text-align: center;">
        <p>&copy; 2025 Klik Farmasi. All rights reserved.</p>
    </footer>

    <script>
        // JavaScript untuk menampilkan pop-up
        document.getElementById('submitButton').addEventListener('click', function () {
            document.getElementById('popupOverlay').style.display = 'flex';
        });

        // JavaScript untuk menutup pop-up
        document.getElementById('closePopup').addEventListener('click', function () {
            document.getElementById('popupOverlay').style.display = 'none';
        });

        document.addEventListener('DOMContentLoaded', function () {
            
            const diagnosa = document.getElementById('diagnosa');
            const tambahObat = document.getElementById('tambahObat');
            const obatContainer = document.getElementById('obatContainer');
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

            diagnosa.addEventListener('change', function () {
                totalObat = 0;
                obatContainer.innerHTML = '';
                tambahObat.disabled = false;

                if (diagnosa.value === 'Non-Komplikasi') {
                    tambahObat.dataset.maxObat = 2;
                    tambahObat.dataset.minObat = 0;
                } else if (diagnosa.value === 'Komplikasi') {
                    tambahObat.dataset.maxObat = 99;
                    tambahObat.dataset.minObat = 2;
                }
            });

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
                                <option value="90 tablet/bulan">90 tablet/bulan</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="waktuMinum${totalObat}" class="form-label">Waktu Minum Obat</label>
                            <input type="time" class="form-control" id="waktuMinum${totalObat}" name="waktuMinum[]" required>
                        </div>
                    `;
                    obatContainer.appendChild(obatDiv);
                }

                if (totalObat === maxObat) {
                    tambahObat.disabled = true;
                }
            });

            const form = document.getElementById('formPengingat');
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const minObat = parseInt(tambahObat.dataset.minObat || 0);

                if (totalObat < minObat) {
                    alert(`Silakan tambahkan minimal ${minObat} obat sebelum menyimpan pengingat.`);
                } else if (totalObat === 0) {
                    alert("Silakan tambahkan setidaknya 1 obat.");
                } else {
                    alert('Form berhasil disubmit!');
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>