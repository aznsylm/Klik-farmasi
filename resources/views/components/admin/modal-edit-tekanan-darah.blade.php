<!-- Modal Edit Tekanan Darah -->
<div class="modal fade" id="editTekananDarahModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Edit Tekanan Darah</h4>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="editTekananDarahForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" id="editTanggal" required>
                        <div class="invalid-feedback" id="editTanggalError"></div>
                    </div>
                    <div class="form-group">
                        <label>Sistol (mmHg)</label>
                        <input type="number" class="form-control" id="editSistol" min="70" max="250" required>
                        <div class="invalid-feedback" id="editSistolError"></div>
                    </div>
                    <div class="form-group">
                        <label>Diastol (mmHg)</label>
                        <input type="number" class="form-control" id="editDiastol" min="40" max="150" required>
                        <div class="invalid-feedback" id="editDiastolError"></div>
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