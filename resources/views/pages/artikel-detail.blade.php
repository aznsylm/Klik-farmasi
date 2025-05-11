@extends('layouts.app')

@section('title', $article->title)

@section('content')
<section class="py-5">
    <div class="container px-5">
        <!-- Tombol Kembali -->
        <div class="mb-4">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="row gx-5">
            <!-- Konten Artikel -->
            <div class="col-lg-8">
                <h1 class="fw-bolder mb-3" style="font-family: 'Open Sans', sans-serif; color: #0b5e91;">{{ $article->title }}</h1>
                <p class="text-muted mb-2" style="font-family: 'Open Sans', sans-serif;">
                    <span class="badge bg-secondary">{{ $article->category }}</span>
                </p>
                <p class="text-muted small mb-4" style="font-family: 'Open Sans', sans-serif; font-style: italic;">
                    <i class="bi bi-person-circle"></i> Oleh {{ $article->author }} - 
                    {{ $article->published_at ? $article->published_at->format('d M Y') : 'Tanggal tidak tersedia' }}
                </p>
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="img-fluid rounded mb-4 shadow" data-aos="fade-out">
                <p class="text-muted" style="font-family: 'Open Sans', sans-serif; line-height: 1.8;">
                    {!! nl2br(e($article->content)) !!}
                </p>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4" data-aos="fade-up">
                <div class="card border-0 bg-light mt-xl-5 shadow-sm">
                    <div class="card-body p-4 py-lg-5">
                        <div class="text-center">
                            <!-- Hubungi Kami -->
                            <div class="h5 fw-bold mb-3 text-primary">Punya Pertanyaan?</div>
                            <p class="text-muted mb-4" style="font-size: 14px;">
                                Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan atau membutuhkan bantuan.
                            </p>
                            <a href="mailto:support@klikfarmasi.com" class="btn btn-primary w-100 mb-4" style="background-color: #0b5e91; border: none;">
                                <i class="bi-envelope"></i> Email Kami
                            </a>
            
                            <!-- Ikuti Kami -->
                            <div class="h5 fw-bold mb-3 text-primary">Ikuti Kami</div>
                            <p class="text-muted mb-4" style="font-size: 14px;">
                                Tetap terhubung dengan kami melalui media sosial untuk mendapatkan informasi terbaru.
                            </p>
                            <div class="d-flex justify-content-center gap-3">
                                <a class="fs-4 text-dark" href="https://wa.me/1234567890" target="_blank" style="text-decoration: none;">
                                    <i class="bi-whatsapp"></i>
                                </a>
                                <a class="fs-4 text-dark" href="https://instagram.com/klikfarmasi" target="_blank" style="text-decoration: none;">
                                    <i class="bi-instagram"></i>
                                </a>
                                <a class="fs-4 text-dark" href="https://tiktok.com/@klikfarmasi" target="_blank" style="text-decoration: none;">
                                    <i class="bi-tiktok"></i>
                                </a>
                                <a class="fs-4 text-dark" href="mailto:support@klikfarmasi.com" style="text-decoration: none;">
                                    <i class="bi-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection