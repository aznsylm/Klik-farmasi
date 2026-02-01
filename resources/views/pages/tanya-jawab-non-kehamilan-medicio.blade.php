@extends('layouts.medicio')

@section('title', 'Tanya Jawab Hipertensi Non-Kehamilan - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description"
        content="FAQ dan tanya jawab seputar hipertensi umum. Dapatkan jawaban dari ahli farmasi tentang obat hipertensi, gaya hidup sehat, dan tips pengelolaan tekanan darah tinggi.">
    <meta name="keywords"
        content="FAQ hipertensi, tanya jawab tekanan darah tinggi, obat hipertensi, konsultasi farmasi, tips kesehatan">
    <meta name="author" content="Tim Farmasi Universitas Alma Ata">

    <!-- Custom CSS for FAQ Medicio Style -->
    <style>
        .faq {
            padding: 60px 0;
        }

        .faq-container .faq-item {
            position: relative;
            padding: 20px;
            margin-bottom: 15px;
            background: #fff;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .faq-container .faq-item h3 {
            font-size: 16px;
            line-height: 24px;
            margin: 0 30px 0 0;
            font-weight: 700;
            color: #1e3c72;
            cursor: pointer;
        }

        .faq-container .faq-item .faq-content {
            display: none;
            padding: 20px 0 0 0;
        }

        .faq-container .faq-item .faq-content p {
            color: #6c757d;
            line-height: 24px;
        }

        .faq-container .faq-item .faq-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 16px;
            line-height: 24px;
            cursor: pointer;
            color: #1e3c72;
            transition: transform 0.3s;
        }

        .faq-container .faq-item.faq-active .faq-content {
            display: block;
        }

        .faq-container .faq-item.faq-active .faq-toggle {
            transform: rotate(90deg);
            color: #2a5298;
        }

        .quick-help-card {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .contact-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 25px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            background: #f8f9fa;
            text-decoration: none;
            color: #2c3e50;
            transition: all 0.3s ease;
        }

        .contact-item:hover {
            background: #e9ecef;
            transform: translateY(-2px);
            color: #2c3e50;
        }

        .contact-icon {
            width: 40px;
            height: 40px;
            background: #25d366;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 15px;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .social-link {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link.whatsapp {
            background: #25d366;
        }

        .social-link.instagram {
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
        }

        .social-link.tiktok {
            background: #000;
        }

        .social-link.email {
            background: #ea4335;
        }

        .social-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
    </style>
@endpush

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Tanya Jawab Hipertensi</h1>
                        <p class="mb-0">Temukan jawaban untuk pertanyaan umum tentang hipertensi dari tim farmasi
                            Universitas Alma Ata</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="current">Tanya Jawab Hipertensi</li>
                </ol>
            </div>
        </nav>
    </div>
    <!-- End Page Title -->

    <!-- Main Content -->
    <section id="faq" class="faq section light-background">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">
                    <div class="faq-container">
                        @php
                            $perPage = 10;
                            $currentPage = request()->get('page', 1);
                            $offset = ($currentPage - 1) * $perPage;
                            $paginatedFaqs = $faqs->slice($offset, $perPage);
                            $totalPages = ceil($faqs->count() / $perPage);
                        @endphp

                        @if ($paginatedFaqs->count() > 0)
                            @foreach ($paginatedFaqs as $index => $faq)
                                <div class="faq-item {{ $index == 0 ? 'faq-active' : '' }}">
                                    <h3>{!! $faq->question !!}</h3>
                                    <div class="faq-content">
                                        <p>{!! $faq->answer !!}</p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div><!-- End FAQ item-->
                            @endforeach
                        @else
                            <div class="faq-item">
                                <h3>Belum ada FAQ tersedia</h3>
                                <div class="faq-content">
                                    <p>Saat ini belum ada pertanyaan yang sering diajukan untuk kategori hipertensi
                                        non-kehamilan. Tim kami sedang menyiapkan konten FAQ yang bermanfaat untuk Anda.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Pagination -->
                    @if ($totalPages > 1)
                        <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
                            <nav aria-label="FAQ Pagination">
                                <ul class="pagination">
                                    @if ($currentPage > 1)
                                        <li class="page-item">
                                            <a class="page-link" href="?page={{ $currentPage - 1 }}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    @endif

                                    @for ($i = 1; $i <= $totalPages; $i++)
                                        <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                            <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    @if ($currentPage < $totalPages)
                                        <li class="page-item">
                                            <a class="page-link" href="?page={{ $currentPage + 1 }}" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
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
                </div><!-- End Faq Column-->
            </div>
        </div>
    </section><!-- /FAQ Section -->

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 800,
                once: true
            });

            console.log('Halaman FAQ Hipertensi Non-Kehamilan (Medicio) siap!');
            console.log('FAQ items found:', document.querySelectorAll('.faq-item').length);
        });
    </script>
@endpush
