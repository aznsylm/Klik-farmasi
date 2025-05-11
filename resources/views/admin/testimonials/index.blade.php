<!-- filepath: resources/views/admin/testimonials/index.blade.php -->
@extends('layouts.app')

@section('title', 'Kelola Testimonial')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4">Kelola Testimonial</h1>

    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary mb-3">Tambah Testimonial</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Quote</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($testimonials as $testimonial)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $testimonial->quote }}</td>
                    <td>{{ $testimonial->name }}</td>
                    <td>
                        <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus testimonial ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection