@extends('layouts.app')

@section('title', 'Artikel')

@section('content')
    <!-- Page Content -->
    <section class="py-5">
        <div class="container px-5">
            <h1 class="fw-bolder fs-5 mb-4">Artikel Terbaru</h1>
            <div class="card border-0 shadow rounded-3 overflow-hidden">
                <div class="card-body p-0">
                    <div class="row gx-0">
                        <div class="col-lg-6 col-xl-5 py-lg-5">
                            <div class="p-4 p-md-5">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">Berita</div>
                                <div class="h2 fw-bolder">Judul Artikel Utama</div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique delectus ab doloremque, qui doloribus ea officiis...</p>
                                <a class="stretched-link text-decoration-none" href="#!">
                                    Baca Selengkapnya
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-7">
                            <div class="bg-featured-blog" style="background-image: url('https://img.freepik.com/free-photo/male-doctor-hands-measuring-tension-patient_23-2148352060.jpg?uid=R156698331&ga=GA1.1.643065820.1722300477&semt=ais_hybrid&w=740')"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="py-5 bg-light">
        <div class="container px-5">
            <div class="row gx-5">
                <div class="col-xl-8">
                    <h2 class="fw-bolder fs-5 mb-4">Berita</h2>
                    <!-- News Item -->
                    <div class="mb-4">
                        <div class="small text-muted">12 Mei 2023</div>
                        <a class="link-dark" href="#!"><h3>Update Bootstrap 5 untuk Template dan Tema</h3></a>
                    </div>
                    <!-- News Item -->
                    <div class="mb-5">
                        <div class="small text-muted">5 Mei 2023</div>
                        <a class="link-dark" href="#!"><h3>Bootstrap 5 Resmi Dirilis</h3></a>
                    </div>
                    <!-- News Item -->
                    <div class="mb-5">
                        <div class="small text-muted">21 April 2023</div>
                        <a class="link-dark" href="#!"><h3>Artikel Berita Lainnya dengan Judul yang Lebih Panjang</h3></a>
                    </div>
                    <div class="text-end mb-5 mb-xl-0">
                        <a class="text-decoration-none" href="#!">
                            Berita Lainnya
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card border-0 h-100">
                        <div class="card-body p-4">
                            <div class="d-flex h-100 align-items-center justify-content-center">
                                <div class="text-center">
                                    <div class="h6 fw-bolder">Kontak</div>
                                    <p class="text-muted mb-4">
                                        Untuk pertanyaan pers, email kami di
                                        <br />
                                        <a href="mailto:press@domain.com">press@domain.com</a>
                                    </p>
                                    <div class="h6 fw-bolder">Ikuti Kami</div>
                                    <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-twitter"></i></a>
                                    <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-facebook"></i></a>
                                    <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-linkedin"></i></a>
                                    <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Preview Section -->
    <section class="py-5">
        <div class="container px-5">
            <h2 class="fw-bolder fs-5 mb-4">Cerita Pilihan</h2>
            <div class="row gx-5">
                {{-- Blog 1: Tips Menjaga Tekanan Darah Tetap Stabil --}}
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top" src="https://dummyimage.com/600x350/ced4da/6c757d" alt="..." />
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">Kesehatan</div>
                            <a class="text-decoration-none link-dark stretched-link" href="#!">
                                <div class="h5 card-title mb-3">Tips Menjaga Tekanan Darah Tetap Stabil</div>
                            </a>
                            <p class="card-text mb-0">Pelajari cara menjaga tekanan darah tetap stabil dengan pola makan sehat, olahraga, dan pengelolaan stres.</p>
                        </div>
                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d" alt="..." />
                                    <div class="small">
                                        <div class="fw-bold">Dr. Andi Wijaya</div>
                                        <div class="text-muted">April 15, 2025 &middot; 5 min read</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Blog 2: Pentingnya Minum Obat Hipertensi Tepat Waktu --}}
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top" src="https://dummyimage.com/600x350/adb5bd/495057" alt="..." />
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">Obat</div>
                            <a class="text-decoration-none link-dark stretched-link" href="#!">
                                <div class="h5 card-title mb-3">Pentingnya Minum Obat Hipertensi Tepat Waktu</div>
                            </a>
                            <p class="card-text mb-0">Ketahui mengapa minum obat hipertensi sesuai jadwal sangat penting untuk mencegah komplikasi serius.</p>
                        </div>
                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d" alt="..." />
                                    <div class="small">
                                        <div class="fw-bold">Dr. Siti Aminah</div>
                                        <div class="text-muted">April 10, 2025 &middot; 6 min read</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Blog 3: Makanan yang Harus Dihindari oleh Penderita Hipertensi --}}
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top" src="https://dummyimage.com/600x350/6c757d/343a40" alt="..." />
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">Gaya Hidup</div>
                            <a class="text-decoration-none link-dark stretched-link" href="#!">
                                <div class="h5 card-title mb-3">Makanan yang Harus Dihindari oleh Penderita Hipertensi</div>
                            </a>
                            <p class="card-text mb-0">Cari tahu makanan apa saja yang sebaiknya dihindari untuk menjaga tekanan darah tetap normal.</p>
                        </div>
                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d" alt="..." />
                                    <div class="small">
                                        <div class="fw-bold">Fitri Handayani</div>
                                        <div class="text-muted">April 8, 2025 &middot; 4 min read</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Blog 4: Olahraga yang Aman untuk Penderita Hipertensi --}}
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top" src="https://dummyimage.com/600x350/ced4da/6c757d" alt="..." />
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">Gaya Hidup</div>
                            <a class="text-decoration-none link-dark stretched-link" href="#!">
                                <div class="h5 card-title mb-3">Olahraga yang Aman untuk Penderita Hipertensi</div>
                            </a>
                            <p class="card-text mb-0">Pelajari jenis olahraga yang aman dan bermanfaat untuk penderita hipertensi.</p>
                        </div>
                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d" alt="..." />
                                    <div class="small">
                                        <div class="fw-bold">Dr. Andi Wijaya</div>
                                        <div class="text-muted">April 5, 2025 &middot; 5 min read</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="text-end mb-5 mb-xl-0">
                <a class="text-decoration-none" href="#!">
                    Cerita Lainnya
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>
@endsection