@extends('layouts.app')

@section('title', 'Unduhan')

@section('content')
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="text-center mb-5">
                <h1 class="fw-bolder">Unduhan Informasi Hipertensi</h1>
                <p class="lead fw-normal text-muted mb-0">Dapatkan materi edukasi tentang hipertensi</p>
            </div>
            <div class="row gx-5">
                {{-- File 1 --}}
                <div class="col-lg-6">
                    <div class="position-relative mb-5">
                        <img class="img-fluid rounded-3 mb-3" src="{{ asset('assets/sample-2.jpg') }}" alt="Panduan Hipertensi" style="width: 600px; height: 400px; object-fit: cover;" />
                        <a class="h3 fw-bolder text-decoration-none link-dark stretched-link" href="https://drive.google.com/file/d/1-example-link/view" target="_blank">
                            Panduan Lengkap Hipertensi
                        </a>
                    </div>
                </div>
                {{-- File 2 --}}
                <div class="col-lg-6">
                    <div class="position-relative mb-5">
                        <img class="img-fluid rounded-3 mb-3" src="{{ asset('assets/sample-4.jpg') }}" alt="Tips Pola Hidup Sehat" style="width: 600px; height: 400px; object-fit: cover;" />
                        <a class="h3 fw-bolder text-decoration-none link-dark stretched-link" href="https://drive.google.com/file/d/2-example-link/view" target="_blank">
                            Tips Pola Hidup Sehat untuk Penderita Hipertensi
                        </a>
                    </div>
                </div>
                {{-- File 3 --}}
                <div class="col-lg-6">
                    <div class="position-relative mb-5 mb-lg-0">
                        <img class="img-fluid rounded-3 mb-3" src="{{ asset('assets/sample-3.jpg') }}" alt="Daftar Makanan Sehat" style="width: 600px; height: 400px; object-fit: cover;" />
                        <a class="h3 fw-bolder text-decoration-none link-dark stretched-link" href="https://drive.google.com/file/d/3-example-link/view" target="_blank">
                            Daftar Makanan Sehat untuk Hipertensi
                        </a>
                    </div>
                </div>
                {{-- File 4 --}}
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img class="img-fluid rounded-3 mb-3" src="{{ asset('assets/sample-5.jpg') }}" alt="Olahraga Aman" style="width: 600px; height: 400px; object-fit: cover;" />
                        <a class="h3 fw-bolder text-decoration-none link-dark stretched-link" href="https://drive.google.com/file/d/4-example-link/view" target="_blank">
                            Panduan Olahraga Aman untuk Hipertensi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container px-5 my-5">
            <h2 class="display-4 fw-bolder mb-4">Mari tingkatkan kesadaran tentang hipertensi</h2>
            <a class="btn btn-lg btn-primary" href="mailto:support@klikfarmasi.com">Hubungi Kami</a>
        </div>
    </section>
@endsection