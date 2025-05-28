<header class="top-header">
    <div class="header-content">
        <div class="d-flex align-items-center">
            <button class="menu-toggle d-lg-none" id="menuToggle">
                <i class="bi bi-list"></i>
            </button>
            <div class="header-info ms-3">
                <h1>Dashboard Admin</h1>
                <p class="welcome-msg">Selamat datang kembali, {{ Auth::user()->name }}</p>
            </div>
        </div>
        
        <div class="user-profile">
            <div class="profile-avatar">A</div>
            <div class="profile-info d-none d-md-block">
                <div class="fw-semibold">{{ Auth::user()->name }}</div>
                <small class="text-muted">Administrator</small>
            </div>
        </div>
    </div>
</header>