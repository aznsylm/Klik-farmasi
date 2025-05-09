<nav class="navbar fixed-top navbar-expand-lg shadow-sm" style="font-family: 'Nunito', sans-serif; background-color: #0B5E91  ;">
    <div class="container px-5 d-flex justify-content-between align-items-center">
        <!-- Toggler (Hamburger Menu) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('assets/LOGO KLIKFARMASI VEKTOR MIRING.png') }}" alt="Klik Farmasi" style="width: 200px; height: auto;">
        </a>
        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Beranda</a></li>
                <!-- Menu Informasi dengan Sub-menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" id="informasiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Informasi
                        <i class="bi bi-chevron-down ms-1"></i> <!-- Ikon panah dropdown -->
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="informasiDropdown">
                        <li><a class="dropdown-item" href="{{ url('/artikel') }}">Artikel</a></li>
                        <li><a class="dropdown-item" href="{{ url('/berita') }}">Berita</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/tanya-jawab') }}">Tanya Jawab</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/unduhan') }}">Unduhan</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/pengingat') }}">Pengingat</a></li>
            </ul>
            <!-- Dropdown for Login/Register or User Profile -->
            <div class="ms-3 dropdown">
                @guest
                    <!-- Tombol Login dan Register -->
                    <div class="d-flex align-items-center">
                        <a href="{{ route('login') }}" class="btn btn-outline-light me-2" style="border-radius: 30px; padding: 8px 20px; font-size: 0.9rem; transition: all 0.3s ease;">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary" style="border-radius: 30px; padding: 8px 20px; font-size: 0.9rem; background-color: #baa971; border: none; transition: all 0.3s ease;">
                            <i class="bi bi-person-plus-fill me-2"></i> Register
                        </a>
                    </div>
                @endguest

                @auth
                    <!-- Gambar Profil Statis dan Nama Pengguna -->
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/ProfilePerson.png') }}" alt="User Profile" class="rounded-circle me-2" width="40" height="40">
                        <span class="text-white">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser">
                        @if(Auth::user()->role === 'admin')
                            <!-- Opsi untuk Admin -->
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                </a>
                            </li>
                        @else
                            <!-- Opsi untuk User -->
                            <li>
                                <a class="dropdown-item" href="{{ route('user.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                </a>
                            </li>
                        @endif
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item">
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
    /* Navbar Links Hover Effect */
    .navbar-nav .nav-link {
        position: relative;
        color: #ffffff;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
        color: #00d9ff; 
    }

    .navbar-nav .nav-link::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -5px;
        width: 0;
        height: 2px;
        background-color: #00d9ff; /* Warna garis hover */
        transition: width 0.3s ease;
    }

    .navbar-nav .nav-link:hover::after {
        width: 100%;
    }

    /* Button Hover Effect */
    .btn-outline-light:hover {
        background-color: #ffffff;
        color: #00d9ff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Mobile View Adjustments */
    @media (max-width: 991.98px) {
        body {
            padding-top: 50px; /* Sesuaikan dengan tinggi navbar */
        }
        .navbar-brand {
            order: 1; /* Logo berada di atas */
            margin-left: 0;
        }
    
        .navbar-toggler {
            order: 2; /* Toggle berada di bawah logo */
        }
    
        .navbar-collapse {
            order: 3; /* Menu berada di bawah toggle */
        }
    }
</style>