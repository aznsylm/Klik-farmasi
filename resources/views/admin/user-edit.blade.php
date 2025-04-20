<h1>Edit User</h1>
<form action="{{ route('admin.userUpdate', $user->id) }}" method="POST" style="max-width: 400px;">
    @csrf
    @method('PUT')

    <div style="margin-bottom: 10px;">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
    </div>

    <div style="margin-bottom: 10px;">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
    </div>

    <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">
        Simpan Perubahan
    </button>
</form>

<a href="{{ route('admin.users') }}" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
    Kembali ke Daftar User
</a>