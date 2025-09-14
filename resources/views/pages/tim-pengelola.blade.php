@extends('layouts.app')
@section('title', 'Tim Pengelola - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Kenali tim pengelola Klik Farmasi dari Program Studi Farmasi Universitas Alma Ata. Dosen pembimbing dan mahasiswa yang mengembangkan platform kesehatan digital.">
    <meta name="keywords"
        content="tim klik farmasi, mahasiswa farmasi UAA, dosen pembimbing, universitas alma ata, tim pengembang">
    <meta name="author" content="Tim Farmasi Universitas Alma Ata">
@endpush
@section('content')
    <section class="team-section">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bolder mb-3 team-title">Tim Pengelola Klik Farmasi</h2>
                <p class="mx-auto team-subtitle">Kenali tim mahasiswa Farmasi Universitas Alma Ata yang mengelola platform
                    ini</p>
                <div class="d-flex justify-content-center mt-3">
                    <div class="title-divider"></div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12" data-aos="fade-up">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="fw-bold mb-4 text-primary">Tentang Website Klik-Farmasi</h3>
                            <p class="text-dark">Klik Farmasi merupakan platform asuhan kefarmasian yang dikembangkan oleh
                                Dosen dan mahasiswa Program Studi S1 Farmasi Universitas Alma Ata sebagai wujud kontribusi
                                dalam bidang pendidikan, penelitian, dan pengabdian masyarakat. Saat ini Klik Farmasi fokus
                                pada edukasi penyakit tidak menular, khususnya hipertensi, melalui penyediaan informasi dan
                                fitur pengingat minum obat, guna membantu pengelolaan kesehatan masyarakat Indonesia.</p>
                            <div class="row mt-4">
                                <div class="col-md-6 mb-4">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                                style="width:50px;height:50px;"><i
                                                    class="bi bi-lightbulb text-white fs-4"></i></div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="fw-bold">Visi</h5>
                                            <p class="text-dark mb-0">Menjadi platform edukasi kesehatan digital terdepan
                                                berbasis riset, yang berkontribusi pada upaya pencegahan dan pengelolaan
                                                penyakit tidak menular (NCDs), khususnya hipertensi, serta mendukung
                                                pencapaian Universitas Alma Ata sebagai teaching research university berdaya
                                                saing global.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                                style="width:50px;height:50px;"><i
                                                    class="bi bi-bullseye text-white fs-4"></i></div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="fw-bold">Misi</h5>
                                            <p class="text-dark mb-0">1. Menyediakan informasi kesehatan berbasis bukti
                                                (evidence-based) yang akurat, mudah dipahami, dan dapat diakses oleh semua
                                                kalangan masyarakat.<br><br>2. Mengembangkan dan mengimplementasikan
                                                fitur-fitur inovatif untuk membantu pasien dalam pengelolaan hipertensi dan
                                                penyakit tidak menular lainnya.<br><br>3. Mendorong kolaborasi antara
                                                sivitas akademika dan masyarakat guna menghasilkan solusi kesehatan yang
                                                aplikatif dan responsif terhadap isu kesehatan nasional.<br><br>4. Mendukung
                                                aktivitas pendidikan, penelitian, dan pengabdian Program Studi S1 Farmasi
                                                Universitas Alma Ata untuk kebermanfaatan masyarakat luas.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12">
                    <div class="section-header text-center mb-4" data-aos="fade-up">
                        <h3 class="section-title">Dosen Pembimbing</h3>
                        <p class="section-subtitle" style="max-width: 1200px;">Dosen pembimbing dalam proyek prototipe
                            website Klik Farmasi adalah akademisi dari Program Studi Sarjana (S1) Farmasi Universitas Alma
                            Ata yang berperan memastikan kualitas dan akurasi konten edukasi kesehatan. Dengan pengetahuan
                            dan pengalaman di bidang farmasi, dosen memberikan bimbingan dan arahan ilmiah kepada tim
                            pengembang selama proses pengembangan platform website Klik Farmasi.</p>
                    </div>
                    <div class="supervisor-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-body p-4">
                            <div class="supervisor-badge"><span>Pembimbing I</span></div>
                            <div class="row align-items-center">
                                <div class="col-md-3 text-center mb-4 mb-md-0">
                                    <div class="supervisor-photo"><img
                                            src="{{ asset('assets/tim/Foto Dosen apt.Nurul Kusumawardani.jpg') }}"
                                            alt="Apt. Nurul Kusumawardani, M.farm - Dosen Pembimbing I Program Studi Farmasi"
                                            class="img-fluid lazy-image" loading="lazy" decoding="async" width="150"
                                            height="150">
                                        <div class="photo-overlay"><i class="bi bi-mortarboard"></i></div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="supervisor-info">
                                        <h4 class="supervisor-name">Apt. Nurul Kusumawardani, M.farm</h4>
                                        <p class="supervisor-position">Dosen Program Studi Farmasi Universitas Alma Ata</p>
                                        <p class="supervisor-description">Dosen pembimbing yang memberikan arahan dan
                                            bimbingan dalam pengembangan platform Klik Farmasi sebagai media edukasi
                                            hipertensi dan pengingat obat.</p>
                                        <div class="supervisor-credentials"><span class="credential-badge"><i
                                                    class="bi bi-award me-1"></i>Apoteker</span><span
                                                class="credential-badge"><i class="bi bi-mortarboard me-1"></i>Dosen</span>
                                        </div>
                                        <div class="supervisor-contact"><a
                                                href="https://www.linkedin.com/in/nurul-kusumawardani-3623b2135/"
                                                class="contact-btn linkedin"><i class="bi bi-linkedin"></i></a><a
                                                href="mailto:nurul.kusumawardani@almaata.ac.id" class="contact-btn email"><i
                                                    class="bi bi-envelope"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="supervisor-card mt-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-body p-4">
                            <div class="supervisor-badge"><span>Pembimbing II</span></div>
                            <div class="row align-items-center">
                                <div class="col-md-3 text-center mb-4 mb-md-0">
                                    <div class="supervisor-photo"><img
                                            src="{{ asset('assets/tim/Foto Dosen apt.Danang Prasetyaning Amukti.jpeg') }}"
                                            alt="apt. Danang Prasetyaning Amukti, M.Farm - Dosen Pembimbing II Program Studi Farmasi"
                                            class="img-fluid lazy-image" loading="lazy" decoding="async" width="150"
                                            height="150" style="object-position:top">
                                        <div class="photo-overlay"><i class="bi bi-mortarboard"></i></div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="supervisor-info">
                                        <h4 class="supervisor-name">apt. Danang Prasetyaning Amukti, M.Farm</h4>
                                        <p class="supervisor-position">Dosen Program Studi Farmasi Universitas Alma Ata</p>
                                        <p class="supervisor-description">Dosen pembimbing yang memberikan arahan dan
                                            bimbingan dalam pengembangan platform Klik Farmasi sebagai media edukasi
                                            hipertensi dan pengingat obat.</p>
                                        <div class="supervisor-credentials"><span class="credential-badge"><i
                                                    class="bi bi-award me-1"></i>Apoteker</span><span
                                                class="credential-badge"><i
                                                    class="bi bi-mortarboard me-1"></i>Dosen</span>
                                        </div>
                                        <div class="supervisor-contact"><a
                                                href="https://www.linkedin.com/in/danang-prasetya-a48076173/"
                                                class="contact-btn linkedin"><i class="bi bi-linkedin"></i></a><a
                                                href="mailto:danangpa@almaata.ac.id" class="contact-btn email"><i
                                                    class="bi bi-envelope"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="supervisor-card mt-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-body p-4">
                            <div class="supervisor-badge"><span>Programmer</span></div>
                            <div class="row align-items-center">
                                <div class="col-md-3 text-center mb-4 mb-md-0">
                                    <div class="supervisor-photo"><img src="{{ asset('assets/tim/Aizan.jpg') }}"
                                            alt="Aizan Syalim - Programmer Website Klik Farmasi"
                                            class="img-fluid lazy-image" loading="lazy" decoding="async" width="150"
                                            height="150" style="object-position: top">
                                        <div class="photo-overlay"><i class="bi bi-code-slash"></i></div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="supervisor-info">
                                        <h4 class="supervisor-name">Aizan Syalim</h4>
                                        <p class="supervisor-position">Mahasiswa Informatika Universitas Alma Ata</p>
                                        <p class="supervisor-description">Programmer yang bertanggung jawab dalam
                                            pengembangan teknis website Klik Farmasi, mulai dari desain database, backend
                                            development, hingga implementasi fitur-fitur interaktif.</p>
                                        <div class="supervisor-credentials"><span class="credential-badge"><i
                                                    class="bi bi-code-slash me-1"></i>Programmer</span><span
                                                class="credential-badge"><i
                                                    class="bi bi-mortarboard me-1"></i>Mahasiswa</span>
                                        </div>
                                        <div class="supervisor-contact"><a href="https://www.instagram.com/zansylm/"
                                                class="social-btn instagram"><i class="bi bi-instagram"></i></a><a
                                                href="mailto:223200231@almaata.ac.id" class="contact-btn email"><i
                                                    class="bi bi-envelope"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12">
                    <div class="section-header text-center mb-5" data-aos="fade-up">
                        <div class="team-icon mb-4"><i class="bi bi-people-fill"></i></div>
                        <h3 class="section-title">Tim Mahasiswa</h3>
                        <p class="section-subtitle">Mahasiswa farmasi yang berdedikasi dalam pengembangan platform
                            kesehatan</p>
                        <div class="title-divider mx-auto"></div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="team-member-card" data-aos="fade-up" data-aos-delay="100">
                                <div class="member-photo-container"><img
                                        src="{{ asset('assets/tim/Farmasi Abdi Sugeng P_BG merah.jpeg') }}"
                                        alt="Abdi Sugeng Pangestu" class="member-photo lazy-image" loading="lazy"
                                        decoding="async" width="120" height="120"></div>
                                <div class="member-info">
                                    <div class="role-badge leader"><i class="bi bi-star-fill"></i><span>Ketua Tim</span>
                                    </div>
                                    <h4 class="member-name">Abdi Sugeng Pangestu</h4>
                                    <p class="member-id">220500396</p>
                                    <p class="member-description">Mahasiswa Farmasi yang berkontribusi dalam platform
                                        pengembangan website Klik farmasi dan informasi kesehatan</p>
                                    <div class="member-social"><a
                                            href="https://www.instagram.com/abdisugeng_01/?igsh=MThkaW5vNWo4ZnJtMw%3D%3D#"
                                            class="social-btn instagram" title="Instagram"><i
                                                class="bi bi-instagram"></i></a><a href="mailto:220500396@almaata.ac.id"
                                            class="social-btn email" title="Email"><i class="bi bi-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="team-member-card" data-aos="fade-up" data-aos-delay="200">
                                <div class="member-photo-container"><img
                                        src="{{ asset('assets/tim/Farmasi_Zona Aulia Nafaza.jpg') }}"
                                        alt="Zona Aulia Nafaza" class="member-photo"></div>
                                <div class="member-info">
                                    <div class="role-badge member"><i class="bi bi-person-fill"></i><span>Anggota
                                            Tim</span></div>
                                    <h4 class="member-name">Zona Aulia Nafaza</h4>
                                    <p class="member-id">220500571</p>
                                    <p class="member-description">Mahasiswa Farmasi yang berkontribusi dalam platform
                                        pengembangan website Klik farmasi dan informasi kesehatan</p>
                                    <div class="member-social"><a
                                            href="https://www.instagram.com/zonaaulia_?igsh=c2NrMm8wdjVmYTJp"
                                            class="social-btn instagram" title="Instagram"><i
                                                class="bi bi-instagram"></i></a><a href="mailto:220500571@almaata.ac.id"
                                            class="social-btn email" title="Email"><i class="bi bi-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="team-member-card" data-aos="fade-up" data-aos-delay="300">
                                <div class="member-photo-container"><img
                                        src="{{ asset('assets/tim/Farmasi_Luri pijria.JPG') }}"
                                        alt="Luri Pijria Diningsih" class="member-photo"></div>
                                <div class="member-info">
                                    <div class="role-badge member"><i class="bi bi-person-fill"></i><span>Anggota
                                            Tim</span></div>
                                    <h4 class="member-name">Luri Pijria Diningsih</h4>
                                    <p class="member-id">220500534</p>
                                    <p class="member-description">Mahasiswa Farmasi yang berkontribusi dalam platform
                                        pengembangan website Klik farmasi dan informasi kesehatan</p>
                                    <div class="member-social"><a
                                            href="https://www.instagram.com/lurifjr_?igsh=enlmMGIxaWZ3OWN2"
                                            class="social-btn instagram" title="Instagram"><i
                                                class="bi bi-instagram"></i></a><a href="mailto:220500534@almaata.ac.id"
                                            class="social-btn email" title="Email"><i class="bi bi-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="team-member-card" data-aos="fade-up" data-aos-delay="400">
                                <div class="member-photo-container"><img
                                        src="{{ asset('assets/tim/Farmasi_Desti Nadia.JPG') }}" alt="Desti Nadia"
                                        class="member-photo"></div>
                                <div class="member-info">
                                    <div class="role-badge member"><i class="bi bi-person-fill"></i><span>Anggota
                                            Tim</span></div>
                                    <h4 class="member-name">Desti Nadia</h4>
                                    <p class="member-id">220500420</p>
                                    <p class="member-description">Mahasiswa Farmasi yang berkontribusi dalam platform
                                        pengembangan website Klik farmasi dan informasi kesehatan</p>
                                    <div class="member-social"><a
                                            href="https://www.instagram.com/_nadineee13?igsh=MWxucGl2NXk3eXN0ZA%3D%3D&utm_source=qr"
                                            class="social-btn instagram" title="Instagram"><i
                                                class="bi bi-instagram"></i></a><a href="mailto:220500420@almaata.ac.id"
                                            class="social-btn email" title="Email"><i class="bi bi-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="team-member-card" data-aos="fade-up" data-aos-delay="500">
                                <div class="member-photo-container"><img
                                        src="{{ asset('assets/tim/Farmasi_Yulia mita.jpg') }}"
                                        alt="Yulia Mita Widyaningrum" class="member-photo"></div>
                                <div class="member-info">
                                    <div class="role-badge member"><i class="bi bi-person-fill"></i><span>Anggota
                                            Tim</span></div>
                                    <h4 class="member-name">Yulia Mita Widyaningrum</h4>
                                    <p class="member-id">220500511</p>
                                    <p class="member-description">Mahasiswa Farmasi yang berkontribusi dalam platform
                                        pengembangan website Klik farmasi dan informasi kesehatan</p>
                                    <div class="member-social"><a
                                            href="https://www.instagram.com/_twilightrippl/profilecard/?igsh=MWE4ejVyZ252MDl1OQ%3D%3D"
                                            class="social-btn instagram" title="Instagram"><i
                                                class="bi bi-instagram"></i></a><a href="mailto:220500511@almaata.ac.id"
                                            class="social-btn email" title="Email"><i class="bi bi-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="team-member-card" data-aos="fade-up" data-aos-delay="600">
                                <div class="member-photo-container"><img
                                        src="{{ asset('assets/tim/Farmasi_Febby Trianingsih.JPG') }}"
                                        alt="Febby Trianingsih" class="member-photo"></div>
                                <div class="member-info">
                                    <div class="role-badge member"><i class="bi bi-person-fill"></i><span>Anggota
                                            Tim</span></div>
                                    <h4 class="member-name">Febby Trianingsih</h4>
                                    <p class="member-id">220500526</p>
                                    <p class="member-description">Mahasiswa Farmasi yang berkontribusi dalam platform
                                        pengembangan website Klik farmasi dan informasi kesehatan</p>
                                    <div class="member-social"><a
                                            href="https://www.instagram.com/fbbytrii_/?igsh=MTZiZ3FobTh2bmRwcw%3D%3D#"
                                            class="social-btn instagram" title="Instagram"><i
                                                class="bi bi-instagram"></i></a><a href="mailto:220500526@almaata.ac.id"
                                            class="social-btn email" title="Email"><i class="bi bi-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="team-member-card" data-aos="fade-up" data-aos-delay="700">
                                <div class="member-photo-container"><img
                                        src="{{ asset('assets/tim/Farmasi_Adindaputriibdaniya.jpg') }}"
                                        alt="Adinda Putri Ibdaniya" class="member-photo"></div>
                                <div class="member-info">
                                    <div class="role-badge member"><i class="bi bi-person-fill"></i><span>Anggota
                                            Tim</span></div>
                                    <h4 class="member-name">Adinda Putri Ibdaniya</h4>
                                    <p class="member-id">220500402</p>
                                    <p class="member-description">Mahasiswa Farmasi yang berkontribusi dalam platform
                                        pengembangan website Klik farmasi dan informasi kesehatan</p>
                                    <div class="member-social"><a
                                            href="https://www.instagram.com/adindaptribrhm/?igsh=enZnd2RuYmg2bWt0&utm_source=qr#"
                                            class="social-btn instagram" title="Instagram"><i
                                                class="bi bi-instagram"></i></a><a href="mailto:220500402@almaata.ac.id"
                                            class="social-btn email" title="Email"><i class="bi bi-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="team-member-card" data-aos="fade-up" data-aos-delay="800">
                                <div class="member-photo-container"><img
                                        src="{{ asset('assets/tim/Farmasi_Enzelika.jpg') }}" alt="Enzelika"
                                        class="member-photo"></div>
                                <div class="member-info">
                                    <div class="role-badge member"><i class="bi bi-person-fill"></i><span>Anggota
                                            Tim</span></div>
                                    <h4 class="member-name">Enzelika</h4>
                                    <p class="member-id">220500429</p>
                                    <p class="member-description">Mahasiswa Farmasi yang berkontribusi dalam platform
                                        pengembangan website Klik farmasi dan informasi kesehatan</p>
                                    <div class="member-social"><a
                                            href="https://www.instagram.com/_azzjell/?igsh=N3Y2amZwd29jN2dq&utm_source=qr#"
                                            class="social-btn instagram" title="Instagram"><i
                                                class="bi bi-instagram"></i></a><a href="mailto:220500429@almaata.ac.id"
                                            class="social-btn email" title="Email"><i class="bi bi-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="team-member-card" data-aos="fade-up" data-aos-delay="900">
                                <div class="member-photo-container"><img
                                        src="{{ asset('assets/tim/Farmasi_Nia Uswatun Khasanah.jpg') }}"
                                        alt="Nia Uswatun Khasanah" class="member-photo"></div>
                                <div class="member-info">
                                    <div class="role-badge member"><i class="bi bi-person-fill"></i><span>Anggota
                                            Tim</span></div>
                                    <h4 class="member-name">Nia Uswatun Khasanah</h4>
                                    <p class="member-id">220500470</p>
                                    <p class="member-description">Mahasiswa Farmasi yang berkontribusi dalam platform
                                        pengembangan website Klik farmasi dan informasi kesehatan</p>
                                    <div class="member-social"><a
                                            href="https://www.instagram.com/niauswa_/profilecard/?igsh=MWw4d2Jtamw1aWhpZA%3D%3D"
                                            class="social-btn instagram" title="Instagram"><i
                                                class="bi bi-instagram"></i></a><a href="mailto:220500470@almaata.ac.id"
                                            class="social-btn email" title="Email"><i class="bi bi-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="team-member-card" data-aos="fade-up" data-aos-delay="1000">
                                <div class="member-photo-container"><img
                                        src="{{ asset('assets/tim/Farmasi_Camelia.JPG') }}"
                                        alt="Camelia Rohayya C. Barus" class="member-photo"></div>
                                <div class="member-info">
                                    <div class="role-badge member"><i class="bi bi-person-fill"></i><span>Anggota
                                            Tim</span></div>
                                    <h4 class="member-name">Camelia Rohayya C. Barus</h4>
                                    <p class="member-id">210500345</p>
                                    <p class="member-description">Mahasiswa Farmasi yang berkontribusi dalam platform
                                        pengembangan website Klik farmasi dan informasi kesehatan</p>
                                    <div class="member-social"><a
                                            href="https://www.instagram.com/camelia.rohayya_/?igsh=dHo2Y3dqcDI3dHd0#"
                                            class="social-btn instagram" title="Instagram"><i
                                                class="bi bi-instagram"></i></a><a href="mailto:210500345@almaata.ac.id"
                                            class="social-btn email" title="Email"><i class="bi bi-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="team-member-card" data-aos="fade-up" data-aos-delay="1100">
                                <div class="member-photo-container"><img
                                        src="{{ asset('assets/tim/Farmasi_Deswita Vira Adzani PNG.png') }}"
                                        alt="Deswita Vira Adzani" class="member-photo"></div>
                                <div class="member-info">
                                    <div class="role-badge member"><i class="bi bi-person-fill"></i><span>Anggota
                                            Tim</span></div>
                                    <h4 class="member-name">Deswita Vira Adzani</h4>
                                    <p class="member-id">220500421</p>
                                    <p class="member-description">Mahasiswa Farmasi yang berkontribusi dalam platform
                                        pengembangan website Klik farmasi dan informasi kesehatan</p>
                                    <div class="member-social"><a
                                            href="https://www.instagram.com/deswitadzni_/?igsh=aXFlYmo5cmM0NmU5&utm_source=qr#"
                                            class="social-btn instagram" title="Instagram"><i
                                                class="bi bi-instagram"></i></a><a href="mailto:220500421@almaata.ac.id"
                                            class="social-btn email" title="Email"><i class="bi bi-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="team-member-card" data-aos="fade-up" data-aos-delay="1200">
                                <div class="member-photo-container"><img
                                        src="{{ asset('assets/tim/Farmasi_Elda Samsudin.png') }}" alt="Elda Samsudin"
                                        class="member-photo"></div>
                                <div class="member-info">
                                    <div class="role-badge member"><i class="bi bi-person-fill"></i><span>Anggota
                                            Tim</span></div>
                                    <h4 class="member-name">Elda Samsudin</h4>
                                    <p class="member-id">220500428</p>
                                    <p class="member-description">Mahasiswa Farmasi yang berkontribusi dalam platform
                                        pengembangan website Klik farmasi dan informasi kesehatan</p>
                                    <div class="member-social"><a
                                            href="https://www.instagram.com/starlight_783/?igsh=MWxpd25ycTRxajZ3dw%3D%3D#"
                                            class="social-btn instagram" title="Instagram"><i
                                                class="bi bi-instagram"></i></a><a href="mailto:220500428@almaata.ac.id"
                                            class="social-btn email" title="Email"><i class="bi bi-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
