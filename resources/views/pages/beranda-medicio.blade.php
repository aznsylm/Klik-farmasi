@extends('layouts.medicio')
@section('title', 'Beranda - Klik Farmasi (Medicio Template)')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Platform kesehatan digital untuk manajemen hipertensi. Dapatkan pengingat minum obat, artikel kesehatan terpercaya, dan konsultasi gratis dari Universitas Alma Ata.">
    <meta name="keywords"
        content="hipertensi, pengingat obat, kesehatan, farmasi, universitas alma ata, manajemen hipertensi, artikel kesehatan">
    <meta name="author" content="Klik Farmasi - Universitas Alma Ata">
@endpush

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">

        <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

            <div class="carousel-item active">
                <img src="{{ asset('assets/hero1.webp') }}" alt="Klik Farmasi Hero 1">
                <div class="container">
                    <h2>Selamat Datang di Klik Farmasi</h2>
                    <p>Platform digital untuk manajemen hipertensi yang membantu Anda mengelola tekanan darah tinggi dengan
                        lebih mudah dan efektif. Dapatkan pengingat minum obat, artikel kesehatan terpercaya, dan konsultasi
                        dari ahli farmasi.</p>
                    <a href="{{ route('pengingat') }}" class="btn-get-started">Mulai Pengingat Obat</a>
                </div>
            </div><!-- End Carousel Item -->

            <div class="carousel-item">
                <img src="{{ asset('assets/hero2.webp') }}" alt="Klik Farmasi Hero 2">
                <div class="container">
                    <h2>Kelola Hipertensi Dengan Mudah</h2>
                    <p>Temukan informasi lengkap tentang hipertensi, tips gaya hidup sehat, dan panduan pengelolaan tekanan
                        darah tinggi dari tim farmasi Universitas Alma Ata yang berpengalaman.</p>
                    <a href="{{ route('artikel.non-kehamilan') }}" class="btn-get-started">Baca Artikel</a>
                </div>
            </div><!-- End Carousel Item -->

            <div class="carousel-item">
                <img src="{{ asset('assets/hero3.webp') }}" alt="Klik Farmasi Hero 3">
                <div class="container">
                    <h2>Konsultasi & Tanya Jawab</h2>
                    <p>Punya pertanyaan seputar hipertensi? Tim farmasi kami siap membantu menjawab pertanyaan Anda melalui
                        platform tanya jawab yang mudah diakses kapan saja.</p>
                    <a href="{{ route('tanya-jawab.non-kehamilan') }}" class="btn-get-started">Tanya Sekarang</a>
                </div>
            </div><!-- End Carousel Item -->

            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

            <ol class="carousel-indicators"></ol>

        </div>

    </section>
    <!-- /Hero Section -->

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">

        <div class="container">

            <div class="row gy-4">

                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-alarm icon"></i></div>
                        <h4><a href="{{ route('pengingat') }}" class="stretched-link">Pengingat Obat</a></h4>
                        <p>Atur jadwal minum obat hipertensi dengan sistem pengingat otomatis via WhatsApp</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-journal-medical icon"></i></div>
                        <h4><a href="{{ route('artikel.non-kehamilan') }}" class="stretched-link">Artikel Kesehatan</a></h4>
                        <p>Informasi terpercaya seputar hipertensi dari ahli farmasi Universitas Alma Ata</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-chat-dots icon"></i></div>
                        <h4><a href="{{ route('tanya-jawab.non-kehamilan') }}" class="stretched-link">Tanya Jawab</a></h4>
                        <p>Konsultasi gratis dengan tim farmasi untuk pertanyaan seputar hipertensi</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-download icon"></i></div>
                        <h4><a href="{{ route('unduhan') }}" class="stretched-link">Materi Edukasi</a></h4>
                        <p>Download gratis poster, panduan, dan materi edukasi hipertensi</p>
                    </div>
                </div><!-- End Service Item -->

            </div>

        </div>

    </section>
    <!-- /Featured Services Section -->

    <!-- About Section -->
    <section id="about" class="about section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Tentang Klik Farmasi</h2>
            <p>Platform kesehatan digital yang dikembangkan khusus untuk membantu pengelolaan hipertensi</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">
                <div class="col-lg-4 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('assets/Klik-Farmasi.webp') }}" class="img-fluid" alt="Tentang Klik Farmasi">
                </div>
                <div class="col-lg-8 content" data-aos="fade-up" data-aos-delay="200">
                    <h3>Hidup Anda Berharga - Lindungi Sekarang!</h3>
                    <p class="fst-italic">
                        Setiap penderita hipertensi berhak mendapat perawatan terbaik. Saatnya Anda mengambil kendali!
                    </p>
                    <ul>
                        <li><i class="bi bi-check2-all"></i> <span>Pengingat minum obat otomatis via WhatsApp</span></li>
                        <li><i class="bi bi-check2-all"></i> <span>Pencatatan dan pemantauan tekanan darah berkala</span>
                        </li>
                        <li><i class="bi bi-check2-all"></i> <span></span>Artikel kesehatan dari ahli farmasi
                            berpengalaman</span>
                        </li>
                        <li><i class="bi bi-check2-all"></i> <span>Konsultasi gratis dan mudah diakses</span></li>
                        <li><i class="bi bi-check2-all"></i> <span>Materi edukasi lengkap untuk pengelolaan
                                hipertensi</span></li>
                    </ul>
                    <p>
                        Dikelola oleh tim farmasi Universitas Alma Ata dengan fokus pada peningkatan kualitas
                        hidup penderita hipertensi melalui teknologi digital yang mudah digunakan.
                    </p>
                </div>
            </div>

        </div>

    </section>
    <!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="bi bi-people flex-shrink-0"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="100" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Pengguna Aktif</p>
                        </div>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="bi bi-journal-medical flex-shrink-0"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="25" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Artikel Kesehatan</p>
                        </div>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="bi bi-alarm flex-shrink-0"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="5000" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Pengingat Terkirim</p>
                        </div>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="bi bi-chat-heart flex-shrink-0"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="30" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Testimoni Positif</p>
                        </div>
                    </div>
                </div><!-- End Stats Item -->

            </div>
        </div>
    </section>
    <!-- /Stats Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Layanan Kami</h2>
            <p>Berbagai layanan kesehatan digital untuk membantu pengelolaan hipertensi Anda</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="fas fa-pills"></i>
                        </div>
                        <a href="{{ route('pengingat') }}" class="stretched-link">
                            <h3>Manajemen Obat</h3>
                        </a>
                        <p>Kelola jadwal minum obat hipertensi dengan pengingat otomatis dan tracking konsumsi obat harian
                        </p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <a href="{{ route('artikel.non-kehamilan') }}" class="stretched-link">
                            <h3>Edukasi Kesehatan</h3>
                        </a>
                        <p>Artikel dan materi edukasi terpercaya tentang hipertensi dari ahli farmasi Universitas Alma Ata
                        </p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <a href="{{ route('tanya-jawab.non-kehamilan') }}" class="stretched-link">
                            <h3>Konsultasi Online</h3>
                        </a>
                        <p>Tanya jawab langsung dengan tim farmasi untuk mendapatkan solusi masalah hipertensi Anda</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <a href="{{ route('artikel.kehamilan') }}" class="stretched-link">
                            <h3>Hipertensi Kehamilan</h3>
                        </a>
                        <p>Informasi khusus untuk ibu hamil dengan hipertensi termasuk preeklampsia dan pengelolaannya</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="fas fa-download"></i>
                        </div>
                        <a href="{{ route('unduhan') }}" class="stretched-link">
                            <h3>Materi Download</h3>
                        </a>
                        <p>Download gratis poster, panduan, dan materi edukasi hipertensi untuk pembelajaran mandiri</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('tim-pengelola') }}" class="stretched-link">
                            <h3>Tim Ahli</h3>
                        </a>
                        <p>Kenali tim farmasi Universitas Alma Ata yang mengelola platform dan siap membantu Anda</p>
                    </div>
                </div><!-- End Service Item -->

            </div>

        </div>

    </section>
    <!-- /Services Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-4 info" data-aos="fade-up" data-aos-delay="100">
                    <h3>Testimoni Pengguna</h3>
                    <p>
                        Dengarkan pengalaman nyata dari pengguna Klik Farmasi yang telah merasakan manfaatnya dalam
                        mengelola hipertensi.
                    </p>
                </div>

                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">

                    <div class="swiper init-swiper">
                        <script type="application/json" class="swiper-config">
                    {
                    "loop": true,
                    "speed": 600,
                    "autoplay": {
                        "delay": 5000
                    },
                    "slidesPerView": "auto",
                    "pagination": {
                        "el": ".swiper-pagination",
                        "type": "bullets",
                        "clickable": true
                    }
                    }
                    </script>
                        <div class="swiper-wrapper">

                            @forelse($testimonials as $testimonial)
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="testimonial-header">
                                            <h3>{{ $testimonial->name }}</h3>
                                            <h4>{{ $testimonial->profession ?? 'Pengguna' }}</h4>
                                            <div class="stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="testimonial-quote-wrapper">
                                            <i class="bi bi-quote quote-icon-left"></i>
                                            <span>{!! $testimonial->quote !!}</span>
                                            <i class="bi bi-quote quote-icon-right"></i>
                                        </div>
                                    </div>
                                </div><!-- End testimonial item -->
                            @empty
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="testimonial-header">
                                            <h3>Sari Wahyuni</h3>
                                            <h4>Pengguna</h4>
                                            <div class="stars">
                                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                    class="bi bi-star-fill"></i>
                                            </div>
                                        </div>
                                        <div class="testimonial-quote-wrapper">
                                            <i class="bi bi-quote quote-icon-left"></i>
                                            <span>Klik Farmasi sangat membantu saya mengingat jadwal minum obat hipertensi.
                                                Sekarang tekanan darah saya lebih terkontrol.</span>
                                            <i class="bi bi-quote quote-icon-right"></i>
                                        </div>
                                    </div>
                                </div><!-- End testimonial item -->
                            @endforelse

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- /Testimonials Section -->

    <!-- Recent Blog Posts Section -->
    <section id="recent-posts" class="recent-posts section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Artikel Terbaru</h2>
            <p>Informasi kesehatan terkini seputar hipertensi dari tim farmasi Universitas Alma Ata</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                @forelse($articles as $article)
                    <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 + 100 }}">
                        <article class="blog-card">

                            <div class="post-img">
                                <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('assets/sample-1.jpg') }}"
                                    alt="{{ $article->title }}" class="img-fluid">
                            </div>

                            <div class="blog-content">
                                <p class="post-category">{{ $article->category ?? 'Hipertensi' }}</p>

                                <h2 class="title">
                                    <a
                                        href="{{ route($article->article_type === 'kehamilan' ? 'artikel.detail.kehamilan' : 'artikel.detail.non-kehamilan', $article->slug) }}">{{ $article->title }}</a>
                                </h2>

                                <div class="d-flex align-items-center">
                                    <div class="post-meta">
                                        <p class="post-author">Tim Farmasi UAA</p>
                                        <p class="post-date">
                                            <time
                                                datetime="{{ $article->created_at->format('Y-m-d') }}">{{ $article->created_at->format('d M Y') }}</time>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </article>
                    </div><!-- End post list item -->
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Belum ada artikel tersedia.</p>
                    </div>
                @endforelse

            </div>

        </div>

    </section>
    <!-- /Recent Blog Posts Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Tanya Jawab</h2>

            <div class="container">

                <div class="row justify-content-center">

                    <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

                        <div class="faq-container">

                            @forelse($faqs as $index => $faq)
                                <div class="faq-item {{ $index === 0 ? 'faq-active' : '' }}">
                                    <h3>{{ $faq->question }}</h3>
                                    <div class="faq-content">
                                        <p>{!! $faq->answer !!}</p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div><!-- End Faq item-->
                            @empty
                                <div class="faq-item faq-active">
                                    <h3>Apa itu Klik Farmasi?</h3>
                                    <div class="faq-content">
                                        <p>Klik Farmasi adalah platform kesehatan digital yang dikembangkan khusus untuk
                                            membantu pengelolaan hipertensi melalui sistem pengingat obat, artikel
                                            kesehatan,
                                            dan konsultasi dengan tim farmasi.</p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div><!-- End Faq item-->

                                <div class="faq-item">
                                    <h3>Bagaimana cara menggunakan pengingat obat?</h3>
                                    <div class="faq-content">
                                        <p>Anda dapat mengatur jadwal minum obat melalui formulir pengingat di website.
                                            Sistem
                                            akan mengirimkan notifikasi via WhatsApp sesuai jadwal yang Anda tentukan.</p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div><!-- End Faq item-->

                                <div class="faq-item">
                                    <h3>Apakah layanan konsultasi berbayar?</h3>
                                    <div class="faq-content">
                                        <p>Tidak, semua layanan konsultasi dan tanya jawab di platform Klik Farmasi tersedia
                                            secara gratis untuk membantu pengelolaan hipertensi Anda.</p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div><!-- End Faq item-->
                            @endforelse

                        </div>

                    </div><!-- End Faq Column-->

                </div>

            </div>

    </section><!-- /Faq Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Kontak</h2>

            <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.7283658691113!2d110.32211627484463!3d-7.818550292202166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7af7e2b2acea97%3A0xa3cb91d3e65407b2!2sUniversitas%20Alma%20Ata%20Yogyakarta!5e0!3m2!1sid!2sid!4v1769938446606!5m2!1sid!2sid" width="1250" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div><!-- End Google Maps -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">
                    <div class="col-lg-6 ">
                        <div class="row gy-4">
                            <div class="col-md-12">
                                <div class="info-item text-center" data-aos="fade" data-aos-delay="200">
                                    <i class="bi bi-geo-alt"></i>
                                    <h3>Alamat</h3>
                                    <p>Jl. Brawijaya No.99, Jadan</p>
                                    <p>Tamantirto, Kec. Kasihan</p>
                                    <p>Kabupaten Bantul, DIY 55183</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item text-center" data-aos="fade" data-aos-delay="300">
                                    <i class="bi bi-telephone"></i>
                                    <h3>Telepon</h3>
                                    <p>+62 852 8090 9235</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item text-center" data-aos="fade" data-aos-delay="400">
                                    <i class="bi bi-envelope"></i>
                                    <h3>Email</h3>
                                    <p>klikfarmasi.official@gmail.com</p>
                                </div>
                            </div><!-- End Info Item -->

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <form id="contactForm" class="php-email-form" data-aos="fade-up" data-aos-delay="500">
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Nama Anda"
                                        required="">
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email" placeholder="Email Anda"
                                        required="">
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subjek"
                                        required="">
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Pesan" required=""></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Memuat...</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Pesan Anda akan dikirim ke WhatsApp Klik Farmasi. Terima
                                        kasih!
                                    </div>

                                    <button type="submit">Kirim Pesan</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>

            </div>

    </section><!-- /Contact Section -->

