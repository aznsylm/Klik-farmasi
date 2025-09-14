<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Platform edukasi hipertensi dan pengingat obat dari Universitas Alma Ata. Dapatkan informasi kesehatan terpercaya dan kelola jadwal minum obat Anda.">
    <meta name="keywords"
        content="hipertensi, pengingat obat, kesehatan, farmasi, universitas alma ata, edukasi kesehatan">
    <meta name="author" content="Klik Farmasi - Universitas Alma Ata">
    <meta name="robots" content="index, follow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Klik Farmasi')</title>

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('title', 'Klik Farmasi')">
    <meta property="og:description" content="Platform edukasi hipertensi dan pengingat obat dari Universitas Alma Ata">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('assets/LOGO KLIKFARMASI VEKTOR MIRING.png') }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Klik Farmasi')">
    <meta name="twitter:description" content="Platform edukasi hipertensi dan pengingat obat dari Universitas Alma Ata">
    <meta name="twitter:image" content="{{ asset('assets/LOGO KLIKFARMASI VEKTOR MIRING.png') }}">

    <!-- Performance hints -->
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//unpkg.com">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">

    <!-- Critical CSS Inline for FCP Optimization -->
    <style>
        /* Critical Above-the-Fold Styles */
        .container-fluid {
            width: 100%;
            padding-right: var(--bs-gutter-x, .75rem);
            padding-left: var(--bs-gutter-x, .75rem);
            margin-right: auto;
            margin-left: auto
        }

        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1*var(--bs-gutter-y));
            margin-right: calc(-.5*var(--bs-gutter-x));
            margin-left: calc(-.5*var(--bs-gutter-x))
        }

        .col-12 {
            flex: 0 0 auto;
            width: 100%
        }

        .justify-content-center {
            justify-content: center !important
        }

        .position-relative {
            position: relative !important
        }

        .overflow-hidden {
            overflow: hidden !important
        }

        .revolutionary-hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative
        }

        .hero-background-new {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #0b5e91 0%, #1a6fa0 50%, #baa971 100%);
            z-index: 1
        }

        .hero-overlay-new {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, .3);
            z-index: 2
        }

        .hero-visual-section {
            position: relative;
            z-index: 3
        }

        .clean-carousel-wrapper {
            position: relative;
            max-width: 100%;
            margin: 0 auto
        }

        .carousel {
            position: relative
        }

        .carousel-inner {
            position: relative;
            width: 100%;
            overflow: hidden
        }

        .carousel-item {
            position: relative;
            display: none;
            float: left;
            width: 100%;
            margin-right: -100%;
            backface-visibility: hidden;
            transition: transform .6s ease-in-out
        }

        .carousel-item.active {
            display: block
        }

        .clean-slide-wrapper {
            position: relative;
            width: 100%;
            height: 60vh;
            min-height: 400px;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .3)
        }

        .clean-slide-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            border-radius: 20px;
            will-change: transform;
            transform: translateZ(0);
            backface-visibility: hidden
        }

        @media (min-width:992px) {
            .col-lg-11 {
                flex: 0 0 auto;
                width: 91.66666667%
            }

            .col-xl-10 {
                flex: 0 0 auto;
                width: 83.33333333%
            }

            .px-lg-4 {
                padding-right: 1.5rem !important;
                padding-left: 1.5rem !important
            }
        }
    </style>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/Favicon.png') }}">
    <!-- Bootstrap Icons - Deferred -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"
        media="print" onload="this.media='all'">
    <!-- Font El Messiri & Open Sans - Preload -->
    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link
            href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap"
            rel="stylesheet">
    </noscript>
    <!-- Bootstrap CSS - Critical -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CDN AOS - Deferred -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" media="print" onload="this.media='all'">
    <!-- Icon Mata - Deferred -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"
        media="print" onload="this.media='all'">
    <!-- Main CSS - Optimized -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://unpkg.com">

    <!-- DNS prefetch for external resources -->
    <link rel="dns-prefetch" href="//wa.me">
    <link rel="dns-prefetch" href="//instagram.com">
    <link rel="dns-prefetch" href="//tiktok.com">
    <link rel="dns-prefetch" href="//maps.google.com">

    <!-- Page Specific Head Content -->
    @stack('head')
</head>

<body class="d-flex flex-column h-100">
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Main Content -->
    <main class="flex-shrink-0">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Button Kembali ke Atas -->
    <button id="backToTop" class="btn btn-primary rounded-circle shadow-lg">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- Button WhatsApp -->
    <a href="https://wa.me/+6285280909235" target="_blank" id="whatsappButton"
        class="btn btn-success rounded-circle shadow-lg">
        <i class="bi bi-whatsapp"></i>
    </a>



    <!-- CDN AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                once: true,
            });
        });
    </script>

    <!-- Bootstrap Core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <!-- Main JS - Unified JavaScript -->
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Page Specific Scripts -->
    @stack('scripts')
</body>

</html>
