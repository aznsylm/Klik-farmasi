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
                                <div class="faq-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                                    <h2 class="faq-header" id="heading{{ $loop->index }}">
                                        <button class="faq-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}"
                                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                            aria-controls="collapse{{ $loop->index }}">
                                            <span class="question-number">{{ $loop->iteration }}</span>
                                            <span class="question-text">{{ $faq->question }}</span>
                                            <i class="bi bi-chevron-down toggle-icon"></i>
                                        </button>
                                    </h2>
                                    <div class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                        id="collapse{{ $loop->index }}" aria-labelledby="heading{{ $loop->index }}"
                                        data-bs-parent="#accordionHipertensiKehamilan">
                                        <div class="faq-answer">
                                            <p class="answer-text">{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- FAQ Styles -->
                        <style>
                        .faq-item {
                            background: #ffffff;
                            border: 1px solid #e9ecef;
                            margin-bottom: 15px;
                            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
                            transition: all 0.3s ease;
                        }
                        
                        .faq-item:hover {
                            transform: translateY(-2px);
                            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
                        }
                        
                        .faq-header {
                            margin: 0;
                        }
                        
                        .faq-button {
                            background: #0B5E91;
                            color: white;
                            border: none;
                            padding: 20px 25px;
                            width: 100%;
                            text-align: left;
                            display: flex;
                            align-items: center;
                            gap: 15px;
                            font-weight: 600;
                            font-size: 1rem;
                            transition: all 0.3s ease;
                        }
                        
                        .faq-button:hover {
                            background: #083d5c;
                            color: white;
                        }
                        
                        .faq-button:focus {
                            box-shadow: none;
                            background: #083d5c;
                            color: white;
                        }
                        
                        .question-number {
                            background: rgba(255,255,255,0.2);
                            color: white;
                            width: 30px;
                            height: 30px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-weight: bold;
                            font-size: 0.9rem;
                            flex-shrink: 0;
                        }
                        
                        .question-text {
                            flex-grow: 1;
                            line-height: 1.4;
                        }
                        
                        .toggle-icon {
                            transition: transform 0.3s ease;
                            font-size: 1.2rem;
                        }
                        
                        .faq-button:not(.collapsed) .toggle-icon {
                            transform: rotate(180deg);
                        }
                        
                        .faq-answer {
                            padding: 25px;
                            background: #f8f9fa;
                            border-top: 2px solid #0B5E91;
                        }
                        
                        .answer-text {
                            color: #2c3e50;
                            font-size: 1rem;
                            line-height: 1.7;
                            text-align: justify;
                            margin: 0;
                        }
                        
                        /* Responsive */
                        @media (max-width: 768px) {
                            .faq-button {
                                padding: 15px 20px;
                                font-size: 0.95rem;
                            }
                            
                            .faq-answer {
                                padding: 20px;
                            }
                            
                            .question-number {
                                width: 25px;
                                height: 25px;
                                font-size: 0.8rem;
                            }
                        }
                        </style>
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
                                <div class="mb-4">
                                    <h5 class="fw-bold text-success">Butuh Bantuan Cepat?</h5>
                                    <p class="text-muted mb-0">Tim farmasi kami siap membantu Anda 24/7! Pilih kontak yang tersedia:</p>
                                </div>
                                
                                <!-- WhatsApp Contacts -->
                                <div class="contact-list">
                                    <a href="https://wa.me/+6281292936247" class="d-flex align-items-center p-2 mb-2 text-decoration-none border rounded hover-effect" style="transition: all 0.3s ease;">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                <i class="bi bi-whatsapp text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 text-dark">Abdi Sugeng Pangestu</h6>
                                            <small class="text-muted">+62 812-9293-6247</small>
                                        </div>
                                        <i class="bi bi-chevron-right text-muted"></i>
                                    </a>
                                    
                                    <a href="https://wa.me/+6281243983318" class="d-flex align-items-center p-2 mb-2 text-decoration-none border rounded hover-effect" style="transition: all 0.3s ease;">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                <i class="bi bi-whatsapp text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 text-dark">Adinda Putri Ibdaniya</h6>
                                            <small class="text-muted">+62 812-4398-3318</small>
                                        </div>
                                        <i class="bi bi-chevron-right text-muted"></i>
                                    </a>
                                    
                                    <a href="https://wa.me/+6281271954082" class="d-flex align-items-center p-2 mb-2 text-decoration-none border rounded hover-effect" style="transition: all 0.3s ease;">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                <i class="bi bi-whatsapp text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 text-dark">Enzelika</h6>
                                            <small class="text-muted">+62 812-7195-4082</small>
                                        </div>
                                        <i class="bi bi-chevron-right text-muted"></i>
                                    </a>
                                    
                                    <a href="https://wa.me/+6282286438701" class="d-flex align-items-center p-2 mb-3 text-decoration-none border rounded hover-effect" style="transition: all 0.3s ease;">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
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
                                    <small class="text-muted"><i class="bi bi-clock me-1"></i>Respon cepat dalam 1-24 jam</small>
                                </div>
                                
                                <hr class="my-4">
                                <h5 class="fw-bold text-center mb-3">Ikuti Kami</h5>
                                <div class="d-flex justify-content-center gap-3">
                                    <a class="social-icon" href="https://wa.me/+6281292936247" target="_blank"><i class="bi bi-whatsapp"></i></a>
                                    <a class="social-icon" href="https://www.instagram.com/klikfarmasi.official/" target="_blank"><i class="bi bi-instagram"></i></a>
                                    <a class="social-icon" href="https://www.tiktok.com/@klikfarmasi.official" target="_blank"><i class="bi bi-tiktok"></i></a>
                                    <a class="social-icon" href="mailto:klikfarmasi.official@gmail.com"><i class="bi bi-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                        
                        <style>
                        .hover-effect:hover {
                            background-color: #f8f9fa !important;
                            transform: translateY(-2px);
                            box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important;
                        }
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