@endsection

@push('scripts')
    <script>
        // Custom JavaScript untuk halaman beranda medicio jika diperlukan
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Halaman Beranda Medicio Template siap!');

            // Handle contact form submission to WhatsApp
            const contactForm = document.getElementById('contactForm');
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const name = this.name.value;
                    const email = this.email.value;
                    const subject = this.subject.value;
                    const message = this.message.value;

                    // Format WhatsApp message
                    const whatsappMessage =
                        `*Pesan dari Website Klik Farmasi*%0A%0A*Nama:* ${name}%0A*Email:* ${email}%0A*Subject:* ${subject}%0A*Pesan:* ${message}`;

                    // WhatsApp number for Klik Farmasi
                    const whatsappNumber = '6285280909235'; // Nomor WhatsApp Klik Farmasi

                    // Open WhatsApp with pre-filled message
                    window.open(`https://wa.me/${whatsappNumber}?text=${whatsappMessage}`, '_blank');

                    // Show success message
                    this.querySelector('.sent-message').style.display = 'block';

                    // Reset form
                    this.reset();

                    // Hide success message after 3 seconds
                    setTimeout(() => {
                        this.querySelector('.sent-message').style.display = 'none';
                    }, 3000);
                });
            }
        });
    </script>
@endpush

@push('head')
    <style>
        /* Custom styling untuk blog cards */
        .blog-card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .blog-card .post-img {
            position: relative;
            overflow: hidden;
            height: 200px;
        }

        .blog-card .post-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .blog-card:hover .post-img img {
            transform: scale(1.05);
        }

        .blog-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .blog-card .post-category {
            background: #0b5e91;
            color: #ffffff;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 15px;
            width: fit-content;
        }

        .blog-card .title {
            margin-bottom: 15px;
            flex-grow: 1;
        }

        .blog-card .title a {
            color: #2c3e50;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 700;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .blog-card .title a:hover {
            color: #0b5e91;
        }

        .blog-card .post-meta {
            margin-top: auto;
        }

        .blog-card .post-author,
        .blog-card .post-date {
            margin: 0;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .blog-card .post-author {
            font-weight: 600;
            color: #0b5e91;
        }

        /* Center icon di contact info */
        .info-item i {
            font-size: 2rem;
            color: #0b5e91;
            margin-bottom: 10px;
            display: block;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .blog-card .post-img {
                height: 180px;
            }

            .blog-content {
                padding: 15px;
            }

            .blog-card .title a {
                font-size: 1rem;
            }
        }
    </style>
@endpush
