<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- Kolom 1: Logo & Info -->
            <div class="col-md-3 mb-4 mb-md-0">
                <img src="{{ asset('assets/LOGO KLIKFARMASI VEKTOR MIRING.png') }}" alt="Logo Farmasi Universitas Alma Ata" class="footer-logo" width="220" height="auto" loading="lazy" decoding="async">
                <h3>Universitas Alma Ata</h3>
                <p class="footer-address">
                    Jl. Brawijaya No.99, Jadan, Tamantirto, Kasihan, Bantul, Yogyakarta 55183
                </p>
                <div class="footer-social">
                    <a href="https://wa.me/+6285280909235" class="footer-social-icon" target="_blank">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                    <a href="https://www.instagram.com/klikfarmasi.official/" class="footer-social-icon" target="_blank">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="https://www.tiktok.com/@klikfarmasi.official" class="footer-social-icon" target="_blank">
                        <i class="bi bi-tiktok"></i>
                    </a>
                    <a href="mailto:klikfarmasi.official@gmail.com" class="footer-social-icon" target="_blank">
                        <i class="bi bi-envelope-fill"></i>
                    </a>
                </div>
            </div>

            <!-- Kolom 2: Tentang Kami -->
            <div class="col-md-3 mb-4 mb-md-0">
                <h3>Tentang Kami</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('petunjuk') }}">Petunjuk Penggunaan</a></li>
                    <li><a href="{{ route('tim-pengelola') }}">Tim Pengelola</a></li>
                    <li><a href="{{ route('tanya-jawab.kehamilan') }}">FAQ</a></li>
                    <li><a href="https://wa.me/+6285280909235">Hubungi Kami</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Layanan -->
            <div class="col-md-3 mb-4 mb-md-0">
                <h3>Layanan</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('pengingat') }}">Pengingat Minum Obat</a></li>
                    <li><a href="{{ route('artikel.kehamilan') }}">Artikel Hipertensi Kehamilan</a></li>
                    <li><a href="{{ route('artikel.non-kehamilan') }}">Artikel Hipertensi Non-Kehamilan</a></li>
                    <li><a href="{{ url('/berita') }}">Berita</a></li>
                    <li><a href="{{ route('unduhan') }}">Unduhan</a></li>
                </ul>
            </div>

            <!-- Kolom 4: Lokasi -->
            <div class="col-md-3">
                <h3>Lokasi</h3>
                <div class="footer-map ratio ratio-4x3">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3818.913!2d110.321932!3d-7.818442!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7af7e2b2acea97%3A0xa3cb91d3e65407b2!2sUniversitas%20Alma%20Ata%20Yogyakarta!5e1!3m2!1sid!2sid" width="300" height="225" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Lokasi Universitas Alma Ata"></iframe>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="row footer-bottom">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="footer-partners">
                    <p>Bagian dari:</p>
                    <img src="{{ asset('assets/mitra.png') }}" alt="Logo Mitra" width="40" height="40" loading="lazy" decoding="async">
                    <img src="{{ asset('assets/Farmasi-LogoUAA_white.png') }}" alt="Logo Farmasi" width="40" height="40" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0 text-center">
                <p class="footer-copyright">&copy; 2025 Klik Farmasi - Universitas Alma Ata</p>
            </div>
            <div class="col-md-4 text-md-end">
                <p class="footer-copyright">Dikelola oleh Tim Mahasiswa Farmasi UAA</p>
            </div>
        </div>
    </div>
</footer>

<style>
/* Footer Styles */
.footer {
    background-color: #0b5e91;
    padding: 3rem 0 1.5rem;
    font-family: 'Open Sans', sans-serif;
    color: #f0f0f0;
    position: relative;
    overflow: hidden;
}

.footer::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
    border-radius: 50%;
    transform: translate(30%, -30%);
    pointer-events: none;
}

.footer-logo {
    max-width: 220px;
    margin-bottom: 1rem;
    transition: transform 0.3s ease;
}

.footer-logo:hover {
    transform: scale(1.05);
}

.footer h3 {
    font-weight: 700;
    font-size: 1.2rem;
    color: #f0f0f0;
    margin-bottom: 1.5rem;
    position: relative;
    padding-bottom: 0.5rem;
}

.footer h3::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 3px;
    background-color: #baa971;
    border-radius: 2px;
}

.footer p {
    font-family: 'Open Sans', sans-serif;
    font-size: 14px;
    line-height: 1.7;
    letter-spacing: 0.3px;
    color: #e3e3e3;
    margin-bottom: 10px;
}

.footer-address {
    font-size: 0.9rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.footer-social {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
}

.footer-social-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    color: #f0f0f0;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.footer-social-icon:hover {
    background-color: #baa971;
    color: #0b5e91;
    transform: translateY(-3px);
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 0.8rem;
}

.footer-links a {
    color: #f0f0f0;
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.2s ease;
    display: inline-block;
    position: relative;
}

.footer-links a::before {
    content: '›';
    margin-right: 0.5rem;
    opacity: 0;
    transform: translateX(-8px);
    transition: all 0.2s ease;
}

.footer-links a:hover {
    color: #baa971;
    transform: translateX(5px);
}

.footer-links a:hover::before {
    opacity: 1;
    transform: translateX(0);
}

.footer-map {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease;
}

.footer-map:hover {
    transform: translateY(-5px);
}

.footer-bottom {
    margin-top: 2.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.footer-partners {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.footer-partners p {
    margin-bottom: 0;
    font-size: 0.85rem;
    white-space: nowrap;
}

.footer-partners img {
    height: 40px;
    transition: transform 0.3s ease;
}

.footer-partners img:hover {
    transform: scale(1.1);
}

.footer-copyright {
    font-size: 0.85rem;
    opacity: 0.8;
}

/* Tablet responsive styles */
@media (min-width: 768px) and (max-width: 991.98px) {
    .footer {
        padding: 2.5rem 0 1.5rem;
    }
    
    .footer-logo {
        max-width: 180px;
    }
    
    .footer h3 {
        font-size: 1.1rem;
        margin-bottom: 1.2rem;
    }
    
    .footer p {
        font-size: 0.85rem;
    }
    
    .footer-address {
        font-size: 0.8rem;
    }
    
    .footer-links a {
        font-size: 0.85rem;
    }
    
    .footer-social-icon {
        width: 34px;
        height: 34px;
        font-size: 1rem;
    }
    
    .footer-partners p {
        font-size: 0.8rem;
    }
    
    .footer-partners img {
        height: 35px;
    }
    
    .footer-copyright {
        font-size: 0.8rem;
    }
    
    .footer-map {
        height: 200px;
    }
}

@media (max-width: 767.98px) {
    .footer {
        padding: 2rem 0 1rem;
    }
    
    .footer h3 {
        margin-top: 1.5rem;
    }
    
    .footer-bottom {
        text-align: center;
    }
    
    .footer-partners {
        justify-content: center;
        margin-bottom: 1rem;
    }
}
</style>