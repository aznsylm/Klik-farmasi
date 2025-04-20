<h1>Detail User</h1>
<p><strong>Nama:</strong> {{ $user->name }}</p>
<p><strong>Email:</strong> {{ $user->email }}</p>
<a href="{{ route('admin.users') }}" style="padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
    Kembali ke Daftar User
</a>