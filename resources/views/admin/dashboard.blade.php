@extends('layouts.admin')

@section('content')
    <!-- Motivation Banner Slider -->
    <div id="motivationCarousel" class="carousel slide motivation-banner mb-4" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <p class="motivation-text">
                    "Menjadi tenaga kesehatan adalah panggilan hati untuk terus memberi harapan dan kehidupan bagi setiap pasien."
                </p>
            </div>
            <div class="carousel-item">
                <p class="motivation-text">
                    "Setiap senyum pasien yang sembuh adalah hadiah terbesar bagi perjuangan kita di dunia kesehatan."
                </p>
            </div>
            <div class="carousel-item">
                <p class="motivation-text">
                    "Kesembuhan pasien adalah hasil dari kerja keras, ketulusan, dan semangat pantang menyerah tenaga kesehatan."
                </p>
            </div>
            <div class="carousel-item">
                <p class="motivation-text">
                    "Tenaga kesehatan bukan hanya profesi, tapi juga bentuk cinta kasih untuk membantu sesama."
                </p>
            </div>
            <div class="carousel-item">
                <p class="motivation-text">
                    "Setiap tindakan kecil yang kita lakukan hari ini, bisa menjadi perubahan besar bagi kehidupan pasien esok hari."
                </p>
            </div>
        </div>
    </div>
    <!-- Features Grid -->
    <div class="features-grid">
        <!-- Kelola Data Pasien -->
        <div class="feature-card users">
            <div class="feature-header">
                <div class="feature-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <h3 class="feature-title">Kelola Data Pasien</h3>
            </div>
            <p class="feature-description">
                Akses dan kelola data pasien dengan mudah. Pantau informasi personal, riwayat medis, dan status kesehatan secara terintegrasi.
            </p>
            <a href="{{ route('admin.pasien') }}" class="feature-action">
                <i class="bi bi-people-fill"></i>
                Kelola Data Pasien
            </a>
        </div>

        <!-- Kelola Artikel -->
        <div class="feature-card articles">
            <div class="feature-header">
                <div class="feature-icon">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <h3 class="feature-title">Kelola Artikel</h3>
            </div>
            <p class="feature-description">
                Buat dan publikasikan artikel kesehatan berkualitas. Berikan edukasi dan informasi terkini tentang hipertensi kepada pasien.
            </p>
            <a href="{{ route('admin.articles.index') }}" class="feature-action">
                <i class="bi bi-file-earmark-text"></i>
                Kelola Artikel
            </a>
        </div>

        <!-- Kelola Berita -->
        <div class="feature-card news">
            <div class="feature-header">
                <div class="feature-icon">
                    <i class="bi bi-newspaper"></i>
                </div>
                <h3 class="feature-title">Kelola Berita</h3>
            </div>
            <p class="feature-description">
                Update berita terkini seputar kesehatan dan hipertensi. Bagikan informasi penting dari sumber terpercaya kepada pengguna.
            </p>
            <a href="{{ route('admin.news.index') }}" class="feature-action">
                <i class="bi bi-newspaper"></i>
                Kelola Berita
            </a>
        </div>

        <!-- Kelola Tanya Jawab -->
        <div class="feature-card faqs">
            <div class="feature-header">
                <div class="feature-icon">
                    <i class="bi bi-question-circle"></i>
                </div>
                <h3 class="feature-title">Kelola Tanya Jawab</h3>
            </div>
            <p class="feature-description">
                Sediakan jawaban untuk pertanyaan umum tentang hipertensi. Bantu pasien mendapatkan informasi yang mereka butuhkan dengan cepat.
            </p>
            <a href="{{ route('admin.faqs.index') }}" class="feature-action">
                <i class="bi bi-question-circle"></i>
                Kelola Tanya Jawab
            </a>
        </div>

        <!-- Kelola Unduhan -->
        <div class="feature-card downloads">
            <div class="feature-header">
                <div class="feature-icon">
                    <i class="bi bi-cloud-arrow-down"></i>
                </div>
                <h3 class="feature-title">Kelola Unduhan</h3>
            </div>
            <p class="feature-description">
                Sediakan materi edukasi dan panduan kesehatan yang dapat diunduh. Berikan akses mudah ke sumber informasi penting bagi pasien.
            </p>
            <a href="{{ route('admin.downloads.index') }}" class="feature-action">
                <i class="bi bi-cloud-arrow-down"></i>
                Kelola Unduhan
            </a>
        </div>

        <!-- Kelola Testimoni -->
        <div class="feature-card testimonials">
            <div class="feature-header">
                <div class="feature-icon">
                    <i class="bi bi-chat-left-quote"></i>
                </div>
                <h3 class="feature-title">Kelola Testimoni</h3>
            </div>
            <p class="feature-description">
                Tampilkan pengalaman positif dari pengguna layanan. Bangun kepercayaan dan kredibilitas melalui cerita sukses pasien.
            </p>
            <a href="{{ route('admin.testimonials.index') }}" class="feature-action">
                <i class="bi bi-chat-left-quote"></i>
                Kelola Testimoni
            </a>
        </div>
    </div>
    <!-- Logout Section -->
    <div class="logout-section mt-5">
        <div class="logout-icon">
            <i class="bi bi-box-arrow-right"></i>
        </div>
        <h3 class="logout-title">Akhiri Sesi</h3>
        <p class="logout-description">
            Keluar dari sistem dengan aman dan pastikan data Anda terlindungi.
        </p>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="logout-btn" onclick="handleLogout()">
                <i class="bi bi-box-arrow-right me-2"></i>
                Logout Sekarang
            </button>
        </form>
    </div>
@endsection