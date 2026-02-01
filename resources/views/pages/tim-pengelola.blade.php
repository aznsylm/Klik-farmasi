@extends('layouts.app')
@section('title', 'Tim Pengelola - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Kenali tim pengelola Klik Farmasi dari tim farmasi Universitas Alma Ata. Dosen pembimbing dan mahasiswa yang mengelola platform kesehatan digital.">
    <meta name="keywords"
        content="tim klik farmasi, mahasiswa farmasi UAA, dosen pembimbing, universitas alma ata, tim pengembang">
    <meta name="author" content="Tim Farmasi Universitas Alma Ata">

    <style>
        /* Team Grid Styles */
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .team-card {
            background: #E3F2FD;
            border-radius: 5px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .team-photo {
            margin-bottom: 1rem;
        }

        .team-photo img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            object-position: top;
            border: 3px solid #1976d2;
            transition: transform 0.3s ease;
        }

        .team-photo img:hover {
            transform: scale(1.1);
        }

        .team-info {
            text-align: center;
        }

        .team-name {
            font-size: 1.1rem;
            font-weight: bold;
            color: #1976d2;
            margin-bottom: 0.5rem;
        }

        .team-id {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.75rem;
            text-align: center;
        }

        .team-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #1976d2;
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .team-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 1rem;
            }

            .team-card {
                padding: 1rem;
            }

            .team-photo img {
                width: 80px;
                height: 80px;
                object-position: top;
            }

            .team-name {
                font-size: 1rem;
            }

            .team-badge {
                font-size: 0.75rem;
                padding: 0.3rem 0.6rem;
            }
        }

        @media (max-width: 480px) {
            .team-grid {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }

            .team-card {
                padding: 0.75rem;
            }

            .team-photo img {
                width: 70px;
                height: 70px;
                object-position: top;
            }

            .team-name {
                font-size: 0.9rem;
            }

            .team-id {
                font-size: 0.8rem;
            }

            .team-badge {
                font-size: 0.7rem;
                padding: 0.25rem 0.5rem;
            }
        }
    </style>
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
                    <div class="card border-0 shadow-sm" style="background-color: #E3F2FD; border-radius: 5px;">
                        <div class="card-body p-4">
                            <h3 class="fw-bold mb-3 text-primary text-start">Tentang Website Klik-Farmasi</h3>
                            <p class="text-dark mb-4">Klik Farmasi merupakan platform asuhan kefarmasian yang kelola oleh
                                Dosen dan mahasiswa Program Studi S1 Farmasi Universitas Alma Ata sebagai wujud kontribusi
                                dalam bidang pendidikan, penelitian, dan pengabdian masyarakat. Saat ini Klik Farmasi fokus
                                pada edukasi penyakit tidak menular, khususnya hipertensi, melalui penyediaan informasi dan
                                fitur pengingat minum obat, guna membantu pengelolaan kesehatan masyarakat Indonesia.</p>

                            <h3 class="fw-bold mb-3 text-primary text-start">Visi</h3>
                            <p class="text-dark mb-4">Menjadi platform edukasi kesehatan digital terdepan
                                berbasis riset, yang berkontribusi pada upaya pencegahan dan pengelolaan
                                penyakit tidak menular (NCDs), khususnya hipertensi, serta mendukung
                                pencapaian Universitas Alma Ata sebagai teaching research university berdaya
                                saing global.</p>

                            <h3 class="fw-bold mb-3 text-primary text-start">Misi</h3>
                            <div class="text-dark">
                                <p class="mb-2"><strong>1.</strong> Menyediakan informasi kesehatan berbasis bukti
                                    (evidence-based) yang akurat, mudah dipahami, dan dapat diakses oleh semua
                                    kalangan masyarakat.</p>
                                <p class="mb-2"><strong>2.</strong> Mengembangkan dan mengimplementasikan
                                    fitur-fitur inovatif untuk membantu pasien dalam pengelolaan hipertensi dan
                                    penyakit tidak menular lainnya.</p>
                                <p class="mb-2"><strong>3.</strong> Mendorong kolaborasi antara
                                    sivitas akademika dan masyarakat guna menghasilkan solusi kesehatan yang
                                    aplikatif dan responsif terhadap isu kesehatan nasional.</p>
                                <p class="mb-0"><strong>4.</strong> Mendukung
                                    aktivitas pendidikan, penelitian, dan pengabdian Program Studi S1 Farmasi
                                    Universitas Alma Ata untuk kebermanfaatan masyarakat luas.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12">
                    <div class="text-center mb-4" data-aos="fade-up">
                        <h3 class="section-title">Tim Pembimbing</h3>
                        <p class="section-subtitle">Dosen pembimbing dan programmer website Klik Farmasi</p>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100"
                                style="background-color: #E3F2FD; border-radius: 5px;">
                                <div class="card-body text-center p-4">
                                    <img src="{{ asset('assets/tim/Foto Dosen apt.Nurul Kusumawardani.jpg') }}"
                                        alt="Apt. Nurul Kusumawardani, M.farm" class="rounded-circle mb-3 carousel-img"
                                        width="80" height="80"
                                        style="object-fit: cover; object-position: top; cursor: pointer;">
                                    <h5 class="fw-bold text-primary mb-2">Apt. Nurul Kusumawardani, M.farm</h5>
                                    <p class="text-muted mb-3 text-center">Dosen Pembimbing I</p>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="https://www.linkedin.com/in/nurul-kusumawardani-3623b2135/"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-linkedin"></i>
                                        </a>
                                        <a href="mailto:nurul.kusumawardani@almaata.ac.id"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-envelope"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100"
                                style="background-color: #E3F2FD; border-radius: 5px;">
                                <div class="card-body text-center p-4">
                                    <img src="{{ asset('assets/tim/Foto Dosen apt.Danang Prasetyaning Amukti.jpeg') }}"
                                        alt="apt. Danang Prasetyaning Amukti, M.Farm"
                                        class="rounded-circle mb-3 carousel-img" width="80" height="80"
                                        style="object-fit: cover; object-position: top; cursor: pointer;">
                                    <h5 class="fw-bold text-primary mb-2">apt. Danang Prasetyaning Amukti, M.Farm</h5>
                                    <p class="text-muted mb-3 text-center">Dosen Pembimbing II</p>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="https://www.linkedin.com/in/danang-prasetya-a48076173/"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-linkedin"></i>
                                        </a>
                                        <a href="mailto:danangpa@almaata.ac.id" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-envelope"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100"
                                style="background-color: #E3F2FD; border-radius: 5px;">
                                <div class="card-body text-center p-4">
                                    <img src="{{ asset('assets/tim/Aizan.jpg') }}" alt="Aizan Syalim"
                                        class="rounded-circle mb-3 carousel-img" width="80" height="80"
                                        style="object-fit: cover; object-position: top; cursor: pointer;">
                                    <h5 class="fw-bold text-primary mb-2">Aizan Syalim</h5>
                                    <p class="text-muted mb-3 text-center">Programmer Website</p>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="https://www.instagram.com/zansylm/" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-instagram"></i>
                                        </a>
                                        <a href="mailto:223200231@almaata.ac.id" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-envelope"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12">
                    <div class="text-center mb-4" data-aos="fade-up">
                        <h3 class="section-title">Tim Mahasiswa</h3>
                        <p class="section-subtitle">Mahasiswa farmasi yang aktif mengelola website Klik Farmasi</p>
                    </div>

                    <!-- Team Members Cards -->
                    <div class="team-grid">
                        @php
                            $teamMembers = [
                                [
                                    'name' => 'Abdi Sugeng Pangestu',
                                    'id' => '220500396',
                                    'photo' => 'assets/tim/Farmasi Abdi Sugeng P_BG merah.jpeg',
                                ],
                                [
                                    'name' => 'Zona Aulia Nafaza',
                                    'id' => '220500571',
                                    'photo' => 'assets/tim/Farmasi_Zona Aulia Nafaza.jpg',
                                ],
                                [
                                    'name' => 'Luri Pijria Diningsih',
                                    'id' => '220500534',
                                    'photo' => 'assets/tim/Farmasi_Luri pijria.JPG',
                                ],
                                [
                                    'name' => 'Desti Nadia',
                                    'id' => '220500420',
                                    'photo' => 'assets/tim/Farmasi_Desti Nadia.JPG',
                                ],
                                [
                                    'name' => 'Yulia Mita Widyaningrum',
                                    'id' => '220500511',
                                    'photo' => 'assets/tim/Farmasi_Yulia mita.jpg',
                                ],
                                [
                                    'name' => 'Febby Trianingsih',
                                    'id' => '220500526',
                                    'photo' => 'assets/tim/Farmasi_Febby Trianingsih.JPG',
                                ],
                                [
                                    'name' => 'Adinda Putri Ibdaniya',
                                    'id' => '220500402',
                                    'photo' => 'assets/tim/Farmasi_Adindaputriibdaniya.jpg',
                                ],
                                [
                                    'name' => 'Enzelika',
                                    'id' => '220500429',
                                    'photo' => 'assets/tim/Farmasi_Enzelika.jpg',
                                ],
                                [
                                    'name' => 'Nia Uswatun Khasanah',
                                    'id' => '220500470',
                                    'photo' => 'assets/tim/Farmasi_Nia Uswatun Khasanah.jpg',
                                ],
                                [
                                    'name' => 'Camelia Rohayya C. Barus',
                                    'id' => '210500345',
                                    'photo' => 'assets/tim/Farmasi_Camelia.JPG',
                                ],
                                [
                                    'name' => 'Deswita Vira Adzani',
                                    'id' => '220500421',
                                    'photo' => 'assets/tim/Farmasi_Deswita Vira Adzani PNG.png',
                                ],
                                [
                                    'name' => 'Elda Samsudin',
                                    'id' => '220500428',
                                    'photo' => 'assets/tim/Farmasi_Elda Samsudin.png',
                                ],
                            ];
                        @endphp

                        @foreach ($teamMembers as $member)
                            <div class="team-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                                <div class="team-photo">
                                    <img src="{{ asset($member['photo']) }}" alt="{{ $member['name'] }}"
                                        class="carousel-img" style="cursor: pointer;">
                                </div>
                                <div class="team-info">
                                    <h5 class="team-name">{{ $member['name'] }}</h5>
                                    <p class="team-id">{{ $member['id'] }}</p>
                                    <div class="team-badge">
                                        <i class="bi bi-mortarboard"></i>
                                        <span>Mahasiswa Farmasi</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0 text-center">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                        data-bs-dismiss="modal" style="z-index: 1050;"></button>
                    <img id="modalImage" src="" alt="" class="img-fluid rounded"
                        style="max-height: 90vh;">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            const modalImage = document.getElementById('modalImage');

            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('carousel-img') && e.target.src) {
                    modalImage.src = e.target.src;
                    modalImage.alt = e.target.alt;
                    modal.show();
                }
            });
        });
    </script>
@endpush
