@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Kelola FAQ</h1>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Tombol Tambah FAQ -->
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">Tambah FAQ</a>
    
        <!-- Tombol Kembali ke Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Kategori</th>
                    <th>Pertanyaan</th>
                    <th>Jawaban</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($faqs as $faq)
                    <tr>
                        <td>{{ $faq->category }}</td>
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->answer }}</td>
                        <td>
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection