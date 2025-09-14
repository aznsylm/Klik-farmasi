<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Admin')</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/Favicon.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #a8edea 0%, #fed6e3 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .dashboard-container {
            min-height: 100vh;
            position: relative;
        }

        /* Sidebar Navigation */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100vh;
            background: #0b5e91;
            padding: 2rem 0;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            z-index: 1000;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .sidebar-header {
            text-align: center;
            padding: 0 2rem 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 2rem;
        }

        .sidebar-logo {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: white;
        }

        .sidebar-title {
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0;
        }

        .sidebar-nav {
            padding: 0 1rem;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateX(5px);
        }

        .nav-link i {
            margin-right: 12px;
            font-size: 1.1rem;
        }

        /* Main Content */
        .main-content {
            margin-left: 0;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        .main-content.sidebar-open {
            margin-left: 280px;
        }

        /* Top Header */
        .top-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1.5rem 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-radius: 0 0 30px 30px;
            margin-bottom: 2rem;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu-toggle {
            background: #0b5e91;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .menu-toggle:hover {
            transform: scale(1.05);
        }

        .header-info h1 {
            font-size: 2.2rem;
            font-weight: 700;
            background: #0b5e91;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .welcome-msg {
            color: #6c757d;
            font-size: 1.1rem;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #0b5e91;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
        }

        /* Dashboard Content */
        .dashboard-content {
            padding: 0 2rem 2rem;
        }

        /* Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Back Button */
        .back-button {
            margin-bottom: 20px;
        }

        /* Table Styles */
        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead {
            background-color: #343a40;
            color: #fff;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        /* Card Styles */
        .card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Button Styles */
        .btn {
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #0b5e91;
            border-color: #0b5e91;
        }

        .btn-primary:hover {
            background-color: #094b74;
            border-color: #094b74;
        }

        .btn-success {
            background-color: #38b000;
            border-color: #38b000;
        }

        .btn-success:hover {
            background-color: #2d9000;
            border-color: #2d9000;
        }

        .btn-danger {
            background-color: #d90429;
            border-color: #d90429;
        }

        .btn-danger:hover {
            background-color: #ba0324;
            border-color: #ba0324;
        }

        .btn-warning {
            background-color: #ffb703;
            border-color: #ffb703;
            color: #343a40;
        }

        .btn-warning:hover {
            background-color: #fb8500;
            border-color: #fb8500;
            color: white;
        }

        .btn-info {
            background-color: #00b4d8;
            border-color: #00b4d8;
        }

        .btn-info:hover {
            background-color: #0096c7;
            border-color: #0096c7;
        }

        /* Form Styles */
        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 0.6rem 1rem;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0b5e91;
            box-shadow: 0 0 0 0.25rem rgba(11, 94, 145, 0.25);
        }

        /* Password Input */
        .password-field {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            z-index: 10;
        }

        /* Alert Styles */
        .alert {
            border-radius: 10px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Pagination Style */
        .pagination {
            justify-content: center;
            margin-top: 1.5rem;
        }

        .pagination .page-item .page-link {
            color: #0b5e91;
            border-radius: 6px;
            margin: 0 2px;
            border: 1px solid #e2e8f0;
            transition: background 0.2s, color 0.2s;
        }

        .pagination .page-item.active .page-link {
            background: #0b5e91;
            color: #fff;
            border-color: #0b5e91;
        }

        .pagination .page-item .page-link:hover {
            background: #e6f2fa;
            color: #0b5e91;
        }

        /* Feature Cards */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .feature-card {
            background: white;
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
        }

        .feature-card.users::before,
        .feature-card.articles::before,
        .feature-card.news::before,
        .feature-card.faqs::before,
        .feature-card.downloads::before,
        .feature-card.testimonials::before,
        .feature-card.codes::before {
            background: #0b5e91;
        }

        .feature-card:hover {
            transform: translateY(-12px) scale(1.03);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .feature-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.5rem;
            color: white;
        }

        .feature-card.users .feature-icon,
        .feature-card.articles .feature-icon,
        .feature-card.news .feature-icon,
        .feature-card.faqs .feature-icon,
        .feature-card.downloads .feature-icon,
        .feature-card.testimonials .feature-icon,
        .feature-card.codes .feature-icon {
            background: #0b5e91;
        }

        .feature-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: #2d3748;
            margin: 0;
        }

        .feature-description {
            color: #4a5568;
            line-height: 1.6;
            margin-bottom: 2rem;
            height: 80px;
            overflow: hidden;
            text-align: justify;
            font-weight: 400;
        }

        .feature-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            color: white;
        }

        .feature-card.users .feature-action,
        .feature-card.articles .feature-action,
        .feature-card.news .feature-action,
        .feature-card.faqs .feature-action,
        .feature-card.downloads .feature-action,
        .feature-card.testimonials .feature-action,
        .feature-card.codes .feature-action {
            background: #0b5e91;
        }

        .feature-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            color: white;
            text-decoration: none;
        }

        /* Logout Section */
        .logout-section {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            border-radius: 24px;
            padding: 2rem;
            text-align: center;
            color: white;
            box-shadow: 0 8px 32px rgba(238, 90, 36, 0.3);
        }

        .logout-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
        }

        .logout-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .logout-description {
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 12px 32px;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            color: white;
        }

        .motivation-banner {
            background: #0b5e91;
            border-radius: 18px;
            padding: 32px 24px;
            color: #fff;
            text-align: center;
            margin-bottom: 32px;
            box-shadow: 0 4px 24px rgba(11, 94, 145, 0.08);
        }

        .motivation-text {
            font-size: 1.25rem;
            font-style: italic;
            font-weight: 500;
            margin: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-info h1 {
                font-size: 1.8rem;
            }

            .welcome-msg {
                font-size: 1rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .feature-card {
                padding: 2rem;
            }

            .dashboard-content {
                padding: 0 1rem 2rem;
            }

            .top-header {
                padding: 1rem;
            }

            .table {
                font-size: 0.9rem;
            }

            .btn {
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }
        }

        @media (min-width: 1200px) {
            .main-content {
                margin-left: 280px;
            }

            .sidebar {
                transform: translateX(0);
            }
        }
    </style>
    @yield('additional_css')
</head>

<body>
    <!-- Sidebar -->
    <x-admin.sidebar />

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Header -->
        <x-admin.top-header />

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar Toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const mainContent = document.getElementById('mainContent');

        if (menuToggle) {
            menuToggle.addEventListener('click', toggleSidebar);
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', closeSidebar);
        }

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');

            if (window.innerWidth >= 1200) {
                mainContent.classList.toggle('sidebar-open');
            }
        }

        function closeSidebar() {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');

            if (window.innerWidth >= 1200) {
                mainContent.classList.remove('sidebar-open');
            }
        }

        // Responsive handling
        function handleResize() {
            if (window.innerWidth >= 1200) {
                sidebar.classList.add('active');
                mainContent.classList.add('sidebar-open');
                sidebarOverlay.classList.remove('active');
            } else {
                sidebar.classList.remove('active');
                mainContent.classList.remove('sidebar-open');
                sidebarOverlay.classList.remove('active');
            }
        }

        window.addEventListener('resize', handleResize);
        handleResize(); // Initial call

        // Fix sidebar links
        document.querySelectorAll('.sidebar-nav .nav-link').forEach(link => {
            link.addEventListener('click', function() {
                if (!this.getAttribute('data-bs-toggle')) {
                    window.location.href = this.getAttribute('href');
                }
            });
        });

        // Toggle password visibility
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                input.type = "password";
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        }
    </script>
    @yield('additional_scripts')
</body>

</html>
