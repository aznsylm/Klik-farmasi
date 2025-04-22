@extends('layouts.app')

@section('title', 'Unduhan')

@section('content')
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="text-center mb-5">
                <h1 class="fw-bold">Unduhan Informasi Hipertensi</h1>
                <p class="lead text-muted">Dapatkan materi edukasi tentang hipertensi untuk meningkatkan kesadaran dan kesehatan Anda.</p>
            </div>
            <div class="row gx-5 gy-5">
                {{-- File 1 --}}
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0">
                        <img class="card-img-top rounded-top" src="{{ asset('assets/sample-2.jpg') }}" alt="Panduan Hipertensi" style="height: 300px; object-fit: cover;" />
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Panduan Lengkap Hipertensi</h5>
                            <p class="card-text text-muted">Pelajari panduan lengkap untuk memahami dan mengelola hipertensi.</p>
                            <a href="https://drive.google.com/file/d/1-example-link/view" target="_blank" class="btn btn-primary">
                                <i class="bi bi-download"></i> Unduh
                            </a>
                        </div>
                    </div>
                </div>
                {{-- File 2 --}}
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0">
                        <img class="card-img-top rounded-top" src="{{ asset('assets/sample-4.jpg') }}" alt="Tips Pola Hidup Sehat" style="height: 300px; object-fit: cover;" />
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Tips Pola Hidup Sehat untuk Penderita Hipertensi</h5>
                            <p class="card-text text-muted">Dapatkan tips pola hidup sehat untuk membantu mengelola hipertensi.</p>
                            <a href="https://drive.google.com/file/d/2-example-link/view" target="_blank" class="btn btn-primary">
                                <i class="bi bi-download"></i> Unduh
                            </a>
                        </div>
                    </div>
                </div>
                {{-- File 3 --}}
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0">
                        <img class="card-img-top rounded-top" src="{{ asset('assets/sample-3.jpg') }}" alt="Daftar Makanan Sehat" style="height: 300px; object-fit: cover;" />
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Daftar Makanan Sehat untuk Hipertensi</h5>
                            <p class="card-text text-muted">Temukan daftar makanan sehat yang cocok untuk penderita hipertensi.</p>
                            <a href="https://drive.google.com/file/d/3-example-link/view" target="_blank" class="btn btn-primary">
                                <i class="bi bi-download"></i> Unduh
                            </a>
                        </div>
                    </div>
                </div>
                {{-- File 4 --}}
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0">
                        <img class="card-img-top rounded-top" src="{{ asset('assets/sample-5.jpg') }}" alt="Olahraga Aman" style="height: 300px; object-fit: cover;" />
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Panduan Olahraga Aman untuk Hipertensi</h5>
                            <p class="card-text text-muted">Pelajari panduan olahraga aman untuk menjaga kesehatan penderita hipertensi.</p>
                            <a href="https://drive.google.com/file/d/4-example-link/view" target="_blank" class="btn btn-primary">
                                <i class="bi bi-download"></i> Unduh
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container px-5 my-5 text-center">
            <h2 class="display-5 fw-bold mb-4">Mari tingkatkan kesadaran tentang hipertensi</h2>
            <p class="lead text-muted mb-4">Hubungi kami untuk mendapatkan informasi lebih lanjut atau dukungan terkait hipertensi.</p>
            <a class="btn btn-lg btn-primary" href="mailto:support@klikfarmasi.com">
                <i class="bi bi-envelope"></i> Hubungi Kami
            </a>
        </div>
    </section>

    <style>
        /* Card Styling */
        .card {
            border-radius: 10px;
            overflow: hidden;
        }

        .card-img-top {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.25rem;
            color: #333;
        }

        .card-text {
            font-size: 0.9rem;
            color: #6c757d;
        }

        /* Button Styling */
        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Section Styling */
        .bg-light {
            background-color: #f8f9fa !important;
        }

        .display-5 {
            font-size: 2rem;
        }
    </style>
@endsection