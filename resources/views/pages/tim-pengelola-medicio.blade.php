@extends('layouts.medicio')

@section('title', 'Tim Pengelola - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Kenali tim pengelola Klik Farmasi dari tim farmasi Universitas Alma Ata. Dosen pembimbing dan mahasiswa yang mengelola platform kesehatan digital.">
    <meta name="keywords"
        content="tim klik farmasi, mahasiswa farmasi UAA, dosen pembimbing, universitas alma ata, tim pengembang">
    <meta name="author" content="Tim Farmasi Universitas Alma Ata">

    <!-- Custom CSS minimal untuk penyesuaian -->
    <style>
        .team-member {
            background: #fff;
            border-radius: 5px;
            text-align: center;
            padding: 30px;
            box-shadow: 0 4px 16px rgba(33, 37, 41, 0.1);
            transition: 0.3s;
            height: 100%;
            min-height: 350px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .team-member:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(33, 37, 41, 0.15);
        }

        .team-member img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            object-position: top;
            margin: 0 auto 15px;
            border: 4px solid #f1f1f1;
            transition: 0.3s;
            cursor: pointer;
            display: block;
        }

        .team-member:hover img {
            border-color: var(--accent-color);
        }

        .team-member h4 {
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 18px;
            color: #2c4964;
        }

        .team-member span {
            font-style: italic;
            display: block;
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .team-member p {
            font-size: 14px;
            font-style: italic;
            color: #6c757d;
            margin: 0;
            flex-grow: 1;
        }

        .team-member .social {
            margin-top: 15px;
            display: flex;
            opacity: 1;
            visibility: visible;
            justify-content: center;
            transform: translateY(0);
            transition: none;
            position: relative;
            z-index: 1;
        }

        /* Remove hover behavior - always show social icons */
        .team-member:hover .social {
            display: flex;
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .team-member .social a {
            background: #f1f1f1;
            color: #2c4964;
            line-height: 1;
            border-radius: 50%;
            text-align: center;
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
            margin: 0 3px;
        }

        .team-member .social a:hover {
            background: var(--accent-color);
            color: #fff;
        }

        .mission-list {
            list-style: none;
            padding: 0;
        }

        .mission-list li {
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
            text-align: justify;
            /* Add justify text */
        }

        .mission-list li:last-child {
            border-bottom: none;
        }

        .mission-number {
            background: transparent;
            /* Remove background */
            color: #2c4964;
            /* Same color as other text */
            width: 25px;
            height: 25px;
            /* Add border instead */
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            margin-right: 15px;
        }

        /* About section text alignment */
        .about .content p {
            text-align: justify;
            line-height: 1.7;
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
                        <h1>Tim Pengelola Klik Farmasi</h1>
                        <p class="mb-0">Kenali tim mahasiswa dan dosen Farmasi Universitas Alma Ata yang mengelola
                            platform kesehatan digital ini</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="current">Tim Pengelola</li>
                </ol>
            </div>
        </nav>
    </div>
    <!-- End Page Title -->

    <!-- Gallery Section -->
    <section id="gallery" class="gallery section light-background">
        <div class="container section-title" data-aos="fade-up">
            <h2>Dokumentasi Kegiatan</h2>
            <p>Galeri dokumentasi kegiatan penelitian dan pengabdian masyarakat tim Klik Farmasi</p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 600,
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": "auto",
                  "centeredSlides": true,
                  "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                  },
                  "breakpoints": {
                    "320": {
                      "slidesPerView": 1,
                      "spaceBetween": 0
                    },
                    "768": {
                      "slidesPerView": 3,
                      "spaceBetween": 20
                    },
                    "1200": {
                      "slidesPerView": 5,
                      "spaceBetween": 20
                    }
                  }
                }
                </script>
                <div class="swiper-wrapper align-items-center">
                    <!-- Dokumentasi kegiatan tim Klik Farmasi -->
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('assets/gallery/dokumentasi-1.webp') }}"><img
                                src="{{ asset('assets/gallery/dokumentasi-1.webp') }}" class="img-fluid"
                                alt="Dokumentasi Kegiatan 1"></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('assets/gallery/dokumentasi-2.webp') }}"><img
                                src="{{ asset('assets/gallery/dokumentasi-2.webp') }}" class="img-fluid"
                                alt="Dokumentasi Kegiatan 2"></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('assets/gallery/dokumentasi-3.webp') }}"><img
                                src="{{ asset('assets/gallery/dokumentasi-3.webp') }}" class="img-fluid"
                                alt="Dokumentasi Kegiatan 3"></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('assets/gallery/dokumentasi-4.webp') }}"><img
                                src="{{ asset('assets/gallery/dokumentasi-4.webp') }}" class="img-fluid"
                                alt="Dokumentasi Kegiatan 4"></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('assets/gallery/dokumentasi-5.webp') }}"><img
                                src="{{ asset('assets/gallery/dokumentasi-5.webp') }}" class="img-fluid"
                                alt="Dokumentasi Kegiatan 5"></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('assets/gallery/dokumentasi-6.webp') }}"><img
                                src="{{ asset('assets/gallery/dokumentasi-6.webp') }}" class="img-fluid"
                                alt="Dokumentasi Kegiatan 6"></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('assets/gallery/dokumentasi-7.webp') }}"><img
                                src="{{ asset('assets/gallery/dokumentasi-7.webp') }}" class="img-fluid"
                                alt="Dokumentasi Kegiatan 7"></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('assets/gallery/dokumentasi-8.webp') }}"><img
                                src="{{ asset('assets/gallery/dokumentasi-8.webp') }}" class="img-fluid"
                                alt="Dokumentasi Kegiatan 8"></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('assets/gallery/dokumentasi-9.webp') }}"><img
                                src="{{ asset('assets/gallery/dokumentasi-9.webp') }}" class="img-fluid"
                                alt="Dokumentasi Kegiatan 9"></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('assets/gallery/dokumentasi-10.webp') }}"><img
                                src="{{ asset('assets/gallery/dokumentasi-10.webp') }}" class="img-fluid"
                                alt="Dokumentasi Kegiatan 10"></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('assets/gallery/dokumentasi-11.webp') }}"><img
                                src="{{ asset('assets/gallery/dokumentasi-11.webp') }}" class="img-fluid"
                                alt="Dokumentasi Kegiatan 11"></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('assets/gallery/dokumentasi-12.webp') }}"><img
                                src="{{ asset('assets/gallery/dokumentasi-12.webp') }}" class="img-fluid"
                                alt="Dokumentasi Kegiatan 12"></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('assets/gallery/dokumentasi-13.webp') }}"><img
                                src="{{ asset('assets/gallery/dokumentasi-13.webp') }}" class="img-fluid"
                                alt="Dokumentasi Kegiatan 13"></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('assets/gallery/dokumentasi-14.webp') }}"><img
                                src="{{ asset('assets/gallery/dokumentasi-14.webp') }}" class="img-fluid"
                                alt="Dokumentasi Kegiatan 14"></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('assets/gallery/dokumentasi-15.webp') }}"><img
                                src="{{ asset('assets/gallery/dokumentasi-15.webp') }}" class="img-fluid"
                                alt="Dokumentasi Kegiatan 15"></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('assets/gallery/dokumentasi-16.webp') }}"><img
                                src="{{ asset('assets/gallery/dokumentasi-16.webp') }}" class="img-fluid"
                                alt="Dokumentasi Kegiatan 16"></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('assets/gallery/dokumentasi-17.webp') }}"><img
                                src="{{ asset('assets/gallery/dokumentasi-17.webp') }}" class="img-fluid"
                                alt="Dokumentasi Kegiatan 17"></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('assets/gallery/dokumentasi-18.webp') }}"><img
                                src="{{ asset('assets/gallery/dokumentasi-18.webp') }}" class="img-fluid"
                                alt="Dokumentasi Kegiatan 18"></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('assets/gallery/dokumentasi-19.webp') }}"><img
                                src="{{ asset('assets/gallery/dokumentasi-19.webp') }}" class="img-fluid"
                                alt="Dokumentasi Kegiatan 19"></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('assets/gallery/dokumentasi-20.webp') }}"><img
                                src="{{ asset('assets/gallery/dokumentasi-20.webp') }}" class="img-fluid"
                                alt="Dokumentasi Kegiatan 20"></a></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about section">

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                    <p>Klik Farmasi merupakan platform asuhan kefarmasian yang dikelola oleh dosen dan mahasiswa Program
                        Studi
                        S1 Farmasi Universitas Alma Ata sebagai wujud kontribusi dalam bidang pendidikan, penelitian, dan
                        pengabdian masyarakat. Saat ini Klik Farmasi fokus pada edukasi penyakit tidak menular, khususnya
                        hipertensi, melalui penyediaan informasi dan fitur pengingat minum obat, guna membantu pengelolaan
                        kesehatan masyarakat Indonesia.</p>

                    <h3>Visi</h3>
                    <p class="fst-italic">
                        Menjadi platform edukasi kesehatan digital terdepan berbasis riset, yang berkontribusi pada upaya
                        pencegahan dan pengelolaan penyakit tidak menular (NCDs), khususnya hipertensi, serta mendukung
                        pencapaian Universitas Alma Ata sebagai teaching research university berdaya saing global.
                    </p>
                </div>
                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
                    <h3>Misi</h3>
                    <ul class="mission-list">
                        <li>
                            <span class="mission-number">1</span>
                            Menyediakan informasi kesehatan berbasis bukti (evidence-based) yang akurat, mudah dipahami, dan
                            dapat diakses oleh semua kalangan masyarakat.
                        </li>
                        <li>
                            <span class="mission-number">2</span>
                            Mengembangkan dan mengimplementasikan fitur-fitur inovatif untuk membantu pasien dalam
                            pengelolaan
                            hipertensi dan penyakit tidak menular lainnya.
                        </li>
                        <li>
                            <span class="mission-number">3</span>
                            Mendorong kolaborasi antara sivitas akademika dan masyarakat guna menghasilkan solusi kesehatan
                            yang
                            aplikatif dan responsif terhadap isu kesehatan nasional.
                        </li>
                        <li>
                            <span class="mission-number">4</span>
                            Mendukung aktivitas pendidikan, penelitian, dan pengabdian Program Studi S1 Farmasi Universitas
                            Alma
                            Ata untuk kebermanfaatan masyarakat luas.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Supervisors Section -->
    <section id="doctors" class="doctors section light-background">
        <div class="container section-title" data-aos="fade-up">
            <h2>Tim Pembimbing</h2>
            <p>Dosen pembimbing dan programmer website Klik Farmasi</p>
        </div>

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="team-member">
                        <img src="{{ asset('assets/tim/Foto Dosen apt.Nurul Kusumawardani.jpg') }}"
                            alt="Apt. Nurul Kusumawardani, M.farm" class="img-fluid clickable-image">
                        <h4>Apt. Nurul Kusumawardani, M.farm</h4>
                        <span>Dosen Pembimbing I</span>
                        <div class="social">
                            <a href="https://www.linkedin.com/in/nurul-kusumawardani-3623b2135/" target="_blank">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="mailto:nurul.kusumawardani@almaata.ac.id">
                                <i class="bi bi-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="team-member">
                        <img src="{{ asset('assets/tim/Foto Dosen apt.Danang Prasetyaning Amukti.jpeg') }}"
                            alt="apt. Danang Prasetyaning Amukti, M.Farm" class="img-fluid clickable-image">
                        <h4>apt. Danang Prasetyaning Amukti, M.Farm</h4>
                        <span>Dosen Pembimbing II</span>
                        <div class="social">
                            <a href="https://www.linkedin.com/in/danang-prasetya-a48076173/" target="_blank">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="mailto:danangpa@almaata.ac.id">
                                <i class="bi bi-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="team-member">
                        <img src="{{ asset('assets/tim/Aizan.jpg') }}" alt="Aizan Syalim"
                            class="img-fluid clickable-image">
                        <h4>Aizan Syalim</h4>
                        <span>Programmer Website</span>
                        <div class="social">
                            <a href="https://www.instagram.com/zansylm/" target="_blank">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="mailto:223200231@almaata.ac.id">
                                <i class="bi bi-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Students Team Section -->
    <section id="students" class="doctors section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Tim Mahasiswa</h2>
            <p>Mahasiswa farmasi yang aktif mengelola website Klik Farmasi</p>
        </div>

        <div class="container">
            <div class="row gy-4">
                @php
                    $teamMembers = [
                        [
                            'name' => 'Abdi Sugeng Pangestu',
                            'id' => '220500396',
                            'photo' => 'assets/tim/Farmasi Abdi Sugeng P_BG merah.jpeg',
                        ],
                        [
                            'name' => 'Zona Aulia Nafaza',
                            'id' => '220500571',
                            'photo' => 'assets/tim/Farmasi_Zona Aulia Nafaza.jpg',
                        ],
                        [
                            'name' => 'Luri Pijria Diningsih',
                            'id' => '220500534',
                            'photo' => 'assets/tim/Farmasi_Luri pijria.JPG',
                        ],
                        [
                            'name' => 'Desti Nadia',
                            'id' => '220500420',
                            'photo' => 'assets/tim/Farmasi_Desti Nadia.JPG',
                        ],
                        [
                            'name' => 'Yulia Mita Widyaningrum',
                            'id' => '220500511',
                            'photo' => 'assets/tim/Farmasi_Yulia mita.jpg',
                        ],
                        [
                            'name' => 'Febby Trianingsih',
                            'id' => '220500526',
                            'photo' => 'assets/tim/Farmasi_Febby Trianingsih.JPG',
                        ],
                        [
                            'name' => 'Adinda Putri Ibdaniya',
                            'id' => '220500402',
                            'photo' => 'assets/tim/Farmasi_Adindaputriibdaniya.jpg',
                        ],
                        [
                            'name' => 'Enzelika',
                            'id' => '220500429',
                            'photo' => 'assets/tim/Farmasi_Enzelika.jpg',
                        ],
                        [
                            'name' => 'Nia Uswatun Khasanah',
                            'id' => '220500470',
                            'photo' => 'assets/tim/Farmasi_Nia Uswatun Khasanah.jpg',
                        ],
                        [
                            'name' => 'Camelia Rohayya C. Barus',
                            'id' => '210500345',
                            'photo' => 'assets/tim/Farmasi_Camelia.JPG',
                        ],
                        [
                            'name' => 'Deswita Vira Adzani',
                            'id' => '220500421',
                            'photo' => 'assets/tim/Farmasi_Deswita Vira Adzani PNG.png',
                        ],
                        [
                            'name' => 'Elda Samsudin',
                            'id' => '220500428',
                            'photo' => 'assets/tim/Farmasi_Elda Samsudin.png',
                        ],
                    ];
                @endphp

                @foreach ($teamMembers as $index => $member)
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                        <div class="team-member">
                            <img src="{{ asset($member['photo']) }}" alt="{{ $member['name'] }}"
                                class="img-fluid clickable-image">
                            <h4>{{ $member['name'] }}</h4>
                            <span>{{ $member['id'] }}</span>
                            <p>Mahasiswa Farmasi</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>



    <!-- Call to Action Section -->
    <section id="call-to-action" class="call-to-action section accent-background">
        <div class="container">
            <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                <div class="col-xl-10">
                    <div class="text-center">
                        <h3>Bergabung Dengan Tim Kami</h3>
                        <p>Tertarik bergabung dengan tim Klik Farmasi? Hubungi kami untuk informasi lebih lanjut tentang
                            kontribusi dalam bidang kesehatan digital.</p>
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <a href="mailto:nurul.kusumawardani@almaata.ac.id" class="cta-btn">Kontak Pembimbing</a>
                            <a href="https://wa.me/+6281292936247" class="cta-btn">WhatsApp Tim</a>
                        </div>
                    </div>
                </div>
            </div>
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

            console.log('Halaman Tim Pengelola (Medicio Template) siap!');
        });
    </script>
@endpush
