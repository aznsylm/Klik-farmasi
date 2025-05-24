<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Akun Pasien - Dashboard Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0b5e91 0%, #1e3c72 100%);
            min-height: 100vh;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            padding: 2rem 0;
            transition: all 0.3s ease;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .logo {
            text-align: center;
            margin-bottom: 2rem;
            padding: 0 1rem;
        }

        .logo h2 {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .logo h2 {
            opacity: 0;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(5px);
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #fff;
            border-radius: 0 2px 2px 0;
        }

        .nav-link i {
            width: 20px;
            margin-right: 1rem;
            font-size: 1.1rem;
        }

        .sidebar.collapsed .nav-link span {
            opacity: 0;
        }

        .nav-link .badge {
            background: #ff4757;
            color: white;
            padding: 0.2rem 0.5rem;
            border-radius: 12px;
            font-size: 0.75rem;
            margin-left: auto;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
            background: rgba(255, 255, 255, 0.02);
        }

        /* Header */
        .page-header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            padding: 1.5rem 2rem;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .back-btn {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            padding: 0.75rem;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .page-title h1 {
            color: white;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .page-title p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .export-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .export-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Search and Filter Section */
        .search-filter-section {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .search-box {
            flex: 1;
            min-width: 300px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .search-input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.4);
            background: rgba(255, 255, 255, 0.15);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.6);
        }

        .filter-dropdown {
            padding: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: white;
            cursor: pointer;
            min-width: 150px;
        }

        .filter-dropdown option {
            background: #0b5e91;
            color: white;
        }

        /* Stats Cards */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            padding: 1.5rem;
            color: white;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #4facfe, #00f2fe);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .stat-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-info h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-info p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            background: rgba(255, 255, 255, 0.1);
        }

        /* Table Container */
        .table-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .table-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: between;
            align-items: center;
        }

        .table-title {
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .patients-table {
            width: 100%;
            border-collapse: collapse;
        }

        .patients-table th,
        .patients-table td {
            padding: 1rem 1.5rem;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .patients-table th {
            background: rgba(255, 255, 255, 0.05);
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .patients-table td {
            color: rgba(255, 255, 255, 0.9);
        }

        .patients-table tbody tr {
            transition: all 0.3s ease;
        }

        .patients-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .patient-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 1rem;
        }

        .patient-info {
            display: flex;
            align-items: center;
        }

        .patient-details h4 {
            margin-bottom: 0.25rem;
            font-size: 0.95rem;
        }

        .patient-details p {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .status-badge {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-active {
            background: rgba(76, 175, 80, 0.2);
            color: #4caf50;
            border: 1px solid rgba(76, 175, 80, 0.3);
        }

        .status-inactive {
            background: rgba(244, 67, 54, 0.2);
            color: #f44336;
            border: 1px solid rgba(244, 67, 54, 0.3);
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-action {
            padding: 0.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
        }

        .btn-detail {
            background: rgba(33, 150, 243, 0.2);
            color: #2196f3;
            border: 1px solid rgba(33, 150, 243, 0.3);
        }

        .btn-edit {
            background: rgba(255, 193, 7, 0.2);
            color: #ffc107;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }

        .btn-delete {
            background: rgba(244, 67, 54, 0.2);
            color: #f44336;
            border: 1px solid rgba(244, 67, 54, 0.3);
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            background: rgba(255, 255, 255, 0.05);
        }

        .pagination-info {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .pagination {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .page-btn {
            padding: 0.5rem 1rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .page-btn:hover, .page-btn.active {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .page-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            color: white;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }

        .close-btn:hover {
            opacity: 1;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 1rem;
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .form-input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.4);
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -280px;
                z-index: 999;
                height: 100vh;
            }

            .sidebar.active {
                left: 0;
            }

            .main-content {
                padding: 1rem;
            }

            .header-top {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .header-actions {
                width: 100%;
                justify-content: space-between;
            }

            .search-filter-section {
                flex-direction: column;
            }

            .search-box {
                min-width: auto;
            }

            .stats-row {
                grid-template-columns: 1fr;
            }

            .table-wrapper {
                font-size: 0.85rem;
            }

            .patients-table th,
            .patients-table td {
                padding: 0.75rem 1rem;
            }

            .pagination-container {
                flex-direction: column;
                gap: 1rem;
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-card, .table-container {
            animation: fadeInUp 0.6s ease forwards;
        }

        .stat-card:nth-child(2) { animation-delay: 0.1s; }
        .stat-card:nth-child(3) { animation-delay: 0.2s; }
        .stat-card:nth-child(4) { animation-delay: 0.3s; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="logo">
                <h2><i class="fas fa-hospital"></i> MediCare</h2>
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-users"></i>
                        <span>Kelola Akun Pasien</span>
                        <span class="badge">156</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-newspaper"></i>
                        <span>Artikel</span>
                        <span class="badge">23</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-bullhorn"></i>
                        <span>Berita</span>
                        <span class="badge">8</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-question-circle"></i>
                        <span>Tanya Jawab</span>
                        <span class="badge">12</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-download"></i>
                        <span>Unduhan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-star"></i>
                        <span>Testimoni</span>
                        <span class="badge">45</span>
                    </a>
                </li>
                <li class="nav-item" style="margin-top: 2rem;">
                    <a href="#" class="nav-link" style="color: #ff4757;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Page Header -->
            <div class="page-header">
                <div class="header-top">
                    <div class="header-left">
                        <button class="back-btn" onclick="goBack()">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali</span>
                        </button>
                        <div class="page-title">
                            <h1>Kelola Akun Pasien</h1>
                            <p>Kelola data pasien dengan mudah dan efisien</p>
                        </div>
                    </div>
                    <div class="header-actions">
                        <button class="export-btn" onclick="exportData()">
                            <i class="fas fa-download"></i>
                            <span>Export</span>
                        </button>
                        <button class="btn-primary" onclick="showAddPatientModal()">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Pasien</span>
                        </button>
                    </div>
                </div>
                
                <!-- Search and Filter -->
                <div class="search-filter-section">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Cari pasien berdasarkan nama, email, atau nomor HP..." onkeyup="searchPatients(this.value)">
                    </div>
                    <select class="filter-dropdown" onchange="filterByGender(this.value)">
                        <option value="">Semua Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <select class="filter-dropdown" onchange="filterByStatus(this.value)">
                        <option value="">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Tidak Aktif</option>
                    </select>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-content">
                        <div class="stat-info">
                            <h3 id="totalPatients">1,247</h3>
                            <p>Total Pasien</p>
                        </div>
                        <div class="stat-icon" style="background: rgba(76, 175, 80, 0.2); color: #4caf50;">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-content">
                        <div class="stat-info">
                            <h3 id="activePatients">1,189</h3>
                            <p>Pasien Aktif</p>
                        </div>
                        <div class="stat-icon" style="background: rgba(33, 150, 243, 0.2); color: #2196f3;">
                            <i class="fas fa-user-check"></i>
                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-content">
                        <div class="stat-info">
                            <h3 id="newPatients">58</h3>
                            <p>Pasien Tidak Aktif</p>
                        </div>
                        <div class="stat-icon" style="background: rgba(255, 193, 7, 0.2); color: #ffc107;">
                            <i class="fas fa-user-times"></i>
                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-content">
                        <div class="stat-info">
                            <h3 id="todayRegistrations">12</h3>
                            <p>Registrasi Hari Ini</p>
                        </div>
                        <div class="stat-icon" style="background: rgba(156, 39, 176, 0.2); color: #9c27b0;">
                            <i class="fas fa-user-plus"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Patients Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3 class="table-title">Daftar Pasien</h3>
                </div>
                <div class="table-wrapper">
                    <table class="patients-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Pasien</th>
                                <th>Email</th>
                                <th>Nomor HP</th>
                                <th>Jenis Kelamin</th>
                                <th>Usia</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="patientsTableBody">
                            <!-- Data will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="pagination-container">
                    <div class="pagination-info">
                        Menampilkan <span id="showingFrom">1</span>-<span id="showingTo">10</span> dari <span id="totalRecords">1247</span> data
                    </div>
                    <div class="pagination" id="pagination">
                        <!-- Pagination buttons will be generated by JavaScript -->
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Add/Edit Patient Modal -->
    <div class="modal" id="patientModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Tambah Pasien Baru</h3>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <form id="patientForm">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-input" id="patientName" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" id="patientEmail" placeholder="Masukkan email" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor HP</label>
                    <input type="tel" class="form-input" id="patientPhone" placeholder="Masukkan nomor HP" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Jenis Kelamin</label>
                    <select class="form-input" id="patientGender" required>
                        <option value="">Pilih jenis kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-input" id="patientBirthdate" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Alamat</label>
                    <input type="text" class="form-input" id="patientAddress" placeholder="Masukkan alamat lengkap">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select class="form-input" id="patientStatus">
                        <option value="active">Aktif</option>
                        <option value="inactive">Tidak Aktif</option>
                    </select>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-secondary" onclick="closeModal()">Batal</button>
                    <button type="submit" class="btn-primary">
                        <span id="submitBtnText">Simpan</span>
                        <div class="loading" id="submitLoading" style="display: none;"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Patient Detail Modal -->
    <div class="modal" id="detailModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Detail Pasien</h3>
                <button class="close-btn" onclick="closeDetailModal()">&times;</button>
            </div>
            <div id="patientDetailContent">
                <!-- Patient details will be populated here -->
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-secondary" onclick="closeDetailModal()">Tutup</button>
                <button type="button" class="btn-primary" onclick="editPatientFromDetail()">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="deleteModal">
        <div class="modal-content" style="max-width: 400px;">
            <div class="modal-header">
                <h3 class="modal-title">Konfirmasi Hapus</h3>
                <button class="close-btn" onclick="closeDeleteModal()">&times;</button>
            </div>
            <div style="margin: 1.5rem 0;">
                <p>Apakah Anda yakin ingin menghapus pasien <strong id="deletePatientName"></strong>?</p>
                <p style="color: rgba(255, 255, 255, 0.7); font-size: 0.9rem; margin-top: 1rem;">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-secondary" onclick="closeDeleteModal()">Batal</button>
                <button type="button" class="btn-primary" style="background: linear-gradient(135deg, #f44336, #d32f2f);" onclick="confirmDelete()">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </div>
        </div>
    </div>

    <script>
        // Sample patient data
        let patientsData = [
            {
                id: 1,
                name: "Ahmad Rizki",
                email: "ahmad.rizki@email.com",
                phone: "08123456789",
                gender: "Laki-laki",
                birthdate: "1990-05-15",
                address: "Jl. Sudirman No. 123, Jakarta",
                status: "active",
                registrationDate: "2024-01-15"
            },
            {
                id: 2,
                name: "Siti Nurhaliza",
                email: "siti.nurhaliza@email.com",
                phone: "08234567890",
                gender: "Perempuan",
                birthdate: "1985-08-22",
                address: "Jl. Thamrin No. 456, Jakarta",
                status: "active",
                registrationDate: "2024-01-20"
            },
            {
                id: 3,
                name: "Budi Santoso",
                email: "budi.santoso@email.com",
                phone: "08345678901",
                gender: "Laki-laki",
                birthdate: "1992-12-10",
                address: "Jl. Gatot Subroto No. 789, Jakarta",
                status: "inactive",
                registrationDate: "2024-02-01"
            },
            {
                id: 4,
                name: "Dewi Sartika",
                email: "dewi.sartika@email.com",
                phone: "08456789012",
                gender: "Perempuan",
                birthdate: "1988-03-18",
                address: "Jl. Diponegoro No. 321, Bandung",
                status: "active",
                registrationDate: "2024-02-05"
            },
            {
                id: 5,
                name: "Eko Prasetyo",
                email: "eko.prasetyo@email.com",
                phone: "08567890123",
                gender: "Laki-laki",
                birthdate: "1993-07-25",
                address: "Jl. Ahmad Yani No. 654, Surabaya",
                status: "active",
                registrationDate: "2024-02-08"
            },
            {
                id: 6,
                name: "Fitri Handayani",
                email: "fitri.handayani@email.com",
                phone: "08678901234",
                gender: "Perempuan",
                birthdate: "1991-11-30",
                address: "Jl. Pahlawan No. 987, Medan",
                status: "inactive",
                registrationDate: "2024-02-10"
            },
            {
                id: 7,
                name: "Hendra Wijaya",
                email: "hendra.wijaya@email.com",
                phone: "08789012345",
                gender: "Laki-laki",
                birthdate: "1987-04-12",
                address: "Jl. Veteran No. 147, Yogyakarta",
                status: "active",
                registrationDate: "2024-02-12"
            },
            {
                id: 8,
                name: "Indira Maharani",
                email: "indira.maharani@email.com",
                phone: "08890123456",
                gender: "Perempuan",
                birthdate: "1989-09-05",
                address: "Jl. Merdeka No. 258, Semarang",
                status: "active",
                registrationDate: "2024-02-15"
            }
        ];

        let filteredData = [...patientsData];
        let currentPage = 1;
        let itemsPerPage = 10;
        let editingPatientId = null;
        let deletePatientId = null;

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            renderTable();
            renderPagination();
            updateStats();
        });

        // Calculate age from birthdate
        function calculateAge(birthdate) {
            const today = new Date();
            const birth = new Date(birthdate);
            let age = today.getFullYear() - birth.getFullYear();
            const monthDiff = today.getMonth() - birth.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
                age--;
            }
            return age;
        }

        // Get patient initials for avatar
        function getInitials(name) {
            return name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);
        }

        // Render table
        function renderTable() {
            const tbody = document.getElementById('patientsTableBody');
            const start = (currentPage - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const pageData = filteredData.slice(start, end);

            tbody.innerHTML = '';

            pageData.forEach(patient => {
                const age = calculateAge(patient.birthdate);
                const initials = getInitials(patient.name);
                
                const row = `
                    <tr>
                        <td>#${patient.id.toString().padStart(4, '0')}</td>
                        <td>
                            <div class="patient-info">
                                <div class="patient-avatar">${initials}</div>
                                <div class="patient-details">
                                    <h4>${patient.name}</h4>
                                    <p>ID: ${patient.id}</p>
                                </div>
                            </div>
                        </td>
                        <td>${patient.email}</td>
                        <td>${patient.phone}</td>
                        <td>${patient.gender}</td>
                        <td>${age} tahun</td>
                        <td>
                            <span class="status-badge ${patient.status === 'active' ? 'status-active' : 'status-inactive'}">
                                ${patient.status === 'active' ? 'Aktif' : 'Tidak Aktif'}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-detail" onclick="showPatientDetail(${patient.id})" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-action btn-edit" onclick="editPatient(${patient.id})" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-action btn-delete" onclick="showDeleteModal(${patient.id})" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', row);
            });

            // Update pagination info
            const totalRecords = filteredData.length;
            const showingFrom = totalRecords === 0 ? 0 : start + 1;
            const showingTo = Math.min(end, totalRecords);
            
            document.getElementById('showingFrom').textContent = showingFrom;
            document.getElementById('showingTo').textContent = showingTo;
            document.getElementById('totalRecords').textContent = totalRecords;
        }

        // Render pagination
        function renderPagination() {
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            const pagination = document.getElementById('pagination');
            
            pagination.innerHTML = '';

            // Previous button
            const prevBtn = document.createElement('button');
            prevBtn.className = 'page-btn';
            prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
            prevBtn.disabled = currentPage === 1;
            prevBtn.onclick = () => changePage(currentPage - 1);
            pagination.appendChild(prevBtn);

            // Page numbers
            const startPage = Math.max(1, currentPage - 2);
            const endPage = Math.min(totalPages, currentPage + 2);

            for (let i = startPage; i <= endPage; i++) {
                const pageBtn = document.createElement('button');
                pageBtn.className = `page-btn ${i === currentPage ? 'active' : ''}`;
                pageBtn.textContent = i;
                pageBtn.onclick = () => changePage(i);
                pagination.appendChild(pageBtn);
            }

            // Next button
            const nextBtn = document.createElement('button');
            nextBtn.className = 'page-btn';
            nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
            nextBtn.disabled = currentPage === totalPages;
            nextBtn.onclick = () => changePage(currentPage + 1);
            pagination.appendChild(nextBtn);
        }

        // Change page
        function changePage(page) {
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                renderTable();
                renderPagination();
            }
        }

        // Update statistics
        function updateStats() {
            const totalPatients = patientsData.length;
            const activePatients = patientsData.filter(p => p.status === 'active').length;
            const inactivePatients = patientsData.filter(p => p.status === 'inactive').length;
            
            // Today's registrations (for demo, using random number)
            const todayRegistrations = Math.floor(Math.random() * 20) + 1;

            document.getElementById('totalPatients').textContent = totalPatients.toLocaleString();
            document.getElementById('activePatients').textContent = activePatients.toLocaleString();
            document.getElementById('newPatients').textContent = inactivePatients.toLocaleString();
            document.getElementById('todayRegistrations').textContent = todayRegistrations.toLocaleString();
        }

        // Search patients
        function searchPatients(query) {
            if (query.trim() === '') {
                filteredData = [...patientsData];
            } else {
                filteredData = patientsData.filter(patient => 
                    patient.name.toLowerCase().includes(query.toLowerCase()) ||
                    patient.email.toLowerCase().includes(query.toLowerCase()) ||
                    patient.phone.includes(query)
                );
            }
            currentPage = 1;
            renderTable();
            renderPagination();
        }

        // Filter by gender
        function filterByGender(gender) {
            if (gender === '') {
                filteredData = [...patientsData];
            } else {
                filteredData = patientsData.filter(patient => patient.gender === gender);
            }
            currentPage = 1;
            renderTable();
            renderPagination();
        }

        // Filter by status
        function filterByStatus(status) {
            if (status === '') {
                filteredData = [...patientsData];
            } else {
                filteredData = patientsData.filter(patient => patient.status === status);
            }
            currentPage = 1;
            renderTable();
            renderPagination();
        }

        // Show add patient modal
        function showAddPatientModal() {
            editingPatientId = null;
            document.getElementById('modalTitle').textContent = 'Tambah Pasien Baru';
            document.getElementById('patientForm').reset();
            document.getElementById('patientStatus').value = 'active';
            document.getElementById('patientModal').classList.add('show');
        }

        // Show patient detail
        function showPatientDetail(id) {
            const patient = patientsData.find(p => p.id === id);
            if (!patient) return;

            const age = calculateAge(patient.birthdate);
            const registrationDate = new Date(patient.registrationDate).toLocaleDateString('id-ID');
            
            const detailContent = `
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    <div>
                        <label class="form-label">Nama Lengkap</label>
                        <p style="color: white; margin-bottom: 1rem;">${patient.name}</p>
                    </div>
                    <div>
                        <label class="form-label">Email</label>
                        <p style="color: white; margin-bottom: 1rem;">${patient.email}</p>
                    </div>
                    <div>
                        <label class="form-label">Nomor HP</label>
                        <p style="color: white; margin-bottom: 1rem;">${patient.phone}</p>
                    </div>
                    <div>
                        <label class="form-label">Jenis Kelamin</label>
                        <p style="color: white; margin-bottom: 1rem;">${patient.gender}</p>
                    </div>
                    <div>
                        <label class="form-label">Usia</label>
                        <p style="color: white; margin-bottom: 1rem;">${age} tahun</p>
                    </div>
                    <div>
                        <label class="form-label">Status</label>
                        <p style="color: white; margin-bottom: 1rem;">
                            <span class="status-badge ${patient.status === 'active' ? 'status-active' : 'status-inactive'}">
                                ${patient.status === 'active' ? 'Aktif' : 'Tidak Aktif'}
                            </span>
                        </p>
                    </div>
                </div>
                <div>
                    <label class="form-label">Alamat</label>
                    <p style="color: white; margin-bottom: 1rem;">${patient.address}</p>
                </div>
                <div>
                    <label class="form-label">Tanggal Registrasi</label>
                    <p style="color: white;">${registrationDate}</p>
                </div>
            `;
            
            document.getElementById('patientDetailContent').innerHTML = detailContent;
            editingPatientId = id;
            document.getElementById('detailModal').classList.add('show');
        }

        // Edit patient
        function editPatient(id) {
            const patient = patientsData.find(p => p.id === id);
            if (!patient) return;

            editingPatientId = id;
            document.getElementById('modalTitle').textContent = 'Edit Pasien';
            document.getElementById('patientName').value = patient.name;
            document.getElementById('patientEmail').value = patient.email;
            document.getElementById('patientPhone').value = patient.phone;
            document.getElementById('patientGender').value = patient.gender;
            document.getElementById('patientBirthdate').value = patient.birthdate;
            document.getElementById('patientAddress').value = patient.address;
            document.getElementById('patientStatus').value = patient.status;
            
            document.getElementById('patientModal').classList.add('show');
        }

        // Edit patient from detail modal
        function editPatientFromDetail() {
            document.getElementById('detailModal').classList.remove('show');
            editPatient(editingPatientId);
        }

        // Show delete modal
        function showDeleteModal(id) {
            const patient = patientsData.find(p => p.id === id);
            if (!patient) return;

            deletePatientId = id;
            document.getElementById('deletePatientName').textContent = patient.name;
            document.getElementById('deleteModal').classList.add('show');
        }

        // Confirm delete
        function confirmDelete() {
            if (deletePatientId) {
                patientsData = patientsData.filter(p => p.id !== deletePatientId);
                filteredData = filteredData.filter(p => p.id !== deletePatientId);
                
                // Adjust current page if necessary
                const totalPages = Math.ceil(filteredData.length / itemsPerPage);
                if (currentPage > totalPages && totalPages > 0) {
                    currentPage = totalPages;
                }
                
                renderTable();
                renderPagination();
                updateStats();
                closeDeleteModal();
                
                // Show success message (you can implement a toast notification here)
                alert('Pasien berhasil dihapus!');
            }
        }

        // Close modals
        function closeModal() {
            document.getElementById('patientModal').classList.remove('show');
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.remove('show');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('show');
            deletePatientId = null;
        }

        // Handle form submission
        document.getElementById('patientForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('submitBtnText');
            const loading = document.getElementById('submitLoading');
            
            // Show loading
            submitBtn.style.display = 'none';
            loading.style.display = 'inline-block';
            
            // Simulate API call
            setTimeout(() => {
                const formData = {
                    name: document.getElementById('patientName').value,
                    email: document.getElementById('patientEmail').value,
                    phone: document.getElementById('patientPhone').value,
                    gender: document.getElementById('patientGender').value,
                    birthdate: document.getElementById('patientBirthdate').value,
                    address: document.getElementById('patientAddress').value,
                    status: document.getElementById('patientStatus').value,
                };

                if (editingPatientId) {
                    // Update existing patient
                    const index = patientsData.findIndex(p => p.id === editingPatientId);
                    if (index !== -1) {
                        patientsData[index] = { ...patientsData[index], ...formData };
                        
                        // Update filtered data
                        const filteredIndex = filteredData.findIndex(p => p.id === editingPatientId);
                        if (filteredIndex !== -1) {
                            filteredData[filteredIndex] = { ...filteredData[filteredIndex], ...formData };
                        }
                    }
                } else {
                    // Add new patient
                    const newId = Math.max(...patientsData.map(p => p.id)) + 1;
                    const newPatient = {
                        id: newId,
                        ...formData,
                        registrationDate: new Date().toISOString().split('T')[0]
                    };
                    patientsData.push(newPatient);
                    filteredData.push(newPatient);
                }

                renderTable();
                renderPagination();
                updateStats();
                closeModal();
                
                // Hide loading
                submitBtn.style.display = 'inline';
                loading.style.display = 'none';
                
                // Show success message
                alert(editingPatientId ? 'Pasien berhasil diupdate!' : 'Pasien berhasil ditambahkan!');
            }, 1000);
        });

        // Export data
        function exportData() {
            const csvContent = "data:text/csv;charset=utf-8," 
                + "ID,Nama,Email,Nomor HP,Jenis Kelamin,Usia,Status,Tanggal Registrasi\n"
                + filteredData.map(patient => {
                    const age = calculateAge(patient.birthdate);
                    return `${patient.id},"${patient.name}","${patient.email}","${patient.phone}","${patient.gender}",${age},"${patient.status === 'active' ? 'Aktif' : 'Tidak Aktif'}","${patient.registrationDate}"`;
                }).join("\n");

            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "data_pasien.csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        // Go back function
        function goBack() {
            // In a real application, this would navigate to the previous page
            // For demo purposes, we'll show an alert
            alert('Kembali ke dashboard utama');
            // window.history.back();
        }

        // Close modals when clicking outside
        window.addEventListener('click', function(e) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (e.target === modal) {
                    modal.classList.remove('show');
                }
            });
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // ESC to close modals
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal').forEach(modal => {
                    modal.classList.remove('show');
                });
            }
            
            // Ctrl+N to add new patient
            if (e.ctrlKey && e.key === 'n') {
                e.preventDefault();
                showAddPatientModal();
            }
        });

        // Auto-refresh data every 30 seconds (for demo purposes)
        setInterval(() => {
            updateStats();
        }, 30000);
    </script>
</body>
</html>