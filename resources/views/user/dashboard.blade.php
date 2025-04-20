<h1>Dashboard Pasien</h1>
<p>Selamat datang, {{ Auth::user()->name }}!</p>
<a href="{{ url('/') }}">Kembali ke Beranda</a>

<!-- Tombol Logout -->
<form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
    @csrf
    <button type="submit" style="padding: 10px 20px; background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer;">
        Logout
    </button>
</form>