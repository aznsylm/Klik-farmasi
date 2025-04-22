@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <div class="my-5 text-center text-xl-start">
                        <h1 class="display-5 fw-bolder text-white mb-2">Selamat Datang di Klik Farmasi</h1>
                        <p class="lead fw-normal text-white-50 mb-4">Platform untuk informasi kesehatan dan pengingat obat Anda.</p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                            <a class="btn btn-primary btn-lg px-4 me-sm-3" href="{{ url('/artikel') }}">Lihat Artikel</a>
                            <a class="btn btn-outline-light btn-lg px-4" href="{{ url('/pengingat') }}">Pengingat Obat</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="{{ asset('assets/sample-1.jpg') }}" alt="..." style="width: 600px; height: 400px; object-fit: cover;" /></div>
            </div>
        </div>
    </header>

    <!-- Features section-->
    <section class="py-5" id="features">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h2 class="fw-bolder mb-0">Kenapa Memilih Kami?</h2>
                </div>
                <div class="col-lg-8">
                    <div class="row gx-5 row-cols-1 row-cols-md-2">
                        <div class="col mb-5 h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3">
                                <i class="bi bi-alarm"></i>
                            </div>
                            <h2 class="h5">Pengingat Minum Obat</h2>
                            <p class="mb-0">Fitur pengingat minum obat kami dirancang khusus untuk membantu penderita hipertensi agar tidak melewatkan jadwal minum obat, sehingga tekanan darah tetap terkontrol.</p>
                        </div>
                        <div class="col mb-5 h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3">
                                <i class="bi bi-info-circle"></i>
                            </div>
                            <h2 class="h5">Informasi Kesehatan Terpercaya</h2>
                            <p class="mb-0">Kami menyediakan artikel dan panduan kesehatan yang akurat dan terpercaya untuk membantu Anda menjalani hidup lebih sehat.</p>
                        </div>
                        <div class="col mb-5 mb-md-0 h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <h2 class="h5">Manajemen Jadwal</h2>
                            <p class="mb-0">Atur jadwal minum obat Anda dengan mudah menggunakan fitur kalender yang terintegrasi di platform kami.</p>
                        </div>
                        <div class="col h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3">
                                <i class="bi bi-people"></i>
                            </div>
                            <h2 class="h5">Komunitas Pendukung</h2>
                            <p class="mb-0">Bergabunglah dengan komunitas kami untuk berbagi pengalaman dan mendapatkan dukungan dari sesama penderita hipertensi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <div class="py-5 bg-light">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-10 col-xl-7">
                    <div class="text-center">
                        <div class="fs-4 mb-4 fst-italic">"Klik Farmasi telah membantu saya mengelola jadwal minum obat dengan mudah. Saya tidak pernah melewatkan waktu minum obat lagi!"</div>
                        <div class="d-flex align-items-center justify-content-center">
                            <img class="rounded-circle me-3" src="{{ asset('assets/ProfilePerson.png') }}" alt="..." style="width: 50px; height: 50px; object-fit: cover;" />
                            <div class="fw-bold">
                                Budi Santoso
                                <span class="fw-bold text-primary mx-1">/</span>
                                Pengguna Setia
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Preview Section -->
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="text-center">
                        <h2 class="fw-bolder">Artikel Terbaru</h2>
                        <p class="lead fw-normal text-muted mb-5">Temukan informasi kesehatan terbaru dan tips bermanfaat untuk hidup sehat.</p>
                    </div>
                </div>
            </div>
            <div class="row gx-5">
                @forelse ($articles as $article)
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0">

                            <div class="card-body p-4">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{ $article->category }}</div>
                                <a class="text-decoration-none link-dark stretched-link" href="{{ $article->link }}" target="_blank">
                                    <div class="h5 card-title mb-3">{{ $article->title }}</div>
                                </a>
                                <p class="card-text mb-0">{{ $article->summary }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Belum ada artikel yang tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection