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
                Kelola Data Pasien
            </a>
        </div>

        <!-- Kelola Kode Pendaftaran -->
        <div class="feature-card codes">
            <div class="feature-header">
                <div class="feature-icon">
                    <i class="bi bi-key-fill"></i>
                </div>
                <h3 class="feature-title">Kelola Kode Pendaftaran</h3>
            </div>
            <p class="feature-description">
                Buat dan kelola kode pendaftaran untuk pasien baru. Kontrol akses registrasi dengan sistem kode yang aman dan terorganisir.
            </p>
            <a href="{{ route('admin.kode-pendaftaran.index') }}" class="feature-action">
                Kelola Kode Pendaftaran
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
            <a href="{{ route('admin.artikel.index') }}" class="feature-action">
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
            <a href="{{ route('admin.berita.index') }}" class="feature-action">
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
            <a href="{{ route('admin.tanya-jawab.index') }}" class="feature-action">
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
            <a href="{{ route('admin.unduhan.index') }}" class="feature-action">
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
            <a href="{{ route('admin.testimoni.index') }}" class="feature-action">
                Kelola Testimoni
            </a>
        </div>
    </div>
@endsection