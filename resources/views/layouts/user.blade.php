<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Klik Farmasi</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .btn-primary {
            background-color: #0b5e91;
            border-color: #0b5e91;
        }
        
        .btn-primary:hover {
            background-color: #094d7a;
            border-color: #094d7a;
        }
        
        .text-primary {
            color: #0b5e91 !important;
        }
        
        .bg-primary {
            background-color: #0b5e91 !important;
        }
    </style>
</head>
<body>
    @yield('content')
    
    <!-- Footer Kontak Admin -->
    <footer class="bg-white border-top py-3 mt-4">
        <div class="container">
            <div class="text-center mb-2">
                <h6 class="fw-bold mb-2" style="font-size: 14px;">Butuh Bantuan? Hubungi Tim Farmasi</h6>
            </div>
            <div class="row g-2 justify-content-center">
                <div class="col-6 col-md-3">
                    <a href="https://wa.me/+6281292936247" class="btn btn-success btn-sm w-100" style="border-radius: 4px; font-size: 11px; padding: 6px;">
                        <div class="fw-bold">Abdi Sugeng</div>
                        <div>0812-9293-6247</div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="https://wa.me/+6281243983318" class="btn btn-success btn-sm w-100" style="border-radius: 4px; font-size: 11px; padding: 6px;">
                        <div class="fw-bold">Adinda Putri</div>
                        <div>0812-4398-3318</div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="https://wa.me/+6281271954082" class="btn btn-success btn-sm w-100" style="border-radius: 4px; font-size: 11px; padding: 6px;">
                        <div class="fw-bold">Enzelika</div>
                        <div>0812-7195-4082</div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="https://wa.me/+6282286438701" class="btn btn-success btn-sm w-100" style="border-radius: 4px; font-size: 11px; padding: 6px;">
                        <div class="fw-bold">Febby Trianingsih</div>
                        <div>0822-8643-8701</div>
                    </a>
                </div>
            </div>
            <p class="text-center text-muted mb-0 mt-2" style="font-size: 12px;">Konsultasi gratis untuk semua pasien</p>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>