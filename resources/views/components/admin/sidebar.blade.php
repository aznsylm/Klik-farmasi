<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('assets/LOGO KLIKFARMASI VEKTOR MIRING.png') }}" style="width: 220px; margin-bottom: 30px;" alt="Klik Farmasi Logo">
    </div>
    
    <nav class="sidebar-nav">
        <div class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.pasien') }}" class="nav-link {{ request()->routeIs('admin.pasien') || request()->routeIs('admin.pasienDetail') || request()->routeIs('admin.pasienEdit') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span>Data Pasien</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.articles.index') }}" class="nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i>
                <span>Artikel</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.news.index') }}" class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                <i class="bi bi-newspaper"></i>
                <span>Berita</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.faqs.index') }}" class="nav-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                <i class="bi bi-question-circle"></i>
                <span>Tanya Jawab</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.downloads.index') }}" class="nav-link {{ request()->routeIs('admin.downloads.*') ? 'active' : '' }}">
                <i class="bi bi-cloud-arrow-down"></i>
                <span>Unduhan</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                <i class="bi bi-chat-left-quote"></i>
                <span>Testimoni</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('beranda') }}" class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i>
                <span>Lihat Website</span>
            </a>
        </div>
    </nav>
</div>