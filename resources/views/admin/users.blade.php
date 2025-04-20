<h1>Daftar User</h1>

@if (session('success'))
    <div style="color: green; margin-bottom: 10px;">
        {{ session('success') }}
    </div>
@endif

<table border="1" style="width: 100%; border-collapse: collapse; text-align: left;">
    <thead>
        <tr>
            <th style="padding: 10px; background-color: #f8f9fa;">Nama</th>
            <th style="padding: 10px; background-color: #f8f9fa;">Email</th>
            <th style="padding: 10px; background-color: #f8f9fa;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td style="padding: 10px;">{{ $user->name }}</td>
                <td style="padding: 10px;">{{ $user->email }}</td>
                <td style="padding: 10px;">
                    <!-- Tombol Lihat Detail -->
                    <a href="{{ route('admin.userDetail', $user->id) }}" style="padding: 5px 10px; background-color: #17a2b8; color: white; text-decoration: none; border-radius: 5px;">
                        Detail
                    </a>

                    <!-- Tombol Edit -->
                    <a href="{{ route('admin.userEdit', $user->id) }}" style="padding: 5px 10px; background-color: #ffc107; color: white; text-decoration: none; border-radius: 5px;">
                        Edit
                    </a>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="padding: 5px 10px; background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer;">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('admin.dashboard') }}" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
    Kembali ke Dashboard
</a>