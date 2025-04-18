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
            <a href="{{ route('login') }}" style="text-decoration: none; padding: 5px 10px; background-color: #007bff; color: white; border-radius: 5px;">Login</a>
            <a href="{{ route('register') }}" style="text-decoration: none; padding: 5px 10px; background-color: #28a745; color: white; border-radius: 5px;">Register</a>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main style="padding: 20px;">
        <h1>Form Pengingat Obat</h1>
        <form id="pengingatForm" action="{{ url('/pengingat') }}" method="POST" style="display: flex; flex-direction: column; gap: 15px; max-width: 400px;">
            @csrf <!-- Tambahkan CSRF token untuk keamanan -->
            
            <!-- Input Nama -->
            <div>
                <label for="nama" style="display: block; margin-bottom: 5px;">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <!-- Input Nama Obat -->
            <div>
                <label for="nama_obat" style="display: block; margin-bottom: 5px;">Nama Obat:</label>
                <input type="text" id="nama_obat" name="nama_obat" placeholder="Masukkan nama obat" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <!-- Input Jadwal Minum Obat -->
            <div>
                <label for="jadwal" style="display: block; margin-bottom: 5px;">Jadwal Minum Obat:</label>
                <input type="datetime-local" id="jadwal" name="jadwal" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
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
    </script>
</body>
</html>