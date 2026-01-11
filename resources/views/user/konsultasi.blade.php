@extends('layouts.user-admin')
@section('title', 'Konsultasi')
@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Konsultasi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Konsultasi</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info Header -->
        <div class="row">
            <div class="col-12">
                <div class="card bg-gradient-success">
                    <div class="card-body">
                        <h4 class="text-white mb-1"><i class="fas fa-comments mr-2"></i> Butuh Bantuan? Konsultasi Sekarang!</h4>
                        <p class="text-white mb-0">Punya pertanyaan tentang obat atau kesehatan? Jangan ragu untuk menghubungi tim ahli kami melalui nomor yang tersedia di bawah ini.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tim Farmasi Cards -->
        <div class="row">
            <!-- Pakar Kesehatan -->
            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header bg-primary">
                        <h3 class="widget-user-username">apt. Nurul Kusumawardani, M. Farm</h3>
                        <h5 class="widget-user-desc">Pakar Kesehatan</h5>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="description-block">
                                    <h5 class="description-header">0819-0280-8231</h5>
                                    <span class="description-text">WhatsApp</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <a href="https://wa.me/+6281902808231" class="btn btn-primary btn-block" target="_blank">
                                    <i class="fab fa-whatsapp mr-1"></i> Chat WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header bg-success">
                        <h3 class="widget-user-username">Abdi Sugeng</h3>
                        <h5 class="widget-user-desc">Admin Klik Farmasi</h5>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="description-block">
                                    <h5 class="description-header">0812-9293-6247</h5>
                                    <span class="description-text">WhatsApp</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <a href="https://wa.me/+6281292936247" class="btn btn-success btn-block" target="_blank">
                                    <i class="fab fa-whatsapp mr-1"></i> Chat WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username">Adinda Putri</h3>
                        <h5 class="widget-user-desc">Admin Klik Farmasi</h5>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="description-block">
                                    <h5 class="description-header">0812-4398-3318</h5>
                                    <span class="description-text">WhatsApp</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <a href="https://wa.me/+6281243983318" class="btn btn-info btn-block" target="_blank">
                                    <i class="fab fa-whatsapp mr-1"></i> Chat WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header bg-warning">
                        <h3 class="widget-user-username">Enzelika</h3>
                        <h5 class="widget-user-desc">Admin Klik Farmasi</h5>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="description-block">
                                    <h5 class="description-header">0812-7195-4082</h5>
                                    <span class="description-text">WhatsApp</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <a href="https://wa.me/+6281271954082" class="btn btn-warning btn-block" target="_blank">
                                    <i class="fab fa-whatsapp mr-1"></i> Chat WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header bg-danger">
                        <h3 class="widget-user-username">Febby Trianingsih</h3>
                        <h5 class="widget-user-desc">Admin Klik Farmasi</h5>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="description-block">
                                    <h5 class="description-header">0822-8643-8701</h5>
                                    <span class="description-text">WhatsApp</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <a href="https://wa.me/+6282286438701" class="btn btn-danger btn-block" target="_blank">
                                    <i class="fab fa-whatsapp mr-1"></i> Chat WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-question-circle mr-1"></i> Pertanyaan yang Sering Diajukan</h3>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="faqAccordion">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#faq1">
                                            <i class="fas fa-chevron-down mr-2"></i> Kapan saya bisa menghubungi tim farmasi?
                                        </button>
                                    </h2>
                                </div>
                                <div id="faq1" class="collapse" data-parent="#faqAccordion">
                                    <div class="card-body">
                                        Anda dapat menghubungi tim farmasi kami kapan saja melalui WhatsApp untuk mendapatkan bantuan yang Anda butuhkan.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#faq2">
                                            <i class="fas fa-chevron-down mr-2"></i> Apakah konsultasi berbayar?
                                        </button>
                                    </h2>
                                </div>
                                <div id="faq2" class="collapse" data-parent="#faqAccordion">
                                    <div class="card-body">
                                        Tidak, konsultasi dengan tim farmasi kami sepenuhnya gratis untuk semua pasien.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#faq3">
                                            <i class="fas fa-chevron-down mr-2"></i> Apa saja yang bisa dikonsultasikan?
                                        </button>
                                    </h2>
                                </div>
                                <div id="faq3" class="collapse" data-parent="#faqAccordion">
                                    <div class="card-body">
                                        Anda dapat berkonsultasi tentang:
                                        <ul class="mt-2">
                                            <li>Cara minum obat yang benar</li>
                                            <li>Efek samping obat</li>
                                            <li>Interaksi obat dengan makanan</li>
                                            <li>Masalah tekanan darah</li>
                                            <li>Pertanyaan seputar penggunaan aplikasi</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#faq4">
                                            <i class="fas fa-chevron-down mr-2"></i> Berapa lama tim farmasi membalas pesan?
                                        </button>
                                    </h2>
                                </div>
                                <div id="faq4" class="collapse" data-parent="#faqAccordion">
                                    <div class="card-body">
                                        Tim farmasi kami berusaha membalas pesan Anda sesegera mungkin, biasanya dalam waktu beberapa menit hingga 1 jam.
                                    </div>
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