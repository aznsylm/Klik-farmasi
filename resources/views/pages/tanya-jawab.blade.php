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
                        @foreach ($faqs->where('category', 'Tentang Hipertensi') as $faq)
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="heading{{ $loop->index }}">
                                    <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse{{ $loop->index }}">
                                        {{ $faq->question }}
                                    </button>
                                </h3>
                                <div class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" id="collapse{{ $loop->index }}" aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordionHipertensi">
                                    <div class="accordion-body">
                                        {{ $faq->answer }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- FAQ Accordion 2: Pentingnya Minum Obat -->
                    <h2 class="fw-bolder mb-3">Pentingnya Minum Obat</h2>
                    <div class="accordion mb-5" id="accordionObat">
                        @foreach ($faqs->where('category', 'Pentingnya Minum Obat') as $faq)
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingObat{{ $loop->index }}">
                                    <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseObat{{ $loop->index }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapseObat{{ $loop->index }}">
                                        {{ $faq->question }}
                                    </button>
                                </h3>
                                <div class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" id="collapseObat{{ $loop->index }}" aria-labelledby="headingObat{{ $loop->index }}" data-bs-parent="#accordionObat">
                                    <div class="accordion-body">
                                        {{ $faq->answer }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
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