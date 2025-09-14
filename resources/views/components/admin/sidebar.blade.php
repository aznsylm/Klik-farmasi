<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('assets/LOGO KLIKFARMASI VEKTOR MIRING.png') }}" style="width: 220px; margin-bottom: 30px;" alt="Klik Farmasi Logo">
    </div>
    
    <nav class="sidebar-nav">
        @if(auth()->user() && auth()->user()->role === 'super_admin')
            <div class="nav-item">
                <a href="{{ route('superadmin.users', ['role' => 'admin']) }}" class="nav-link {{ request()->routeIs('superadmin.users') || request()->routeIs('superadmin.userDetail') || request()->routeIs('superadmin.userEdit') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </div>
        @else
            <div class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="{{ route('admin.pasien') }}" class="nav-link {{ request()->routeIs('admin.pasien') || request()->routeIs('admin.pasienDetail') || request()->routeIs('admin.pasienEdit') || request()->routeIs('admin.pasienCreate') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Data Pasien</span>
                    @if($totalCatatanPasien > 0)
                        <span class="badge bg-danger text-white ms-2" style="font-size: 0.7rem;">{{ $totalCatatanPasien }}</span>
                    @endif
                </a>
            </div>

            @if(auth()->user() && auth()->user()->role === 'admin')
                <div class="nav-item">
                    <a href="{{ route('admin.kode-pendaftaran.index') }}" class="nav-link {{ request()->routeIs('admin.kode-pendaftaran.*') ? 'active' : '' }}">
                        <i class="bi bi-key-fill"></i>
                        <span>Kode Pendaftaran</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.artikel.index') }}" class="nav-link {{ request()->routeIs('admin.artikel.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text"></i>
                        <span>Artikel</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.berita.index') }}" class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                        <i class="bi bi-newspaper"></i>
                        <span>Berita</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.tanya-jawab.index') }}" class="nav-link {{ request()->routeIs('admin.tanya-jawab.*') ? 'active' : '' }}">
                        <i class="bi bi-question-circle"></i>
                        <span>Tanya Jawab</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.unduhan.index') }}" class="nav-link {{ request()->routeIs('admin.unduhan.*') ? 'active' : '' }}">
                        <i class="bi bi-cloud-arrow-down"></i>
                        <span>Unduhan</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.testimoni.index') }}" class="nav-link {{ request()->routeIs('admin.testimoni.*') ? 'active' : '' }}">
                        <i class="bi bi-chat-left-quote"></i>
                        <span>Testimoni</span>
                    </a>
                </div>
            @endif
        @endif
        
        <div class="nav-item">
            <a href="{{ route('beranda') }}" class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i>
                <span>Lihat Website</span>
            </a>
        </div>
        
        <div class="nav-item mt-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </nav>
</div>