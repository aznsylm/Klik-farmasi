@extends('layouts.admin')

@section('title', 'Kelola Artikel')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kelola Artikel</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Artikel</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        showToast('success', '{{ session('success') }}');
                    });
                </script>
            @endif

            <!-- Articles Table -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Artikel</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Artikel
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Kategori</th>
                                    <th>Tipe Artikel</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Views</th>
                                    <th>Waktu Publish</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($articles as $article)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($article->image)
                                                <img src="{{ asset('storage/' . $article->image) }}"
                                                    alt="{{ $article->title }}" class="img-thumbnail"
                                                    style="max-width: 60px; max-height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                                    style="width: 60px; height: 60px;">
                                                    <i class="fas fa-image text-white"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $article->category }}</td>
                                        <td>
                                            @if ($article->article_type == 'kehamilan')
                                                Hipertensi Kehamilan
                                            @else
                                                Hipertensi Non-Kehamilan
                                            @endif
                                        </td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 200px;"
                                                title="{{ $article->title }}">
                                                {{ $article->title }}
                                            </div>
                                        </td>
                                        <td>{{ $article->author }}</td>
                                        <td>
                                            <i class="fas fa-eye mr-1"></i>{{ number_format($article->views) }}
                                            @if ($article->views > 0)
                                                <button class="btn btn-sm btn-info ml-2" data-toggle="modal"
                                                    data-target="#readersModal{{ $article->id }}">
                                                    Detail
                                                </button>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($article->published_at)
                                                <small
                                                    class="text-muted">{{ $article->published_at->format('d M Y, H:i') }}</small>
                                            @else
                                                <span class="badge badge-warning">Belum dipublish</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.artikel.edit', $article->id) }}"
                                                    class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.artikel.destroy', $article->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin ingin menghapus artikel ini?')"
                                                        title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-file-alt fa-3x mb-3"></i>
                                                <p class="mb-0">Belum ada artikel yang dibuat.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($articles->hasPages())
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            {{ $articles->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Modals for Article Readers -->
    @foreach ($articles as $article)
        @if ($article->views > 0)
            <div class="modal fade" id="readersModal{{ $article->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title text-white">Pembaca Artikel</h4>
                            <button type="button" class="close text-white" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h6 class="mb-3">{{ $article->title }}</h6>

                            @php
                                $readers = $article->getReadersByPuskesmas();
                                $totalReaders = $readers->count();
                            @endphp

                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Nama Pasien</th>
                                            <th>Puskesmas</th>
                                            <th>Jumlah Akses</th>
                                        </tr>
                                    </thead>
                                    <tbody id="readersTable{{ $article->id }}">
                                        @forelse($readers as $index => $read)
                                            <tr class="reader-row" data-article="{{ $article->id }}"
                                                style="{{ $index >= 10 ? 'display: none;' : '' }}">
                                                <td>{{ $read->user->name }}</td>
                                                <td>
                                                    @if ($read->user->puskesmas == 'kalasan')
                                                        Puskesmas Kalasan
                                                    @elseif($read->user->puskesmas == 'godean_2')
                                                        Puskesmas Godean 2
                                                    @elseif($read->user->puskesmas == 'umbulharjo')
                                                        Puskesmas Umbulharjo
                                                    @else
                                                        {{ $read->user->puskesmas }}
                                                    @endif
                                                </td>
                                                <td>{{ $read->access_count }}x</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">Belum ada yang membaca
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @if ($totalReaders > 10)
                                <!-- Page Numbers -->
                                <div class="d-flex justify-content-center mt-3">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0" id="pagination{{ $article->id }}">
                                            <!-- Pagination will be generated by JavaScript -->
                                        </ul>
                                    </nav>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    @include('components.admin.modal-scripts')

    <script>
        // Pagination data for each modal
        const paginationData = {};

        // Initialize pagination when modal is shown
        $(document).ready(function() {
            $('.modal').on('shown.bs.modal', function() {
                const modalId = $(this).attr('id');
                const articleId = modalId.replace('readersModal', '');
                initializePagination(articleId);
            });
        });

        function initializePagination(articleId) {
            const rows = $(`.reader-row[data-article="${articleId}"]`);
            const totalRows = rows.length;
            const rowsPerPage = 10;
            const totalPages = Math.ceil(totalRows / rowsPerPage);

            paginationData[articleId] = {
                currentPage: 1,
                totalPages: totalPages,
                totalRows: totalRows,
                rowsPerPage: rowsPerPage
            };

            // Generate pagination numbers
            generatePaginationNumbers(articleId);

            // Show first page
            showPage(articleId, 1);
        }

        function changePage(articleId, direction) {
            const data = paginationData[articleId];

            if (!data) {
                initializePagination(articleId);
                return;
            }

            if (direction === 'prev' && data.currentPage > 1) {
                data.currentPage--;
            } else if (direction === 'next' && data.currentPage < data.totalPages) {
                data.currentPage++;
            }

            showPage(articleId, data.currentPage);
        }

        function goToPage(articleId, page) {
            if (!paginationData[articleId]) {
                initializePagination(articleId);
                return;
            }
            paginationData[articleId].currentPage = page;
            showPage(articleId, page);
        }

        function showPage(articleId, page) {
            const data = paginationData[articleId];
            if (!data) return;

            const rows = $(`.reader-row[data-article="${articleId}"]`);

            // Hide all rows
            rows.hide();

            // Calculate start and end index
            const startIndex = (page - 1) * data.rowsPerPage;
            const endIndex = Math.min(startIndex + data.rowsPerPage, data.totalRows);

            // Show rows for current page
            rows.slice(startIndex, endIndex).show();

            // Update pagination controls
            updatePaginationControls(articleId);
        }

        function updatePaginationControls(articleId) {
            const data = paginationData[articleId];

            // Update pagination numbers
            generatePaginationNumbers(articleId);
        }

        function generatePaginationNumbers(articleId) {
            const data = paginationData[articleId];
            const paginationContainer = $(`#pagination${articleId}`);
            paginationContainer.empty();

            if (data.totalPages <= 1) return;

            // Previous button
            const prevDisabled = data.currentPage === 1 ? 'disabled' : '';
            paginationContainer.append(`
                <li class="page-item ${prevDisabled}">
                    <a class="page-link" href="#" onclick="changePage(${articleId}, 'prev'); return false;">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            `);

            // Page numbers
            let startPage = Math.max(1, data.currentPage - 2);
            let endPage = Math.min(data.totalPages, startPage + 4);

            if (endPage - startPage < 4) {
                startPage = Math.max(1, endPage - 4);
            }

            // First page and ellipsis if needed
            if (startPage > 1) {
                paginationContainer.append(`
                    <li class="page-item">
                        <a class="page-link" href="#" onclick="goToPage(${articleId}, 1); return false;">1</a>
                    </li>
                `);
                if (startPage > 2) {
                    paginationContainer.append('<li class="page-item disabled"><span class="page-link">...</span></li>');
                }
            }

            // Page numbers
            for (let i = startPage; i <= endPage; i++) {
                const activeClass = i === data.currentPage ? 'active' : '';
                paginationContainer.append(`
                    <li class="page-item ${activeClass}">
                        <a class="page-link" href="#" onclick="goToPage(${articleId}, ${i}); return false;">${i}</a>
                    </li>
                `);
            }

            // Last page and ellipsis if needed
            if (endPage < data.totalPages) {
                if (endPage < data.totalPages - 1) {
                    paginationContainer.append('<li class="page-item disabled"><span class="page-link">...</span></li>');
                }
                paginationContainer.append(`
                    <li class="page-item">
                        <a class="page-link" href="#" onclick="goToPage(${articleId}, ${data.totalPages}); return false;">${data.totalPages}</a>
                    </li>
                `);
            }

            // Next button
            const nextDisabled = data.currentPage === data.totalPages ? 'disabled' : '';
            paginationContainer.append(`
                <li class="page-item ${nextDisabled}">
                    <a class="page-link" href="#" onclick="changePage(${articleId}, 'next'); return false;">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            `);
        }

        // Global functions for onclick handlers
        window.changePage = changePage;
        window.goToPage = goToPage;
    </script>
@endsection
