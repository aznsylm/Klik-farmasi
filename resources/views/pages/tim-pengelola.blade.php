@extends('layouts.app')
@section('title', 'Tim Pengelola')
@section('content')
    <style>
        .team-section {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%)
        }

        .team-header-icon,
        .team-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #0b5e91 0%, #1a6fa0 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 8px 25px rgba(11, 94, 145, .3)
        }

        .team-header-icon i,
        .team-icon i {
            font-size: 2rem;
            color: white
        }

        .team-title {
            color: #0b5e91;
            font-size: 2.5rem;
            font-weight: 800
        }

        .team-subtitle {
            color: #6c757d;
            font-size: 1.1rem;
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto
        }

        .title-divider {
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #0b5e91, #baa971);
            border-radius: 2px
        }

        .supervisor-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .08);
            transition: all .3s ease;
            overflow: hidden;
            margin-bottom: 1.5rem
        }

        .supervisor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, .15)
        }

        .supervisor-badge {
            position: absolute;
            top: 0;
            right: 0;
            background: linear-gradient(135deg, #baa971 0%, #d4c589 100%);
            color: white;
            padding: .5rem 1rem;
            border-radius: 0 16px 0 16px;
            font-weight: 600;
            font-size: .85rem
        }

        .supervisor-photo {
            position: relative;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .2)
        }

        .supervisor-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center
        }

        .photo-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(11, 94, 145, .8);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity .3s ease
        }

        .supervisor-photo:hover .photo-overlay {
            opacity: 1
        }

        .photo-overlay i {
            font-size: 2rem;
            color: white
        }

        .supervisor-name {
            color: #0b5e91;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: .5rem
        }

        .supervisor-position {
            color: #baa971;
            font-weight: 600;
            margin-bottom: 1rem
        }

        .supervisor-description {
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 1.5rem
        }

        .supervisor-credentials {
            display: flex;
            flex-wrap: wrap;
            gap: .5rem;
            margin-bottom: 1rem
        }

        .credential-badge {
            background: rgba(11, 94, 145, .1);
            color: #0b5e91;
            padding: .25rem .75rem;
            border-radius: 20px;
            font-size: .8rem;
            font-weight: 600
        }

        .supervisor-contact {
            display: flex;
            gap: .75rem
        }

        .contact-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all .3s ease;
            font-size: 1.1rem
        }

        .contact-btn.linkedin {
            background: #0077b5;
            color: white
        }

        .contact-btn.email {
            background: #ea4335;
            color: white
        }

        .contact-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, .3);
            color: white
        }

        .section-header {
            margin-bottom: 2rem
        }

        .section-title {
            color: #0b5e91;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: .5rem
        }

        .section-subtitle {
            color: #6c757d;
            font-size: 1rem;
            line-height: 1.6
        }

        .team-member-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .08);
            transition: all .3s ease;
            overflow: hidden;
            height: 100%;
            position: relative
        }

        .team-member-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, .15)
        }

        .member-photo-container {
            position: relative;
            width: 140px;
            height: 140px;
            margin: 1.5rem auto 1rem;
            border-radius: 50%;
            overflow: hidden;
            background: #f8f9fa;
        }

        .member-photo {
            width: 140px;
            height: 140px;
            object-fit: cover;
            object-position: top;
            transition: transform .3s ease;
            display: block;
            border-radius: 50%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .team-member-card:hover .member-photo {
            transform: scale(1.05)
        }

        /* Force circular crop */
        .member-photo-container {
            clip-path: circle(50%);
        }

        .member-photo-container::after {
            content: '';
            position: absolute;
            top: -4px;
            left: -4px;
            right: -4px;
            bottom: -4px;
            border: 4px solid #fff;
            border-radius: 50%;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .2);
            pointer-events: none;
        }

        .member-info {
            padding: 1.5rem;
            text-align: center
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .4rem .8rem;
            border-radius: 20px;
            font-size: .75rem;
            font-weight: 600;
            margin-bottom: 1rem
        }

        .role-badge.leader {
            background: linear-gradient(135deg, #baa971 0%, #d4c589 100%);
            color: white
        }

        .role-badge.member {
            background: rgba(11, 94, 145, .1);
            color: #0b5e91
        }

        .role-badge.programmer {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white
        }

        .member-name {
            color: #0b5e91;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: .25rem
        }

        .member-id {
            color: #baa971;
            font-weight: 600;
            font-size: .9rem;
            margin-bottom: .5rem
        }

        .member-description {
            color: #6c757d;
            font-size: .85rem;
            line-height: 1.5;
            margin-bottom: 1rem
        }

        .member-social {
            display: flex;
            justify-content: center;
            gap: .5rem
        }

        .social-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all .3s ease;
            font-size: 1rem
        }

        .social-btn.instagram {
            background: linear-gradient(135deg, #e4405f 0%, #f56040 100%);
            color: white
        }

        .social-btn.email {
            background: #ea4335;
            color: white
        }

        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, .3);
            color: white
        }

        @media (max-width:768px) {
            .team-title {
                font-size: 2rem
            }

            .supervisor-photo {
                width: 120px;
                height: 120px
            }

            .supervisor-name {
                font-size: 1.3rem
            }

            .section-title {
                font-size: 1.75rem
            }

            .member-photo-container {
                width: 120px;
                height: 120px;
                border: 3px solid #fff;
                box-shadow: 0 6px 20px rgba(0, 0, 0, .15);
            }

            .member-info {
                padding: 1rem
            }

            .member-name {
                font-size: 1.1rem
            }
        }
    </style>
    <section class="team-section">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <div class="team-header-icon mb-4"><i class="bi bi-people-fill"></i></div>
                <h2 class="fw-bolder mb-3 team-title">Tim Pengelola Klik Farmasi</h2>
                <p class="mx-auto team-subtitle">Kenali tim mahasiswa Farmasi Universitas Alma Ata yang mengelola platform
                    ini</p>
                <div class="d-flex justify-content-center mt-3">
                    <div class="title-divider"></div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="fw-bold mb-4" style="color:#0b5e91">Tentang Proyek</h3>
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
                                                style="width:50px;height:50px"><i
                                                    class="bi bi-lightbulb text-white fs-4"></i></div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="fw-bold">Visi</h5>
                                            <p class="text-dark mb-0">Menjadi platform edukasi kesehatan terdepan yang
                                                membantu masyarakat dalam mengelola hipertensi dan meningkatkan kualitas
                                                hidup.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                                style="width:50px;height:50px"><i
                                                    class="bi bi-bullseye text-white fs-4"></i></div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="fw-bold">Misi</h5>
                                            <p class="text-dark mb-0">Menyediakan informasi kesehatan yang akurat, mudah
                                                dipahami, dan dapat diakses oleh semua kalangan masyarakat.</p>
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
                        <p class="section-subtitle">Tenaga ahli yang membimbing pengembangan platform</p>
                    </div>
                    <div class="supervisor-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-body p-4">
                            <div class="supervisor-badge"><span>Pembimbing I</span></div>
                            <div class="row align-items-center">
                                <div class="col-md-3 text-center mb-4 mb-md-0">
                                    <div class="supervisor-photo"><img
                                            src="{{ asset('assets/tim/Foto Dosen apt.Nurul Kusumawardani.jpg') }}"
                                            alt="Supervisor" class="img-fluid">
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
                                                class="credential-badge"><i class="bi bi-mortarboard me-1"></i>M.Farm</span>
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
                                            alt="Supervisor" class="img-fluid" style="object-position:top">
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
                                                class="credential-badge"><i class="bi bi-mortarboard me-1"></i>M.Farm</span>
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
                                        alt="Abdi Sugeng Pangestu" class="member-photo"></div>
                                <div class="member-info">
                                    <div class="role-badge leader"><i class="bi bi-star-fill"></i><span>Ketua Tim</span>
                                    </div>
                                    <h4 class="member-name">Abdi Sugeng Pangestu</h4>
                                    <p class="member-id">220500396</p>
                                    <p class="member-description">Mahasiswa Farmasi Universitas Alma Ata</p>
                                    <div class="member-social"><a href="#" class="social-btn instagram"
                                            title="Instagram"><i class="bi bi-instagram"></i></a><a
                                            href="mailto:220500396@almaata.ac.id" class="social-btn email"
                                            title="Email"><i class="bi bi-envelope"></i></a></div>
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
                                    <p class="member-description">Mahasiswa Farmasi Universitas Alma Ata</p>
                                    <div class="member-social"><a href="#" class="social-btn instagram"
                                            title="Instagram"><i class="bi bi-instagram"></i></a><a
                                            href="mailto:220500571@almaata.ac.id" class="social-btn email"
                                            title="Email"><i class="bi bi-envelope"></i></a></div>
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
                                    <p class="member-description">Mahasiswa Farmasi Universitas Alma Ata</p>
                                    <div class="member-social"><a href="#" class="social-btn instagram"
                                            title="Instagram"><i class="bi bi-instagram"></i></a><a
                                            href="mailto:220500534@almaata.ac.id" class="social-btn email"
                                            title="Email"><i class="bi bi-envelope"></i></a></div>
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
                                    <p class="member-description">Mahasiswa Farmasi Universitas Alma Ata</p>
                                    <div class="member-social"><a href="#" class="social-btn instagram"
                                            title="Instagram"><i class="bi bi-instagram"></i></a><a
                                            href="mailto:220500420@almaata.ac.id" class="social-btn email"
                                            title="Email"><i class="bi bi-envelope"></i></a></div>
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
                                    <p class="member-description">Mahasiswa Farmasi Universitas Alma Ata</p>
                                    <div class="member-social"><a href="#" class="social-btn instagram"
                                            title="Instagram"><i class="bi bi-instagram"></i></a><a
                                            href="mailto:220500511@almaata.ac.id" class="social-btn email"
                                            title="Email"><i class="bi bi-envelope"></i></a></div>
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
                                    <p class="member-description">Mahasiswa Farmasi Universitas Alma Ata</p>
                                    <div class="member-social"><a href="#" class="social-btn instagram"
                                            title="Instagram"><i class="bi bi-instagram"></i></a><a
                                            href="mailto:220500526@almaata.ac.id" class="social-btn email"
                                            title="Email"><i class="bi bi-envelope"></i></a></div>
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
                                    <p class="member-description">Mahasiswa Farmasi Universitas Alma Ata</p>
                                    <div class="member-social"><a href="#" class="social-btn instagram"
                                            title="Instagram"><i class="bi bi-instagram"></i></a><a
                                            href="mailto:220500402@almaata.ac.id" class="social-btn email"
                                            title="Email"><i class="bi bi-envelope"></i></a></div>
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
                                    <p class="member-description">Mahasiswa Farmasi Universitas Alma Ata</p>
                                    <div class="member-social"><a href="#" class="social-btn instagram"
                                            title="Instagram"><i class="bi bi-instagram"></i></a><a
                                            href="mailto:220500429@almaata.ac.id" class="social-btn email"
                                            title="Email"><i class="bi bi-envelope"></i></a></div>
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
                                    <p class="member-description">Mahasiswa Farmasi Universitas Alma Ata</p>
                                    <div class="member-social"><a href="#" class="social-btn instagram"
                                            title="Instagram"><i class="bi bi-instagram"></i></a><a
                                            href="mailto:220500470@almaata.ac.id" class="social-btn email"
                                            title="Email"><i class="bi bi-envelope"></i></a></div>
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
                                    <p class="member-description">Mahasiswa Farmasi Universitas Alma Ata</p>
                                    <div class="member-social"><a href="#" class="social-btn instagram"
                                            title="Instagram"><i class="bi bi-instagram"></i></a><a
                                            href="mailto:210500345@almaata.ac.id" class="social-btn email"
                                            title="Email"><i class="bi bi-envelope"></i></a></div>
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
                                    <p class="member-description">Mahasiswa Farmasi Universitas Alma Ata</p>
                                    <div class="member-social"><a href="#" class="social-btn instagram"
                                            title="Instagram"><i class="bi bi-instagram"></i></a><a
                                            href="mailto:220500421@almaata.ac.id" class="social-btn email"
                                            title="Email"><i class="bi bi-envelope"></i></a></div>
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
                                    <p class="member-description">Mahasiswa Farmasi Universitas Alma Ata</p>
                                    <div class="member-social"><a href="#" class="social-btn instagram"
                                            title="Instagram"><i class="bi bi-instagram"></i></a><a
                                            href="mailto:220500428@almaata.ac.id" class="social-btn email"
                                            title="Email"><i class="bi bi-envelope"></i></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="team-member-card" data-aos="fade-up" data-aos-delay="1300">
                                <div class="member-photo-container"><img src="{{ asset('assets/tim/Aizan.jpg') }}"
                                        alt="Aizan Syalim" class="member-photo"></div>
                                <div class="member-info">
                                    <div class="role-badge programmer"><i
                                            class="bi bi-code-slash"></i><span>Programmer</span></div>
                                    <h4 class="member-name">Aizan Syalim</h4>
                                    <p class="member-id">223200231</p>
                                    <p class="member-description">Mahasiswa Informatika Universitas Alma Ata</p>
                                    <div class="member-social"><a href="https://www.instagram.com/zansylm/"
                                            class="social-btn instagram" title="Instagram"><i
                                                class="bi bi-instagram"></i></a><a href="mailto:223200231@almaata.ac.id"
                                            class="social-btn email" title="Email"><i class="bi bi-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
</section>@endsection
