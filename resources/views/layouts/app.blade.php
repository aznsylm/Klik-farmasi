<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Platform edukasi hipertensi dan pengingat obat dari Universitas Alma Ata. Dapatkan informasi kesehatan terpercaya dan kelola jadwal minum obat Anda.">
    <meta name="keywords" content="hipertensi, pengingat obat, kesehatan, farmasi, universitas alma ata, edukasi kesehatan">
    <meta name="author" content="Klik Farmasi - Universitas Alma Ata">
    <meta name="robots" content="index, follow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/Favicon.png') }}">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font El Messiri & Open Sans -->
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CDN AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" media="print" onload="this.media='all'">
    <!-- Icon Mata -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" media="print" onload="this.media='all'">
    <!-- Pages CSS -->
    <link href="{{ asset('css/pages.css') }}" rel="stylesheet">
    <!-- Footer CSS -->
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
    <!-- Responsive CSS -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <!-- Performance CSS -->
    <link href="{{ asset('css/performance.css') }}" rel="stylesheet">
    
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
    <a href="https://wa.me/+6285280909235" target="_blank" id="whatsappButton" class="btn btn-success rounded-circle shadow-lg">
        <i class="bi bi-whatsapp"></i>
    </a>
    
    <style>
        h1, h2, h3 {
            font-family: 'El Messiri', sans-serif;
            color: #baa971;
        }

        h4, h5 {
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
            color: #595959;
        }

        p {
            font-family: 'Open Sans', sans-serif;
            font-size: 14px;
            line-height: 1.7;
            letter-spacing: 0.3px;
            color: #a4a4a4;
            margin-bottom: 10px;
        }

        .btn-khusus {
            background-color: #0b5e91;
            color: white;
            font-family: 'Open Sans', sans-serif;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            transition: background-color 0.3s ease;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-khusus:hover {
            background-color: #094d7a;
            border-color: #094d7a;
            color: white;
        }

        .btn-khusus:focus {
            background-color: #094d7a;
            border-color: #094d7a;
            color: white;
            box-shadow: 0 0 0 0.2rem rgba(11, 94, 145, 0.25);
        }

        /* Styling Floating Buttons */
        #backToTop {
            position: fixed;
            bottom: 100px;
            right: 30px;
            z-index: 1050;
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #0b5e91;
            color: white;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
        }
        
        #backToTop.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        #backToTop:hover {
            background-color: #0b5684;
            transform: scale(1.1);
        }
        
        /* Styling Button WhatsApp */
        #whatsappButton {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1050;
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #25d366;
            color: white;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
        }
        
        #whatsappButton:hover {
            background-color: #1ebe57;
            transform: scale(1.1);
        }
        
        @media (max-width: 575.98px) {
            #whatsappButton, #backToTop {
                right: 15px;
                width: 48px;
                height: 48px;
                font-size: 1.2rem;
            }
            #backToTop {
                bottom: 75px;
            }
            #whatsappButton {
                bottom: 15px;
            }
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

    </style>

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
    <!-- Pages JS -->
    <script src="{{ asset('js/pages.js') }}" defer></script>
    <!-- Performance JS -->
    <script src="{{ asset('js/performance.js') }}" defer></script>
</body>
</html>