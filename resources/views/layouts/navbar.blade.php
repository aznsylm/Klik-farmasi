<nav class="navbar fixed-top navbar-expand-lg shadow-sm" style="font-family: 'Nunito', sans-serif; background-color: #0B5E91;">
    <div class="container px-4">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('assets/LOGO KLIKFARMASI VEKTOR MIRING.png') }}" alt="Klik Farmasi" style="width: 180px; height: auto;">
        </a>
        
        <!-- Toggler (Hamburger Menu) -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link px-3" href="{{ url('/') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="{{ url('/petunjuk') }}">Petunjuk Penggunaan</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center px-3" id="informasiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Informasi
                        <i class="bi bi-chevron-down ms-1 small"></i>
                    </a>
                    <ul class="dropdown-menu shadow border-0" aria-labelledby="informasiDropdown">
                        <li>
                            <a class="dropdown-item py-2" href="{{ url('/artikel') }}">
                                <i class="bi bi-journal-text me-2 text-primary"></i> Artikel
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="{{ url('/berita') }}">
                                <i class="bi bi-newspaper me-2 text-success"></i> Berita
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link px-3" href="{{ url('/tanya-jawab') }}">Tanya Jawab</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center px-3" id="unduhanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Unduhan
                        <i class="bi bi-chevron-down ms-1 small"></i>
                    </a>
                    <ul class="dropdown-menu shadow border-0" aria-labelledby="unduhanDropdown">
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('unduhan.modul') }}">
                                <i class="bi bi-journal-bookmark me-2 text-primary"></i> Modul
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('unduhan.flayer') }}">
                                <i class="bi bi-file-earmark-image me-2 text-success"></i> Flyer
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link px-3" href="{{ url('/pengingat') }}">Pengingat</a></li>
            </ul>
            
            <!-- Auth Buttons -->
            <div class="ms-lg-2">
                @guest
                    <!-- Tombol Login/Register Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="authDropdown" data-bs-toggle="dropdown" aria-expanded="false" 
                            style="border-radius: 30px; padding: 8px 20px; font-size: 0.9rem; background-color: #baa971; border: none; transition: all 0.3s ease;">
                            <i class="bi bi-person-circle me-1"></i> Akun
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="authDropdown">
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('login') }}">
                                    <i class="bi bi-box-arrow-in-right me-2 text-primary"></i> Login
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('register') }}">
                                    <i class="bi bi-person-plus-fill me-2 text-success"></i> Register
                                </a>
                            </li>
                        </ul>
                    </div>
                @endguest

                @auth
                    <!-- Gambar Profil Statis dan Nama Pengguna -->
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/ProfilePerson.png') }}" alt="User Profile" class="rounded-circle me-2" width="36" height="36">
                        <span class="text-white">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="dropdownUser">
                        @if(Auth::user()->role === 'admin')
                            <!-- Opsi untuk Admin -->
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                </a>
                            </li>
                        @else
                            <!-- Opsi untuk User -->
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('user.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                </a>
                            </li>
                        @endif
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item py-2">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Animasi Hover untuk Navbar -->
<style>
    /* Font Family */
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap');
    
    body {
        padding-top: 60px;
    }
    
    /* Navbar Styling */
    .navbar {
        box-shadow: 0 2px 10px rgba(0,0,0,0.1) !important;
        padding: 10px 0;
    }
    
    /* Navbar Links Hover Effect */
    .navbar-nav .nav-link {
        position: relative;
        color: #ffffff;
        font-weight: 500;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
        color: #00d9ff; 
    }

    .navbar-nav .nav-link::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -3px;
        width: 0;
        height: 2px;
        background-color: #00d9ff; /* Warna garis hover */
        transition: width 0.3s ease;
    }

    .navbar-nav .nav-link:hover::after {
        width: 100%;
    }

    /* Dropdown Styling */
    .dropdown-menu {
        border-radius: 8px;
        overflow: hidden;
    }
    
    .dropdown-item {
        transition: all 0.2s ease;
    }
    
    .dropdown-menu .dropdown-item:hover {
        background-color: #f0f0f0;
        color: #0B5E91;
        transform: translateX(5px);
    }

    /* Button Hover Effect */
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    /* Auth Dropdown Button */
    #authDropdown:hover {
        background-color: #a08e5e !important;
    }

    /* Mobile View Adjustments */
    @media (max-width: 991.98px) {
        body {
            padding-top: 56px;
        }
        
        .navbar-brand {
            margin-left: 0;
        }
        
        .navbar-nav {
            padding: 10px 0;
        }
        
        .navbar-collapse {
            background-color: #0B5E91;
            padding: 10px;
            border-radius: 8px;
            margin-top: 10px;
        }
        
        .ms-lg-2 {
            margin-top: 15px;
            margin-bottom: 10px;
        }
    }
</style>