<!DOCTYPE html>
<html lang="id" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
        <meta name="user-id" content="{{ auth()->id() }}">
    @endauth

    <title>@yield('title', 'Dashboard Super Admin') | Klik Farmasi</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/Favicon.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap Icons (for compatibility) -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary-color: #0b5e91;
            --primary-hover: #094b74;
        }

        /* Custom Klik Farmasi Colors */
        .bg-primary {
            background-color: var(--primary-color) !important;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        .navbar-primary {
            background-color: var(--primary-color) !important;
        }

        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active {
            background-color: var(--primary-color);
        }

        .content-header h1 {
            color: var(--primary-color);
        }

        /* Logo styling */
        .brand-image {
            max-height: 33px;
            max-width: 150px;
            object-fit: contain;
        }

        /* Override AdminLTE default float */
        .brand-link .brand-image {
            float: none !important;
        }

        .brand-text {
            font-weight: 600;
        }

        /* Custom card styling */
        .card {
            box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
        }

        .small-box {
            box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
        }

        /* Lightweight preloader animation */
        .dots-loader {
            display: flex;
            gap: 8px;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--primary-color);
            animation: bounce 1.4s ease-in-out infinite both;
        }

        .dot:nth-child(1) {
            animation-delay: -0.32s;
        }

        .dot:nth-child(2) {
            animation-delay: -0.16s;
        }

        @keyframes bounce {

            0%,
            80%,
            100% {
                transform: scale(0);
                opacity: 0.3;
            }

            40% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Feature cards */
        .feature-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, .2);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .content-wrapper {
                margin-left: 0 !important;
            }
        }
    </style>
    @yield('additional_css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <div class="dots-loader">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
            <div class="mt-3 font-weight-bold" style="color: #0b5e91;">Memuat...</div>
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- User Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <span class="d-none d-md-inline ml-1">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">Super Administrator</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item" data-toggle="modal"
                            data-target="#modalProfilSuperAdmin">
                            Lihat Profil
                        </a>
                        <a href="{{ route('beranda') }}" class="dropdown-item">
                            Lihat Website
                        </a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('superadmin.dashboard') }}" class="brand-link">
                <img src="{{ asset('assets/LOGO KLIKFARMASI VEKTOR MIRING.png') }}" alt="Klik Farmasi"
                    class="brand-image">
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('superadmin.dashboard') }}"
                                class="nav-link {{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('superadmin.admin') }}"
                                class="nav-link {{ request()->routeIs('superadmin.admin') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-shield"></i>
                                <p>Data Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('superadmin.pasien') }}"
                                class="nav-link {{ request()->routeIs('superadmin.pasien') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Data Pasien</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2025 <a href="{{ route('beranda') }}">Klik Farmasi</a>.</strong>
            Platform Kesehatan Digital untuk Manajemen Hipertensi.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.1.0 | Developed by <a href="https://github.com/aznsylm" target="_blank"
                    style="color: black;">Aizan</a> | <a href="https://www.linkedin.com/in/aizansyalim/" target="_blank"
                    style="color: black;"></a>
            </div>
        </footer>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <script>
        // Remove preloader after page load
        $(window).on('load', function() {
            $('.preloader').fadeOut('slow');
        });

        // Fallback: remove preloader after 3 seconds
        setTimeout(function() {
            $('.preloader').fadeOut('slow');
        }, 3000);

        // Toggle password visibility function (preserve existing functionality)
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            let icon;

            // Handle different input structures
            if (input.nextElementSibling && input.nextElementSibling.querySelector) {
                icon = input.nextElementSibling.querySelector('i');
            } else if (input.parentElement && input.parentElement.nextElementSibling) {
                icon = input.parentElement.nextElementSibling.querySelector('i');
            }

            if (icon && input.type === "password") {
                input.type = "text";
                // Remove hide icons
                icon.classList.remove('bi-eye-slash', 'fa-eye-slash');
                // Add show icons
                icon.classList.add('bi-eye', 'fa-eye');
            } else if (icon) {
                input.type = "password";
                // Remove show icons
                icon.classList.remove('bi-eye', 'fa-eye');
                // Add hide icons
                icon.classList.add('bi-eye-slash', 'fa-eye-slash');
            }
        })
        @yield('additional_scripts')
    </script>

    <!-- Modal Profil Super Admin -->
    <div class="modal fade" id="modalProfilSuperAdmin" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">Profil Super Administrator</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label class="font-weight-bold">Email</label>
                                <p>{{ Auth::user()->email }}</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Role</label>
                                <p>Super Administrator</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Terdaftar</label>
                                <p>{{ Auth::user()->created_at->format('d M Y, H:i') }}</p>
                            </div>

                            <div class="alert alert-info mt-3">
                                <h6>Cara Mengubah Data Super Admin:</h6>
                                <ol class="mb-0 pl-3">
                                    <li>Buka file <span
                                            style="color: black; background: #f4f4f4; padding: 2px 4px; border-radius: 3px;">.env</span>
                                        di root project</li>
                                    <li>Edit konfigurasi berikut:
                                        <ul>
                                            <li><span
                                                    style="color: black; background: #f4f4f4; padding: 2px 4px; border-radius: 3px;">SUPER_ADMIN_NAME="Nama
                                                    Baru"</span></li>
                                            <li><span
                                                    style="color: black; background: #f4f4f4; padding: 2px 4px; border-radius: 3px;">SUPER_ADMIN_EMAIL="email@baru.com"</span>
                                            </li>
                                            <li><span
                                                    style="color: black; background: #f4f4f4; padding: 2px 4px; border-radius: 3px;">SUPER_ADMIN_PASSWORD="PasswordBaru123!"</span>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>Jalankan command: <span
                                            style="color: black; background: #f4f4f4; padding: 2px 4px; border-radius: 3px;">php
                                            artisan superadmin:setup</span></li>
                                    <li>Data SuperAdmin akan diperbarui otomatis</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
