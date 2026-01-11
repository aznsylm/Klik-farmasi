<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/Favicon.png') }}">
    <title>@yield('title', 'Klik Farmasi')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #0b5e91 0%, #0b5e91 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            min-height: 600px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            border-radius: 24px;
            overflow: hidden;
            background: white;
        }

        .form-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .hero-section {
            flex: 1;
            background: linear-gradient(135deg, #0b5e91 0%, #084e79 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
            padding: 40px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-content h1 {
            font-family: 'Quicksand', sans-serif;
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 1.2rem;
            opacity: 0.95;
            line-height: 1.6;
            max-width: 80%;
            margin: 0 auto;
        }

        .form-title {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 12px;
            text-align: center;
        }

        .form-subtitle {
            color: #4a5568;
            margin-bottom: 30px;
            font-size: 1rem;
            text-align: center;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.row {
            display: flex;
            gap: 15px;
        }

        .form-group.row > div {
            flex: 1;
        }

        .form-control {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            font-family: 'Nunito', sans-serif;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .form-control:focus {
            outline: none;
            border-color: #0b5e91;
            background: white;
            box-shadow: 0 0 0 3px rgba(11, 94, 145, 0.1);
        }

        .form-select {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            font-family: 'Nunito', sans-serif;
            background: #f8fafc;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-select:focus {
            outline: none;
            border-color: #0b5e91;
            background: white;
            box-shadow: 0 0 0 3px rgba(11, 94, 145, 0.1);
        }

        .password-group {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #4a5568;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #0b5e91;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .checkbox-group input[type="checkbox"] {
            margin-right: 10px;
            transform: scale(1.2);
        }

        .checkbox-group label {
            color: #4a5568;
            font-size: 0.95rem;
            cursor: pointer;
        }

        .btn-primary {
            width: 100%;
            padding: 15px;
            background: #0b5e91;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            font-family: 'Nunito', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary:hover {
            background: #084e79;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(11, 94, 145, 0.2);
        }

        .form-link {
            text-align: center;
            color: #4a5568;
            font-size: 0.95rem;
        }

        .form-link a {
            color: #0b5e91;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .form-link a:hover {
            color: #084e79;
            text-decoration: underline;
        }

        .alert {
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-danger {
            background-color: #fff5f5;
            color: #e53e3e;
            border: 1px solid #feb2b2;
        }

        .alert-success {
            background-color: #f0fff4;
            color: #38a169;
            border: 1px solid #9ae6b4;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                max-width: 400px;
            }
            
            .hero-section {
                padding: 30px;
                min-height: 200px;
            }
            
            .hero-content h1 {
                font-size: 2.5rem;
            }
            
            .form-section {
                padding: 30px 25px;
            }
            
            .form-group.row {
                flex-direction: column;
                gap: 15px;
            }

            .hero-content p {
                font-size: 1rem;
                max-width: 100%;
            }
        }

        .decorative-circles {
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            top: -100px;
            right: -100px;
            z-index: 1;
        }

        .decorative-circles::before {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            bottom: -50px;
            left: -100px;
        }

        .decorative-circles::after {
            content: '';
            position: absolute;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            bottom: 50px;
            right: -50px;
        }
    </style>
    @yield('extra_styles')
</head>
<body>
    <div class="container" style="position: relative;">

        <!-- Form Section -->
        <div class="form-section">
            @yield('content')
        </div>

        <!-- Hero Section -->
        <div class="hero-section">
            <div class="decorative-circles"></div>
            <div class="hero-content">
                <img src="{{ asset('assets/LOGO KLIKFARMASI VEKTOR MIRING.png') }}" style="width: 300px; margin-bottom: 30px;" alt="Klik Farmasi Logo">
                <p id="heroSubtitle">@yield('hero_subtitle', 'Bergabunglah dengan ribuan pengguna lainnya untuk pengalaman kesehatan yang lebih baik')</p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconElement) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                iconElement.classList.remove('fa-eye-slash');
                iconElement.classList.add('fa-eye');
            } else {
                input.type = 'password';
                iconElement.classList.remove('fa-eye');
                iconElement.classList.add('fa-eye-slash');
            }
        }
    </script>
    @yield('extra_scripts')
</body>
</html>