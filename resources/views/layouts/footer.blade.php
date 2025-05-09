<footer style="background-color: #0b5e91; padding: 20px; font-family: 'Open Sans', sans-serif;">
    <div class="container">
        <div class="row">
    
            {{-- Kolom 1 --}}
            <div class="col-md-3">
                <img src="{{ asset('assets/LOGO KLIKFARMASI VEKTOR MIRING.png') }}" alt="Logo Farmasi Universitas Alma Ata" class="mb-3" style="max-width: 250px;">
                <h3 class="fw-bold fs-4" >Universitas Alma Ata</h3>
                <p class="small mb-2">
                    Jl. Brawijaya No.99, Jadan, Tamantirto, Kasihan, Bantul, Yogyakarta 55183
                </p>
            <div class="d-flex gap-4">
                <a href="https://wa.me/6281234567890" class="text-white fs-4 ms-3" target="_blank"><i class="bi bi-whatsapp"></i></a>
                <a href="https://instagram.com/klikfarmasi" class="text-white fs-4 ms-3" target="_blank"><i class="bi bi-instagram"></i></a>
                <a href="https://tiktok.com/@klikfarmasi" class="text-white fs-4 ms-3" target="_blank"><i class="bi bi-tiktok"></i></a>
                <a href="mailto:klikfarmasi@almaata.ac.id" class="text-white fs-4 ms-3" target="_blank"><i class="bi bi-envelope-fill"></i></a>
            </div>
            </div>
    
            {{-- Kolom 2 --}}
            <div class="col-md-3">
                <h3 class="fw-bold fs-4">Tentang Kami</h3>
                <ul class="list-unstyled small">
                    <li><a href="#" class="text-white text-decoration-none">Petunjuk Penggunaan</a></li>
                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Hubungi Kami</a></li>
                </ul>
            </div>
    
            {{-- Kolom 3 --}}
            <div class="col-md-3">
                <h3 class="fw-bold fs-4">Layanan</h3>
                <ul class="list-unstyled small">
                    <li><a href="#" class="text-white text-decoration-none">Pengingat Minum Obat</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Artikel</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Berita</a></li>
                </ul>
            </div>
    
            {{-- Kolom 4 --}}
            <div class="col-md-3">
                <h3 class="fw-bold fs-4">Lokasi</h3>
                <div class="ratio ratio-4x3">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3818.9130339956882!2d110.32193207484461!3d-7.818441792202233!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7af7e2b2acea97%3A0xa3cb91d3e65407b2!2sUniversitas%20Alma%20Ata%20Yogyakarta!5e1!3m2!1sid!2sid!4v1746759433825!5m2!1sid!2sid" width="400" height="200" style=" border-radius: 12px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
    
        </div>
    
        {{-- Footer Bottom --}}
        <div class="row mt-4 pt-3 border-top border-white">
            <div class="col-md-4 text-center text-md-start mb-2 d-flex">
                <p class="mb-0 small">Bagian dari: </p>
                <img src="{{ asset('assets/mitra.png') }}" alt="Logo Bagian Dari" style="height: 50px;">
                <img src="{{ asset('assets/Farmasi-LogoUAA_white.png') }}" alt="Logo Bagian Dari" style="height: 50px;">
            </div>
            <div class="col-md-4 text-center mb-2">
                <p class="mb-0 small">&copy; 2025 Klik Farmasi - Universitas Alma Ata</p>
            </div>
            <div class="col-md-4 text-center text-md-end mb-2">
                <p class="mb-0 small">Dibuat oleh Tim Mahasiswa Farmasi UAA</p>
            </div>
        </div>
    </div>  
</footer>

<style>
    footer {
        font-family: 'Open Sans', sans-serif;
        color: #fff
    }
    footer h3 {
        margin-top: 10px;
        margin-bottom: 20px;
    }

    footer p {
        font-size: 14px;
        line-height: 1.7;
        letter-spacing: 0.3px;
        color: #f0f0f0;
        margin-bottom: 10px;
    }   

    footer ul li {
        margin-bottom: 8px;
    }

</style>