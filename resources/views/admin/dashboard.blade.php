<h1>Dashboard Admin</h1>
<p>Selamat datang, {{ Auth::user()->name }}!</p>
<a href="{{ route('admin.users') }}">Kelola Data User</a>