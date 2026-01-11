@extends('layouts.user-admin')
@section('title', 'Tekanan Darah')
@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tekanan Darah</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tekanan Darah</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Input Form -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title text-white"><i class="fas fa-plus mr-1"></i> Catat Tekanan Darah</h3>
                    </div>
                    <div class="card-body">
                        <form id="bloodPressureForm">
                            @csrf
                            <div class="form-group">
                                <label>Sistol (mmHg)</label>
                                <input type="number" class="form-control" id="sistol" min="70" max="250" required>
                            </div>
                            <div class="form-group">
                                <label>Diastol (mmHg)</label>
                                <input type="number" class="form-control" id="diastol" min="40" max="150" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">
                                Simpan Data
                            </button>
                        </form>

                        @php
                            $latestTekananDarah = \App\Models\CatatanTekananDarah::where('user_id', Auth::id())->latest()->first();
                        @endphp
                        @if($latestTekananDarah)
                            <div class="mt-3 p-3 bg-light rounded">
                                <small class="text-success font-weight-bold">
                                    Terakhir: {{ $latestTekananDarah->sistol }}/{{ $latestTekananDarah->diastol }} mmHg
                                    <br>
                                    <span class="text-muted">{{ $latestTekananDarah->created_at->format('d M Y, H:i') }}</span>
                                </small>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Download PDF -->
                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{ route('user.tekanan-darah.pdf') }}" class="btn btn-danger btn-block">
                            <i class="fas fa-file-pdf mr-1"></i> Unduh Laporan PDF
                        </a>
                    </div>
                </div>
            </div>

            <!-- Chart -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Grafik Tekanan Darah</h3>
                    </div>
                    <div class="card-body">
                        <div style="position: relative; height: 400px;">
                            <canvas id="bloodPressureChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Records -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Catatan Terbaru</h3>
                    </div>
                    <div class="card-body p-0">
                        @if($recentRecords->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Sistol</th>
                                            <th>Diastol</th>
                                            <th>Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentRecords as $index => $record)
                                            <tr>
                                                <td>{{ ($recentRecords->currentPage() - 1) * $recentRecords->perPage() + $index + 1 }}</td>
                                                <td>{{ $record->created_at->format('d M Y, H:i') }}</td>
                                                <td>{{ $record->sistol }}</td>
                                                <td>{{ $record->diastol }}</td>
                                                <td>
                                                    @php
                                                        // Klasifikasi berdasarkan panduan medis: ambil kategori tertinggi
                                                        if ($record->sistol < 120 && $record->diastol < 80) {
                                                            $category = 'NORMAL';
                                                            $textColor = 'text-success';
                                                        } elseif ($record->sistol >= 120 && $record->sistol <= 129 && $record->diastol < 80) {
                                                            $category = 'PRE HIPERTENSI';
                                                            $textColor = 'text-info';
                                                        } elseif (($record->sistol >= 130 && $record->sistol <= 139) || ($record->diastol >= 80 && $record->diastol <= 89)) {
                                                            $category = 'HIPERTENSI STAGE 1';
                                                            $textColor = 'text-warning';
                                                        } else {
                                                            $category = 'HIPERTENSI STAGE 2';
                                                            $textColor = 'text-danger';
                                                        }
                                                    @endphp
                                                    <strong class="{{ $textColor }}">{{ $category }}</strong>
                                                </td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm" onclick="editRecord({{ $record->id }}, {{ $record->sistol }}, {{ $record->diastol }})" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada catatan tekanan darah</p>
                            </div>
                        @endif
                    </div>
                    @if($recentRecords->hasPages())
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            {{ $recentRecords->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Edit Tekanan Darah</h4>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="editForm">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Sistol (mmHg)</label>
                        <input type="number" class="form-control" id="editSistol" min="70" max="250" required>
                    </div>
                    <div class="form-group">
                        <label>Diastol (mmHg)</label>
                        <input type="number" class="form-control" id="editDiastol" min="40" max="150" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-warning">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load Chart
    const ctx = document.getElementById('bloodPressureChart');
    if (ctx) {
        fetch('/api/blood-pressure-data')
            .then(response => response.json())
            .then(data => {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Sistol',
                            data: data.sistol,
                            borderColor: '#dc3545',
                            backgroundColor: 'rgba(220, 53, 69, 0.1)',
                            tension: 0.4
                        }, {
                            label: 'Diastol',
                            data: data.diastol,
                            borderColor: '#0b5e91',
                            backgroundColor: 'rgba(11, 94, 145, 0.1)',
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: false,
                                min: 60,
                                max: 200
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top'
                            }
                        }
                    }
                });
            })
            .catch(err => console.error('Error loading chart:', err));
    }

    // Handle Form Submit
    const form = document.getElementById('bloodPressureForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const sistol = document.getElementById('sistol').value;
            const diastol = document.getElementById('diastol').value;
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/api/save-blood-pressure', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ sistol, diastol })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Gagal menyimpan data');
                }
            })
            .catch(err => {
                console.error('Error:', err);
                alert('Terjadi kesalahan');
            });
        });
    }
});

// Edit functions
let currentEditId = null;

function editRecord(id, sistol, diastol) {
    currentEditId = id;
    document.getElementById('editSistol').value = sistol;
    document.getElementById('editDiastol').value = diastol;
    $('#editModal').modal('show');
}

// Handle Edit Form Submit
document.addEventListener('DOMContentLoaded', function() {
    const editForm = document.getElementById('editForm');
    if (editForm) {
        editForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const sistol = document.getElementById('editSistol').value;
            const diastol = document.getElementById('editDiastol').value;
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`/api/user-blood-pressure/${currentEditId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ sistol: parseInt(sistol), diastol: parseInt(diastol) })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    $('#editModal').modal('hide');
                    location.reload();
                } else {
                    alert(data.message || 'Gagal mengupdate data');
                }
            })
            .catch(err => {
                console.error('Error:', err);
                alert('Terjadi kesalahan');
            });
        });
    }
});
</script>
@endsection