<header class="top-header">
    <div class="header-content">
        <div class="d-flex align-items-center">
            <button class="menu-toggle d-lg-none" id="menuToggle">
                <i class="bi bi-list"></i>
            </button>
            <div class="header-info ms-3">
                <h1>
                    @if(Auth::user()->role === 'super_admin')
                        Dashboard Super Admin
                    @else
                        Dashboard Admin
                    @endif
                </h1>
                <p class="welcome-msg">Selamat datang kembali, {{ Auth::user()->name }}</p>
            </div>
        </div>
        
        <div class="user-profile dropdown">
            <div class="d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                <div class="profile-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                <div class="profile-info d-none d-md-block">
                    <div class="fw-semibold">{{ Auth::user()->name }}</div>
                    <small class="text-muted">
                        @if(Auth::user()->role === 'super_admin')
                            Super Administrator
                        @else
                            Administrator
                        @endif
                    </small>
                </div>
            </div>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item">Log out</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>