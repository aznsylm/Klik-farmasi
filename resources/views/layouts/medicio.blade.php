<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'Klik Farmasi - Medicio Template')</title>
    <meta name="description" content="@yield('description', 'Platform kesehatan digital untuk manajemen hipertensi')">
    <meta name="keywords" content="@yield('keywords', 'hipertensi, pengingat obat, kesehatan, farmasi')">

    <!-- Favicons -->
    <link href="{{ asset('assets/Favicon.png') }}" rel="icon" type="image/webp">
    <link href="{{ asset('assets/Favicon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('medicio/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('medicio/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('medicio/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('medicio/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('medicio/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('medicio/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('medicio/css/main.css') }}" rel="stylesheet">

    <!-- Klik Farmasi Custom Colors -->
    <style>
        :root {
            --accent-color: #0b5e91;
            --contrast-color: #ffffff;
        }

        /* Header styling */
        .header .topbar {
            background-color: #baa971;
            color: #ffffff;
        }

        /* Mobile responsive untuk topbar phone */
        @media (max-width: 768px) {
            .topbar .d-flex span {
                font-size: 0.75rem;
            }
        }

        /* Topbar dropdown styling */
        .header .topbar .dropdown-toggle::after {
            color: #ffffff;
        }

        .header .topbar .dropdown-menu {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .header .topbar .dropdown-item {
            color: #2c3e50;
            padding: 8px 16px;
        }

        .header .topbar .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #0b5e91;
        }

        .header .branding {
            background-color: #0b5e91;
            color: #ffffff;
        }

        .header .branding .navmenu a {
            color: #ffffff;
        }

        .header .branding .navmenu a:hover {
            color: #e3f2fd;
        }

        .header .branding .cta-btn {
            background-color: #baa971;
            color: #ffffff;
            border-color: #baa971;
        }

        .header .branding .cta-btn:hover {
            background-color: #a89660;
            border-color: #a89660;
        }

        /* Footer styling */
        #footer {
            background-color: #0b5e91;
            color: #ffffff;
        }

        #footer .footer-top {
            background-color: #0b5e91;
        }

        #footer h4,
        #footer .sitename {
            color: #ffffff;
        }

        #footer a {
            color: #ffffff;
        }

        #footer a:hover {
            color: #e3f2fd;
        }

        /* Primary buttons */
        .btn-primary,
        .cta-btn,
        .btn-get-started {
            background-color: #0b5e91;
            border-color: #0b5e91;
            color: #ffffff;
        }

        .btn-primary:hover,
        .cta-btn:hover,
        .btn-get-started:hover {
            background-color: #094a75;
            border-color: #094a75;
        }

        /* Section titles */
        .section-title h2 {
            color: #0b5e91;
        }

        /* Service items accent */
        .service-item .icon i {
            color: #0b5e91;
        }

        /* Navigation active state */
        .navmenu a.active {
            color: #0b5e91;
        }

        /* Desktop submenu styling - override white text */
        .navmenu .dropdown ul a {
            color: #2c3e50 !important;
        }

        .navmenu .dropdown ul a:hover,
        .navmenu .dropdown ul .active:hover,
        .navmenu .dropdown ul li:hover>a {
            color: #0b5e91 !important;
        }

        /* Custom styling for logout button in dropdown */
        .navmenu .dropdown ul .dropdown-item {
            width: 100%;
            color: #2c3e50 !important;
            text-align: left;
            transition: color 0.3s ease;
            border: none;
            background: transparent;
            padding: 10px 20px;
            cursor: pointer;
        }

        .navmenu .dropdown ul .dropdown-item:hover {
            color: #0b5e91 !important;
            background-color: transparent;
        }

        /* Profile dropdown styling */
        .navmenu .dropdown ul a i {
            width: 20px;
        }

        /* Mobile navigation styling */
        @media (max-width: 1199px) {
            .navmenu {
                background-color: #ffffff;
            }

            .navmenu a {
                color: #2c3e50 !important;
            }

            .navmenu a:hover {
                color: #0b5e91 !important;
            }

            .navmenu .dropdown ul {
                background-color: #ffffff;
            }

            .navmenu .dropdown ul a {
                color: #2c3e50 !important;
            }

            /* Hide desktop CTA button on mobile */
            .cta-btn {
                display: none;
            }

            /* Style mobile CTA button */
            .mobile-cta {
                margin-top: 10px;
                padding-top: 10px;
                border-top: 1px solid #e9ecef;
            }

            .cta-btn-mobile {
                background-color: #baa971;
                color: #ffffff;
                padding: 10px 20px;
                border-radius: 25px;
                text-decoration: none;
                font-weight: 600;
                display: block;
                text-align: center;
                margin: 10px 0;
            }

            .cta-btn-mobile:hover {
                background-color: #a89660;
                color: #ffffff;
            }
        }
    </style>

    @stack('head')
</head>

