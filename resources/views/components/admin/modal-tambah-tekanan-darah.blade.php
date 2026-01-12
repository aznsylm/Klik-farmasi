<!-- Modal Tambah Data Tekanan Darah -->
<div class="modal fade" id="tambahTekananDarahModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Tambah Data Tekanan Darah</h4>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="tambahTekananDarahForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tambahTanggal" required>
                        <div class="invalid-feedback" id="tambahTanggalError"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Sistol (mmHg)</label>
                                <input type="number" class="form-control" id="tambahSistol" min="70" max="250" required placeholder="120">
                                <div class="invalid-feedback" id="tambahSistolError"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Diastol (mmHg)</label>
                                <input type="number" class="form-control" id="tambahDiastol" min="40" max="150" required placeholder="80">
                                <div class="invalid-feedback" id="tambahDiastolError"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-success" id="tambahTekananBtn">
                        Tambah Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>