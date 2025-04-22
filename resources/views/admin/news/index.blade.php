{{-- filepath: resources/views/admin/news/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Kelola Berita</h1>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Tombol Tambah Berita -->
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">Tambah Artikel</a>
    
        <!-- Tombol Kembali ke Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Judul</th>
                <th>Sumber</th>
                <th>Link</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($news as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->source }}</td>
                    <td><a href="{{ $item->link }}" target="_blank">Lihat</a></td>
                    <td>{{ $item->published_at }}</td>
                    <td>
                        <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $news->links() }}
</div>
@endsection