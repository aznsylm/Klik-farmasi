@extends('layouts.app')

@section('title', 'Tanya Jawab')

@section('content')
    <section class="py-5 faq-section">
        <div class="container px-4">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <h1 class="fw-bolder">Pertanyaan yang Sering Diajukan</h1>
                <p class="text-muted mx-auto" style="max-width: 700px;">
                    Temukan jawaban untuk pertanyaan umum tentang hipertensi dan pengobatannya
                </p>
            </div>

            <div class="row gx-5">
                <!-- FAQ Content -->
                <div class="col-lg-8">
                    <!-- Search Bar -->
                    <div class="faq-search mb-5">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" id="faqSearch" class="form-control border-start-0" placeholder="Cari pertanyaan...">
                        </div>
                    </div>

                    <!-- FAQ Categories Navigation -->
                    <div class="faq-categories mb-4">
                        <ul class="nav nav-pills" id="faqCategories">
                            <li class="nav-item">
                                <a class="nav-link active" href="#tentang-hipertensi">Tentang Hipertensi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#pentingnya-minum-obat">Pentingnya Minum Obat</a>
                            </li>
                        </ul>
                    </div>

                    <!-- FAQ Accordion 1: Tentang Hipertensi -->
                    <div class="faq-group mb-5" id="tentang-hipertensi">
                        <div class="faq-group-header">
                            <h2 class="fw-bold">
                                <i class="bi bi-heart-pulse me-2"></i>
                                Tentang Hipertensi
                            </h2>
                            <p class="text-muted">Informasi dasar tentang hipertensi dan penanganannya</p>
                        </div>
                        <div class="accordion custom-accordion" id="accordionHipertensi">
                            @foreach ($faqs->where('category', 'Tentang Hipertensi') as $faq)
                                <div class="accordion-item">
                                    <h3 class="accordion-header" id="heading{{ $loop->index }}">
                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse{{ $loop->index }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h3>
                                    <div class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" id="collapse{{ $loop->index }}" aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordionHipertensi">
                                        <div class="accordion-body">
                                            <p>{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- FAQ Accordion 2: Pentingnya Minum Obat -->
                    <div class="faq-group mb-5" id="pentingnya-minum-obat">
                        <div class="faq-group-header">
                            <h2 class="fw-bold">
                                <i class="bi bi-capsule me-2"></i>
                                Pentingnya Minum Obat
                            </h2>
                            <p class="text-muted">Informasi tentang pengobatan hipertensi dan kepatuhan minum obat</p>
                        </div>
                        <div class="accordion custom-accordion" id="accordionObat">
                            @foreach ($faqs->where('category', 'Pentingnya Minum Obat') as $faq)
                                <div class="accordion-item">
                                    <h3 class="accordion-header" id="headingObat{{ $loop->index }}">
                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseObat{{ $loop->index }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapseObat{{ $loop->index }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h3>
                                    <div class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" id="collapseObat{{ $loop->index }}" aria-labelledby="headingObat{{ $loop->index }}" data-bs-parent="#accordionObat">
                                        <div class="accordion-body">
                                            <p>{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Still Have Questions -->
                    <div class="still-have-questions text-center p-4 rounded-4">
                        <h3 class="fw-bold mb-3">Masih Punya Pertanyaan?</h3>
                        <p class="mb-4">Jika Anda tidak menemukan jawaban yang Anda cari, jangan ragu untuk menghubungi kami.</p>
                        <a href="mailto:support@klikfarmasi.com" class="btn btn-khusus">
                            <i class="bi bi-envelope me-2"></i> Hubungi Kami
                        </a>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 2rem; z-index: 1000;">
                        <!-- Quick Help Card -->
                        <div class="card border-0 rounded-4 shadow-sm mb-4">
                            <div class="card-header text-white py-3 border-0" style="background-color: #0b5e91;">
                                <h5 class="mb-0 fw-bold" style="color: #fff"><i class="bi bi-info-circle me-2"></i> Bantuan Cepat</h5>
                            </div>
                            <div class="card-body p-4">
                                <p class="card-text">Temukan jawaban cepat untuk pertanyaan umum tentang hipertensi dan pengobatannya.</p>
                                <div class="quick-links">
                                    <a href="#tentang-hipertensi" class="quick-link">
                                        <i class="bi bi-heart-pulse"></i>
                                        <span>Apa itu hipertensi?</span>
                                    </a>
                                    <a href="#pentingnya-minum-obat" class="quick-link">
                                        <i class="bi bi-capsule"></i>
                                        <span>Mengapa harus rutin minum obat?</span>
                                    </a>
                                    <a href="#tentang-hipertensi" class="quick-link">
                                        <i class="bi bi-activity"></i>
                                        <span>Gejala hipertensi</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Card -->
                        <div class="card border-0 rounded-4 shadow-sm">
                            <div class="card-body p-4">
                                <div class="text-center mb-4">
                                    <div class="icon-circle bg-primary text-white mx-auto mb-3">
                                        <i class="bi bi-chat-dots-fill"></i>
                                    </div>
                                    <h5 class="fw-bold">Punya Pertanyaan?</h5>
                                    <p class="text-muted mb-0">Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan atau membutuhkan bantuan.</p>
                                </div>
                                <a href="mailto:support@klikfarmasi.com" class="btn btn-primary w-100 mb-3">
                                    <i class="bi bi-envelope me-2"></i> Email Kami
                                </a>
                                <a href="https://wa.me/1234567890" class="btn btn-success w-100">
                                    <i class="bi bi-whatsapp me-2"></i> WhatsApp
                                </a>
                                
                                <hr class="my-4">
                                
                                <h5 class="fw-bold text-center mb-3">Ikuti Kami</h5>
                                <div class="d-flex justify-content-center gap-3">
                                    <a class="social-icon" href="https://wa.me/1234567890" target="_blank">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                    <a class="social-icon" href="https://instagram.com/klikfarmasi" target="_blank">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                    <a class="social-icon" href="https://tiktok.com/@klikfarmasi" target="_blank">
                                        <i class="bi bi-tiktok"></i>
                                    </a>
                                    <a class="social-icon" href="mailto:support@klikfarmasi.com">
                                        <i class="bi bi-envelope"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* FAQ Section Styling */
        .faq-section {
            background-color: #f8f9fa;
            background-image: radial-gradient(#0d6efd10 1px, transparent 1px);
            background-size: 20px 20px;
        }
        
        /* Header Icon */
        .faq-icon {
            width: 80px;
            height: 80px;
            background-color: #0b5e91;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-size: 2.5rem;
        }
        
        /* Search Bar */
        .faq-search .input-group {
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            border-radius: 50px;
            overflow: hidden;
        }
        
        .faq-search .input-group-text,
        .faq-search .form-control {
            border-color: #e9ecef;
            padding: 0.75rem 1.25rem;
        }
        
        .faq-search .form-control:focus {
            box-shadow: none;
        }
        
        /* FAQ Categories */
        .faq-categories {
            overflow-x: auto;
            white-space: nowrap;
            padding-bottom: 5px;
        }
        
        .faq-categories .nav-pills {
            display: inline-flex;
        }
        
        .faq-categories .nav-link {
            color: #495057;
            background-color: #f8f9fa;
            border-radius: 50px;
            padding: 0.5rem 1.25rem;
            margin-right: 0.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .faq-categories .nav-link:hover {
            background-color: #e9ecef;
        }
        
        .faq-categories .nav-link.active {
            background-color: #0b5e91;
            color: white;
        }
        
        /* FAQ Group */
        .faq-group {
            background-color: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .faq-group-header {
            margin-bottom: 1.5rem;
        }
        
        /* Custom Accordion */
        .custom-accordion .accordion-item {
            border: none;
            background-color: transparent;
            margin-bottom: 1rem;
        }
        
        .custom-accordion .accordion-button {
            background-color: #f8f9fa;
            border-radius: 8px !important;
            font-weight: 600;
            padding: 1.25rem;
            color: #212529;
            box-shadow: none;
        }
        
        .custom-accordion .accordion-button:not(.collapsed) {
            background-color: #0b5e91;
            color: white;
        }
        
        .custom-accordion .accordion-button:focus {
            box-shadow: none;
        }
        
        .custom-accordion .accordion-button::after {
            background-size: 1.25rem;
            width: 1.25rem;
            height: 1.25rem;
        }
        
        .custom-accordion .accordion-body {
            padding: 1.5rem;
            background-color: #f8f9fa;
            border-radius: 0 0 8px 8px;
            font-size: 1rem;
            line-height: 1.7;
        }
        
        /* Still Have Questions */
        .still-have-questions {
            background-color: #e9f2ff;
            border-left: 5px solid #0b5e91;
        }
        
        /* Quick Links */
        .quick-links {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        
        .quick-link {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            background-color: #f8f9fa;
            border-radius: 8px;
            color: #212529;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        
        .quick-link:hover {
            background-color: #e9ecef;
            transform: translateX(5px);
        }
        
        .quick-link i {
            margin-right: 0.75rem;
            color: #0b5e91;
            font-size: 1.1rem;
        }
        
        /* Social Icons */
        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #f8f9fa;
            color: #0b5e91;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .social-icon:hover {
            background-color: #0b5e91;
            color: white;
            transform: translateY(-3px);
        }
        
        /* Icon Circle */
        .icon-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .faq-group {
                padding: 1.5rem;
            }
            
            .custom-accordion .accordion-button {
                padding: 1rem;
                font-size: 0.95rem;
            }
            
            .custom-accordion .accordion-body {
                padding: 1rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.getElementById('faqSearch');
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const searchTerm = this.value.toLowerCase();
                    const accordionItems = document.querySelectorAll('.accordion-item');
                    
                    accordionItems.forEach(item => {
                        const question = item.querySelector('.accordion-button').textContent.toLowerCase();
                        const answer = item.querySelector('.accordion-body').textContent.toLowerCase();
                        
                        if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            }
            
            // Smooth scroll for category links
            const categoryLinks = document.querySelectorAll('.nav-link, .quick-link');
            categoryLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    // Hanya preventDefault jika href diawali dengan #
                    if (href && href.startsWith('#')) {
                        e.preventDefault();
                        const targetElement = document.querySelector(href);
                        if (targetElement) {
                            window.scrollTo({
                                top: targetElement.offsetTop - 100,
                                behavior: 'smooth'
                            });
                            // Update active class for nav pills
                            if (this.classList.contains('nav-link')) {
                                document.querySelectorAll('.nav-link').forEach(navLink => {
                                    navLink.classList.remove('active');
                                });
                                this.classList.add('active');
                            }
                        }
                    }
                    // Jika bukan anchor (#), biarkan link berjalan normal
                });
            });
        });
    </script>
@endsection