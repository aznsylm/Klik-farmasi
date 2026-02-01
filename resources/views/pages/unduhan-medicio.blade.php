@extends('layouts.medicio')

@section('title', 'Unduhan Materi Kesehatan - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Download gratis materi edukasi hipertensi, poster kesehatan, dan panduan pengelolaan tekanan darah tinggi dari ahli farmasi Universitas Alma Ata.">
    <meta name="keywords"
        content="download materi hipertensi, poster kesehatan, edukasi hipertensi, materi farmasi, panduan kesehatan">
    <meta name="author" content="Tim Farmasi Universitas Alma Ata">

    <!-- Custom CSS for Downloads - Services Style -->
    <style>
        .services {
            padding: 60px 0;
        }

        .service-item {
            background: #fff;
            padding: 40px 30px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 16px rgba(33, 37, 41, 0.1);
            transition: all 0.3s ease-in-out;
            height: 100%;
            position: relative;
        }

        .service-item:hover {
            box-shadow: 0 8px 25px rgba(33, 37, 41, 0.15);
            transform: translateY(-5px);
        }

        .service-item .thumbnail {
            width: 150px;
            height: 150px;
            border-radius: 12px;
            object-fit: cover;
            margin: 0 auto 20px;
            display: block;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .service-item:hover .thumbnail {
            transform: scale(1.08);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .service-item h3 {
            color: #2c4964;
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 1.2rem;
            line-height: 1.4;
        }

        .service-item .description {
            color: #6c757d;
            line-height: 1.6;
            font-size: 0.95rem;
            margin-bottom: 25px;
        }

        .download-btn {
            background: #3498db;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .download-btn:hover {
            background: #2980b9;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        }

        .empty-downloads {
            background: white;
            padding: 60px 30px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .empty-downloads i {
            font-size: 3.5rem;
            color: #dee2e6;
            margin-bottom: 20px;
        }

        /* Image modal styles */
        .image-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            cursor: pointer;
        }

        .image-modal img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            border-radius: 10px;
        }

        .image-modal.active {
            display: flex;
        }

        .close-modal {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            z-index: 10000;
        }

        .close-modal:hover {
            color: #ccc;
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
                        <h1>Unduhan Materi Kesehatan</h1>
                        <p class="mb-0">Dapatkan materi edukasi tentang hipertensi untuk meningkatkan kesadaran dan
                            kesehatan Anda secara gratis</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="current">Unduhan Materi</li>
                </ol>
            </div>
        </nav>
    </div>
    <!-- End Page Title -->

    <!-- Services/Downloads Section -->
    <section id="services" class="services section light-background">
        <div class="container">
            <div class="row gy-4">
                @forelse ($downloads as $download)
                    <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 + 100 }}">
                        <div class="service-item">
                            @if ($download->image)
                                <img src="{{ asset('storage/' . $download->image) }}" alt="{{ $download->title }}"
                                    class="thumbnail clickable-image" loading="lazy">
                            @endif

                            <h3>{{ $download->title }}</h3>

                            <p class="description">
                                {{ Str::words(strip_tags($download->description), 20, '...') }}
                            </p>

                            <a href="{{ route('download.track', $download->id) }}" target="_blank" class="download-btn">
                                <i class="bi bi-download me-2"></i>
                                Download
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-downloads" data-aos="fade-up">
                            <i class="bi bi-file-earmark-x"></i>
                            <h4 class="text-muted">Belum Ada Materi Tersedia</h4>
                            <p class="text-muted">Materi edukasi akan segera tersedia. Silakan kembali lagi nanti.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($downloads->hasPages())
                <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
                    {{ $downloads->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </section>

    <!-- Image Modal untuk preview foto -->
    <div id="imageModal" class="image-modal">
        <span class="close-modal">&times;</span>
        <img id="modalImage" src="" alt="">
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 800,
                once: true
            });

            // Image modal functionality
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const closeModal = document.querySelector('.close-modal');
            const clickableImages = document.querySelectorAll('.clickable-image');

            // Add click event to all clickable images
            clickableImages.forEach(function(img) {
                img.addEventListener('click', function() {
                    modal.classList.add('active');
                    modalImage.src = this.src;
                    modalImage.alt = this.alt;
                });
            });

            // Close modal when clicking X
            closeModal.addEventListener('click', function() {
                modal.classList.remove('active');
            });

            // Close modal when clicking outside image
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.remove('active');
                }
            });

            // Close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.classList.contains('active')) {
                    modal.classList.remove('active');
                }
            });

            // Initialize PureCounter for stats
            const counters = document.querySelectorAll('[data-purecounter-start]');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-purecounter-end'));
                const duration = parseInt(counter.getAttribute('data-purecounter-duration')) * 1000;
                let current = 0;
                const increment = target / (duration / 50);

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    counter.textContent = Math.floor(current);
                }, 50);
            });

            console.log('Halaman Unduhan Materi (Medicio) siap!');
        });
    </script>
@endpush
