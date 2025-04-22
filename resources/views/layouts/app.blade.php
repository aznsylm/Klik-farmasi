<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Klik Farmasi')</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
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

    <!-- Button Kembali ke Atas -->
    <button id="backToTop" class="btn btn-primary rounded-circle shadow-lg" style="display: none; position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
        <i class="bi bi-arrow-up"></i>
    </button>
    
    <style>
        #backToTop {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #007bff;
            color: white;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        #backToTop:hover {
            background-color: #0056b3;
            transform: scale(1.2);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        }

        #backToTop:active {
            transform: scale(1.1);
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
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