<body class="index-page">

    <header id="header" class="header sticky-top">

        <div class="topbar d-flex align-items-center">
            <div class="container d-flex justify-content-center justify-content-md-between">
                <div class="d-none d-md-flex align-items-center">
                    <i class="bi bi-clock me-1"></i> Konsultasi Tenaga Kesehatan 24 Jam
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span><i class="bi bi-phone me-1"></i> Hubungi kami: +62 852-8090-9235</span>

                    @auth
                        <!-- Menu profil untuk user yang sudah login -->
                        <div class="dropdown">
                            <a href="#" class="text-white text-decoration-none dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <!-- Menu login untuk user yang belum login -->
                        <a href="{{ route('login') }}" class="text-white text-decoration-none">Login</a>
                    @endauth
                </div>
            </div>
        </div><!-- End Top Bar -->

        <div class="branding d-flex align-items-center">

            <div class="container position-relative d-flex align-items-center justify-content-end">
                <a href="{{ route('beranda') }}" class="logo d-flex align-items-center me-auto">
                    <img src="{{ asset('assets/LOGO KLIKFARMASI VEKTOR MIRING.png') }}" alt="Klik Farmasi"
                        style="height: 50px;">
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="{{ route('beranda') }}"
                                class="{{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a></li>
                        <li class="dropdown">
                            <a href="#"><span>Artikel</span> <i
                                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="{{ route('artikel.non-kehamilan') }}">Hipertensi Non-Kehamilan</a></li>
                                <li><a href="{{ route('artikel.kehamilan') }}">Hipertensi Kehamilan</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#"><span>Tanya Jawab</span> <i
                                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="{{ route('tanya-jawab.non-kehamilan') }}">Hipertensi Non-Kehamilan</a>
                                </li>
                                <li><a href="{{ route('tanya-jawab.kehamilan') }}">Hipertensi Kehamilan</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('unduhan') }}"
                                class="{{ request()->routeIs('unduhan') ? 'active' : '' }}">Unduhan</a></li>
                        <li><a href="{{ route('berita') }}"
                                class="{{ request()->routeIs('berita') ? 'active' : '' }}">Berita</a></li>
                        <li><a href="{{ route('petunjuk') }}"
                                class="{{ request()->routeIs('petunjuk') ? 'active' : '' }}">Petunjuk</a></li>
                        <li><a href="{{ route('tim-pengelola') }}"
                                class="{{ request()->routeIs('tim-pengelola') ? 'active' : '' }}">Tim</a></li>

                        <li class="mobile-cta d-xl-none"><a href="{{ route('pengingat') }}" class="cta-btn-mobile">Buat
                                Pengingat</a></li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>

                @auth
                    <!-- CTA Button untuk user login - bisa ke dashboard -->
                    <a class="cta-btn" href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <!-- CTA Button untuk user belum login -->
                    <a class="cta-btn" href="{{ route('pengingat') }}">Buat Pengingat</a>
                @endauth

            </div>

        </div>

    </header>

    <main class="main">
        @yield('content')
    </main>

    <footer id="footer" class="footer light-background">

        <div class="container footer-top">
            <div class="row gy-3">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="{{ route('beranda') }}" class="logo d-flex align-items-center">
                        <img src="{{ asset('assets/LOGO KLIKFARMASI VEKTOR MIRING.png') }}" alt="Klik Farmasi"
                            style="height: 45px;">
                    </a>
                    <div class="footer-contact pt-2">
                        <p class="mb-1">Program Studi Farmasi</p>
                        <p class="mb-2">Universitas Alma Ata</p>
                        <p class="mb-1"><strong>Phone:</strong> <span>+62 852-8090-9235</span></p>
                        <p class="mb-2"><strong>Email:</strong> <span>klikfarmasi.official@gmail.com</span></p>
                    </div>
                    <div class="social-links d-flex mt-2">
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Menu Utama</h4>
                    <ul>
                        <li><a href="{{ route('beranda') }}">Beranda</a></li>
                        <li><a href="{{ route('pengingat') }}">Pengingat Obat</a></li>
                        <li><a href="{{ route('artikel.non-kehamilan') }}">Artikel</a></li>
                        <li><a href="{{ route('tanya-jawab.non-kehamilan') }}">Tanya Jawab</a></li>
                        <li><a href="{{ route('unduhan') }}">Unduhan</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Konten</h4>
                    <ul>
                        <li><a href="{{ route('artikel.non-kehamilan') }}">Hipertensi Non-Kehamilan</a></li>
                        <li><a href="{{ route('artikel.kehamilan') }}">Hipertensi Kehamilan</a></li>
                        <li><a href="{{ route('tanya-jawab.non-kehamilan') }}">FAQ Non-Kehamilan</a></li>
                        <li><a href="{{ route('tanya-jawab.kehamilan') }}">FAQ Kehamilan</a></li>
                        <li><a href="{{ route('tim-pengelola') }}">Tim Pengelola</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12 footer-newsletter">
                    <h4>Tentang Klik Farmasi</h4>
                    <p>Platform digital untuk manajemen hipertensi yang dikelola oleh tim farmasi
                        Universitas Alma Ata. Sistem ini membantu pasien dalam pengelolaan tekanan darah tinggi
                        dan digunakan di Puskesmas Kalasan, Godean, dan Umbulharjo.</p>
                    <div class="mt-3">
                        <h6 class="mb-2" style="color: #fff">Fitur Utama:</h6>
                        <ul class="list-unstyled small">
                            <li><i class="bi bi-check-circle text-white me-2"></i>Pengingat Minum Obat</li>
                            <li><i class="bi bi-check-circle text-white me-2"></i>Monitoring Tekanan Darah</li>
                            <li><i class="bi bi-check-circle text-white me-2"></i>Edukasi Hipertensi</li>
                            <li><i class="bi bi-check-circle text-white me-2"></i>Konsultasi Online</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center py-3">
            <p class="mb-1">© <span>Copyright</span> <strong class="px-1 sitename">Klik Farmasi</strong> <span>All
                    Rights
                    Reserved</span></p>
            <div class="credits small">
                Developed by <a href="https://www.instagram.com/zansylm/">Aizan Syalim</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('medicio/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('medicio/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('medicio/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('medicio/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('medicio/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('medicio/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('medicio/js/main.js') }}"></script>

    @stack('scripts')

</body>

</html>
