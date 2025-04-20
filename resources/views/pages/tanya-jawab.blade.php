@extends('layouts.app')

@section('title', 'Tanya Jawab')

@section('content')
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="text-center mb-5">
                <h1 class="fw-bolder">Pertanyaan yang Sering Diajukan</h1>
                <p class="lead fw-normal text-muted mb-0">Bagaimana kami dapat membantu Anda?</p>
            </div>
            <div class="row gx-5">
                <div class="col-xl-8">
                    <!-- FAQ Accordion 1: Tentang Hipertensi -->
                    <h2 class="fw-bolder mb-3">Tentang Hipertensi</h2>
                    <div class="accordion mb-5" id="accordionHipertensi">
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Apa itu hipertensi?
                                </button>
                            </h3>
                            <div class="accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionHipertensi">
                                <div class="accordion-body">
                                    Hipertensi, atau tekanan darah tinggi, adalah kondisi di mana tekanan darah terhadap dinding arteri Anda terlalu tinggi. Jika tidak diobati, hipertensi dapat menyebabkan komplikasi serius seperti penyakit jantung dan stroke.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Apa saja gejala hipertensi?
                                </button>
                            </h3>
                            <div class="accordion-collapse collapse" id="collapseTwo" aria-labelledby="headingTwo" data-bs-parent="#accordionHipertensi">
                                <div class="accordion-body">
                                    Hipertensi sering disebut sebagai "silent killer" karena biasanya tidak memiliki gejala yang jelas. Namun, beberapa orang mungkin mengalami sakit kepala, pusing, atau mimisan jika tekanan darah sangat tinggi.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Bagaimana cara mencegah hipertensi?
                                </button>
                            </h3>
                            <div class="accordion-collapse collapse" id="collapseThree" aria-labelledby="headingThree" data-bs-parent="#accordionHipertensi">
                                <div class="accordion-body">
                                    Anda dapat mencegah hipertensi dengan menjaga pola makan sehat, mengurangi konsumsi garam, rutin berolahraga, mengelola stres, dan menghindari kebiasaan merokok serta konsumsi alkohol berlebihan.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Accordion 2: Minum Obat -->
                    <h2 class="fw-bolder mb-3">Pentingnya Minum Obat</h2>
                    <div class="accordion mb-5 mb-xl-0" id="accordionObat">
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="headingOneObat">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOneObat" aria-expanded="true" aria-controls="collapseOneObat">
                                    Mengapa penting untuk minum obat hipertensi tepat waktu?
                                </button>
                            </h3>
                            <div class="accordion-collapse collapse show" id="collapseOneObat" aria-labelledby="headingOneObat" data-bs-parent="#accordionObat">
                                <div class="accordion-body">
                                    Minum obat hipertensi tepat waktu membantu menjaga tekanan darah tetap stabil dan mencegah komplikasi serius seperti serangan jantung atau stroke.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="headingTwoObat">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwoObat" aria-expanded="false" aria-controls="collapseTwoObat">
                                    Apa yang harus dilakukan jika lupa minum obat?
                                </button>
                            </h3>
                            <div class="accordion-collapse collapse" id="collapseTwoObat" aria-labelledby="headingTwoObat" data-bs-parent="#accordionObat">
                                <div class="accordion-body">
                                    Jika Anda lupa minum obat, segera minum dosis yang terlewat begitu Anda ingat. Namun, jika sudah mendekati waktu dosis berikutnya, lewati dosis yang terlewat dan lanjutkan jadwal seperti biasa. Jangan menggandakan dosis.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="headingThreeObat">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThreeObat" aria-expanded="false" aria-controls="collapseThreeObat">
                                    Apakah ada efek samping dari obat hipertensi?
                                </button>
                            </h3>
                            <div class="accordion-collapse collapse" id="collapseThreeObat" aria-labelledby="headingThreeObat" data-bs-parent="#accordionObat">
                                <div class="accordion-body">
                                    Beberapa obat hipertensi dapat menyebabkan efek samping seperti pusing, kelelahan, atau mual. Jika Anda mengalami efek samping yang mengganggu, konsultasikan dengan dokter untuk penyesuaian dosis atau penggantian obat.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card border-0 bg-light mt-xl-5">
                        <div class="card-body p-4 py-lg-5">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="text-center">
                                    <div class="h6 fw-bolder">Punya pertanyaan lain?</div>
                                    <p class="text-muted mb-4">
                                        Hubungi kami di
                                        <br />
                                        <a href="mailto:support@klikfarmasi.com">support@klikfarmasi.com</a>
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
@endsection