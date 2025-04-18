<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Tambahkan jika menggunakan CSS --> --}}
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
        <h1>Halaman Artikel</h1>
        <p>Ini adalah konten sementara untuk halaman artikel.</p>
    </main>

    <!-- Footer -->
    <footer style="background-color: #f8f9fa; padding: 10px; text-align: center;">
        <p>&copy; 2025 Klik Farmasi. All rights reserved.</p>
    </footer>
</body>
</html>