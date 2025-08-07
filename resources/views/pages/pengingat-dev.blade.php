@extends('layouts.app')
@section('title', 'Pengingat Minum Obat - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description" content="Fitur pengingat minum obat untuk penderita hipertensi sedang dalam tahap pengembangan. Dapatkan notifikasi jadwal minum obat yang tepat waktu.">
    <meta name="keywords" content="pengingat minum obat, alarm obat hipertensi, jadwal minum obat, notifikasi obat, manajemen obat">
    <meta name="author" content="Tim Farmasi Universitas Alma Ata">
@endpush
@section('content')
    <section class="py-5" style="background:linear-gradient(135deg, #0b5e91 0%, #1a7bb8 100%);min-height:100vh;">
        <div class="container px-4">
            <div class="row justify-content-center align-items-center" style="min-height:80vh;">
                <div class="col-lg-8 col-xl-6">
                    <div class="card border-0 shadow-lg" style="border-radius:20px;overflow:hidden;">
                        <div class="card-body p-5 text-center"><!-- Icon Animation -->
                            <div class="mb-4 position-relative">
                                <div class="development-icon-bg"></div><i class="bi bi-gear-fill development-icon"
                                    style="font-size:4rem;color:#0b5e91;" aria-hidden="true"></i>
                            </div>
                            <div class="alert alert-info border-0 mb-4"
                                style="background:linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);">
                                <div class="d-flex align-items-center"><i class="bi bi-info-circle-fill text-primary me-3"
                                        style="font-size:1.5rem;"></i>
                                    <div class="text-start">
                                        <h6 class="mb-1 text-primary fw-bold">Informasi Pengembangan</h6>
                                        <p class="mb-0 text-primary">Tim developer kami sedang bekerja keras untuk
                                            menghadirkan fitur pengingat minum obat dan mudah digunakan.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-3 justify-content-center flex-wrap"><a
                                    href="{{ route('artikel.non-kehamilan') }}"
                                    class="btn btn-outline-primary px-4 py-2 rounded-pill"><i
                                        class="bi bi-journal-text me-2"></i> Baca Artikel Kesehatan
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
