@extends('layouts.app')
@section('title', 'Tanya Jawab Hipertensi Kehamilan - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description" content="FAQ dan tanya jawab seputar hipertensi kehamilan. Dapatkan jawaban dari ahli farmasi tentang preeklampsia, obat hipertensi saat hamil, dan tips kesehatan ibu hamil.">
    <meta name="keywords" content="FAQ hipertensi kehamilan, tanya jawab preeklampsia, obat hipertensi hamil, konsultasi kehamilan, farmasi kehamilan">
    <meta name="author" content="Tim Farmasi Universitas Alma Ata">
@endpush

@section('content')
    <section class="py-5 faq-section">
        <div class="container px-4">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <h2 class="fw-bolder mb-3 text-primary">Hipertensi Kehamilan</h2>
                <p class="lead text-muted mx-auto" style="max-width:700px;">
                    Temukan jawaban untuk pertanyaan umum tentang hipertensi selama kehamilan
                </p>
                <div class="d-flex justify-content-center mt-3">
                    <div class="section-divider"></div>
                </div>
            </div>
            <div class="row gx-5">
                <!-- FAQ Content -->
                <div class="col-lg-8">
                    <!-- Search Bar -->
                    <div class="faq-search mb-5">
                        <div class="input-group"><span class="input-group-text bg-white border-end-0"><i
                                    class="bi bi-search" aria-hidden="true"></i></span><input type="text" id="faqSearch"
                                class="form-control border-start-0" placeholder="Cari pertanyaan..." aria-label="Cari pertanyaan tentang hipertensi kehamilan">
                        </div>
                    </div>
                    <!-- FAQ Accordion: Hipertensi Kehamilan -->
                    <div class="faq-group mb-5" id="hipertensi-kehamilan">
                        <div class="faq-group-header">
                            <h2 class="fw-bold text-primary">
                                Pertanyaan Seputar Hipertensi Kehamilan
                            </h2>
                            <p>Informasi tentang hipertensi yang terjadi selama kehamilan</p>
                        </div>
                        <div class="accordion custom-accordion" id="accordionHipertensiKehamilan">
                            @foreach ($faqs as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $loop->index }}"><button
                                            class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}"
                                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                            aria-controls="collapse{{ $loop->index }}">
                                            {{ $faq->question }}
                                        </button></h2>
                                    <div class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                        id="collapse{{ $loop->index }}" aria-labelledby="heading{{ $loop->index }}"
                                        data-bs-parent="#accordionHipertensiKehamilan">
                                        <div class="accordion-body">
                                            <p class="text-dark fs-6 lh-lg" style="text-align: justify;">{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="sticky-top" style="top:2rem;z-index:1000;"><!-- Quick Help Card -->
                        <div class="card border-0 rounded-4 shadow-sm mb-4">
                            <div class="card-header text-white py-3 border-0 bg-primary">
                                <h5 class="mb-0 fw-bold text-white"><i class="bi bi-info-circle me-2"></i> Bantuan
                                    Cepat</h5>
                            </div>
                            <div class="card-body p-4">
                                <p class="card-text">Temukan jawaban cepat untuk pertanyaan tentang hipertensi kehamilan.
                                </p>
                                <div class="quick-links"><a href="{{ route('tanya-jawab.non-kehamilan') }}"
                                        class="quick-link"><span>Hipertensi Non-Kehamilan</span></a><a
                                        href="#hipertensi-kehamilan" class="quick-link"><span>Hipertensi saat
                                            hamil</span></a></div>
                            </div>
                        </div><!-- Contact Card -->
                        <div class="card border-0 rounded-4 shadow-sm">
                            <div class="card-body p-4">
                                <div class="text-center mb-4">
                                    <div class="icon-circle text-white mx-auto mb-3 bg-primary"><i
                                            class="bi bi-chat-dots-fill"></i></div>
                                    <h5 class="fw-bold">Punya Pertanyaan?</h5>
                                    <p class="text-muted mb-0">Jangan ragu untuk menghubungi kami jika Anda memiliki
                                        pertanyaan atau membutuhkan bantuan.</p>
                                </div><a href="mailto:klikfarmasi.official@gmail.com" class="btn btn-khusus w-100 mb-3"><i
                                        class="bi bi-envelope me-2"></i> Email Kami
                                </a><a href="https://wa.me/+6285280909235" class="btn btn-success w-100"><i
                                        class="bi bi-whatsapp me-2"></i> WhatsApp
                                </a>
                                <hr class="my-4">
                                <h5 class="fw-bold text-center mb-3">Ikuti Kami</h5>
                                <div class="d-flex justify-content-center gap-3"><a class="social-icon"
                                        href="https://wa.me/+6285280909235" target="_blank"><i
                                            class="bi bi-whatsapp"></i></a><a class="social-icon"
                                        href="https://www.instagram.com/klikfarmasi.official/" target="_blank"><i
                                            class="bi bi-instagram"></i></a><a class="social-icon"
                                        href="https://www.tiktok.com/@klikfarmasi.official" target="_blank"><i
                                            class="bi bi-tiktok"></i></a><a class="social-icon"
                                        href="mailto:klikfarmasi.official@gmail.com"><i class="bi bi-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
