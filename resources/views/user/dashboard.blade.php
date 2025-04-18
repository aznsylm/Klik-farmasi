<h1>Dashboard User</h1>
<p>Selamat datang, {{ Auth::user()->name }}!</p>
<a href="{{ url('/') }}">Kembali ke Beranda</a>