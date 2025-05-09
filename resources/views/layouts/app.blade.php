<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Klik Farmasi')</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font El Messiri & Open Sans -->
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Core Theme CSS -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
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

    <!-- Button WhatsApp -->
    <a href="https://wa.me/6281234567890" target="_blank" id="whatsappButton" class="btn btn-success rounded-circle shadow-lg">
        <i class="bi bi-whatsapp"></i>
    </a>
    
    <!-- Button Kembali ke Atas -->
    <button id="backToTop" class="btn btn-primary rounded-circle shadow-lg" style="display: none; position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
        <i class="bi bi-arrow-up"></i>
    </button>
    
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
            color: #595959;
            margin-bottom: 10px;
        }

        /* Styling Button WhatsApp */
        #whatsappButton {
            position: fixed;
            bottom: 90px; /* Berada di atas tombol Back to Top */
            right: 20px;
            z-index: 1000;
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
            transform: scale(1.2);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        }

        #whatsappButton:active {
            transform: scale(1.1);
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
        }

        /* Styling Button Back to Top */
        #backToTop {
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
        }

        #backToTop:hover {
            background-color: #0b5684;
            transform: scale(1.2);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        }

        #backToTop:active {
            transform: scale(1.1);
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
        }

        /* Button Hover Effects */
        .btn-primary:hover {
            background-color: #baa971;
            color: #ffffff;
        }

        .btn-outline-light:hover {
            background-color: #baa971;
            color: #ffffff;
            border-color: #baa971;
        }
        </style>

    <script>
        // Tampilkan tombol saat scroll ke bawah
        const backToTopButton = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 200) {
                backToTopButton.style.display = 'block';
            } else {
                backToTopButton.style.display = 'none';
            }
        });

        // Scroll ke atas saat tombol diklik
        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>


    <!-- Bootstrap Core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core Theme JS -->
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>