@extends('layouts.app')
@section('title', 'Tanya Jawab Hipertensi Non-Kehamilan - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description"
        content="FAQ dan tanya jawab seputar hipertensi umum. Dapatkan jawaban dari ahli farmasi tentang obat hipertensi, gaya hidup sehat, dan tips pengelolaan tekanan darah tinggi.">
    <meta name="keywords"
        content="FAQ hipertensi, tanya jawab tekanan darah tinggi, obat hipertensi, konsultasi farmasi, tips kesehatan">
    <meta name="author" content="Tim Farmasi Universitas Alma Ata">

    <!-- External CSS for FAQ pages -->
    <link rel="stylesheet" href="{{ asset('css/faq-pages.css') }}" media="screen">
@endpush

@section('content')
    <section class="py-5 faq-section">
        <div class="container px-4">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <h2 class="fw-bolder mb-3 text-primary">Hipertensi Non-Kehamilan</h2>
                <p class="lead text-muted mx-auto" style="max-width:700px;">
                    Temukan jawaban untuk pertanyaan umum tentang hipertensi pada umumnya
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
                                class="form-control border-start-0" placeholder="Cari pertanyaan..."
                                aria-label="Cari pertanyaan tentang hipertensi"></div>
                    </div>
                    <!-- FAQ Accordion: Hipertensi Non-Kehamilan -->
                    <div class="faq-group mb-5" id="hipertensi-non-kehamilan">
                        <div class="faq-group-header">
                            <h2 class="fw-bold text-primary">
                                Pertanyaan Seputar Hipertensi Non-Kehamilan
                            </h2>
                            <p class="text-muted">Informasi tentang hipertensi pada umumnya (bukan saat kehamilan)</p>
                        </div>
                        <div class="accordion custom-accordion" id="accordionHipertensiNonKehamilan">
                            @php
                                $perPage = 7;
                                $currentPage = request()->get('page', 1);
                                $offset = ($currentPage - 1) * $perPage;
                                $paginatedFaqs = $faqs->slice($offset, $perPage)->values(); // Reset keys
                                $totalPages = ceil($faqs->count() / $perPage);
                            @endphp

                            @foreach ($paginatedFaqs as $index => $faq)
                                @php
                                    $displayNumber = $offset + $index + 1; // Continuous numbering
                                @endphp
                                <div class="faq-item" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                                    <h3 class="faq-header" id="heading{{ $index }}">
                                        <button class="faq-button {{ $index == 0 ? '' : 'collapsed' }}" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                            aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                            aria-controls="collapse{{ $index }}">
                                            <span class="question-number">{{ $displayNumber }}</span>
                                            <span class="question-text">{!! $faq->question !!}</span>
                                            <i class="bi bi-chevron-down toggle-icon"></i>
                                        </button>
                                    </h3>
                                    <div class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                                        id="collapse{{ $index }}" aria-labelledby="heading{{ $index }}"
                                        data-bs-parent="#accordionHipertensiNonKehamilan">
                                        <div class="faq-answer">
                                            <div class="answer-text">{!! $faq->answer !!}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @if ($totalPages > 1)
                                <!-- Pagination -->
                                <div class="d-flex justify-content-center mt-4">
                                    <nav aria-label="FAQ Pagination">
                                        <ul class="pagination pagination-sm">
                                            {{-- Previous Page Link --}}
                                            @if ($currentPage > 1)
                                                <li class="page-item">
                                                    <a class="page-link" href="?page={{ $currentPage - 1 }}"
                                                        aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>
                                            @else
                                                <li class="page-item disabled">
                                                    <span class="page-link">&laquo;</span>
                                                </li>
                                            @endif

                                            {{-- Page Number Links --}}
                                            @for ($i = 1; $i <= $totalPages; $i++)
                                                @if ($i == $currentPage)
                                                    <li class="page-item active" aria-current="page">
                                                        <span class="page-link">{{ $i }}</span>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link"
                                                            href="?page={{ $i }}">{{ $i }}</a>
                                                    </li>
                                                @endif
                                            @endfor

                                            {{-- Next Page Link --}}
                                            @if ($currentPage < $totalPages)
                                                <li class="page-item">
                                                    <a class="page-link" href="?page={{ $currentPage + 1 }}"
                                                        aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            @else
                                                <li class="page-item disabled">
                                                    <span class="page-link">&raquo;</span>
                                                </li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>

                                <div class="text-center mt-3">
                                    <small class="text-muted">
                                        Menampilkan {{ $paginatedFaqs->count() }} dari {{ $faqs->count() }} FAQ
                                        (Halaman {{ $currentPage }} dari {{ $totalPages }})
                                    </small>
                                </div>
                            @endif
                        </div>

                        <!-- External JavaScript for FAQ functionality -->
                        <script src="{{ asset('js/faq-pages.js') }}" defer></script>
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="sticky-top" style="top:2rem;z-index:1000;">
                        <!-- Quick Help Card -->
                        <div class="card border-0 rounded-4 shadow-sm mb-4">
                            <div class="card-header text-white py-3 border-0 bg-primary">
                                <h5 class="mb-0 fw-bold text-white"><i class="bi bi-info-circle me-2"></i> Bantuan
                                    Cepat</h5>
                            </div>
                            <div class="card-body p-4">
                                <p class="card-text">Temukan jawaban cepat untuk pertanyaan tentang hipertensi
                                    non-kehamilan.</p>
                                <div class="quick-links"><a href="{{ route('tanya-jawab.kehamilan') }}"
                                        class="quick-link"><span>Hipertensi Kehamilan</span></a><a
                                        href="#hipertensi-non-kehamilan" class="quick-link"><span>Hipertensi umum</span></a>
                                </div>
                            </div>
                        </div>
                        <!-- Contact Card -->
                        <div class="card border-0 rounded-4 shadow-sm">
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <h5 class="fw-bold text-success">Butuh Bantuan Cepat?</h5>
                                    <p class="text-muted mb-0">Tim farmasi kami siap membantu Anda 24/7! Pilih kontak yang
                                        tersedia:</p>
                                </div>

                                <!-- WhatsApp Contacts -->
                                <div class="contact-list">
                                    <a href="https://wa.me/+6281292936247"
                                        class="d-flex align-items-center p-2 mb-2 text-decoration-none border rounded hover-effect">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 35px; height: 35px;">
                                                <i class="bi bi-whatsapp text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 text-dark">Abdi Sugeng Pangestu</h6>
                                            <small class="text-muted">+62 812-9293-6247</small>
                                        </div>
                                        <i class="bi bi-chevron-right text-muted"></i>
                                    </a>

                                    <a href="https://wa.me/+6281243983318"
                                        class="d-flex align-items-center p-2 mb-2 text-decoration-none border rounded hover-effect">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 35px; height: 35px;">
                                                <i class="bi bi-whatsapp text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 text-dark">Adinda Putri Ibdaniya</h6>
                                            <small class="text-muted">+62 812-4398-3318</small>
                                        </div>
                                        <i class="bi bi-chevron-right text-muted"></i>
                                    </a>

                                    <a href="https://wa.me/+6281271954082"
                                        class="d-flex align-items-center p-2 mb-2 text-decoration-none border rounded hover-effect">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 35px; height: 35px;">
                                                <i class="bi bi-whatsapp text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 text-dark">Enzelika</h6>
                                            <small class="text-muted">+62 812-7195-4082</small>
                                        </div>
                                        <i class="bi bi-chevron-right text-muted"></i>
                                    </a>

                                    <a href="https://wa.me/+6282286438701"
                                        class="d-flex align-items-center p-2 mb-3 text-decoration-none border rounded hover-effect">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 35px; height: 35px;">
                                                <i class="bi bi-whatsapp text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 text-dark">Febby Trianingsih</h6>
                                            <small class="text-muted">+62 822-8643-8701</small>
                                        </div>
                                        <i class="bi bi-chevron-right text-muted"></i>
                                    </a>
                                </div>

                                <div class="text-center mb-4">
                                    <small class="text-muted"><i class="bi bi-clock me-1"></i>Respon cepat dalam 1-24
                                        jam</small>
                                </div>

                                <hr class="my-4">
                                <h5 class="fw-bold text-center mb-3">Ikuti Kami</h5>
                                <div class="d-flex justify-content-center gap-3">
                                    <a class="social-icon" href="https://wa.me/+6281292936247" target="_blank"><i
                                            class="bi bi-whatsapp"></i></a>
                                    <a class="social-icon" href="https://www.instagram.com/klikfarmasi.official/"
                                        target="_blank"><i class="bi bi-instagram"></i></a>
                                    <a class="social-icon" href="https://www.tiktok.com/@klikfarmasi.official"
                                        target="_blank"><i class="bi bi-tiktok"></i></a>
                                    <a class="social-icon" href="mailto:klikfarmasi.official@gmail.com"><i
                                            class="bi bi-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
