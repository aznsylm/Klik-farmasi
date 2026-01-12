<!-- Modal Edit Obat -->
<div class="modal fade" id="editObatModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Edit Obat</h4>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="editObatForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                @if(auth()->user()->puskesmas === 'godean_2')
                    <div class="form-group suplemen-field">
                        <label class="form-label">Suplemen Utama</label>
                        <select class="form-control" name="suplemen" id="editSuplemen" required>
                            <option value="">-- Pilih suplemen --</option>
                            <option value="Asam folat 400mcg">Asam Folat 400mcg</option>
                            <option value="Zat besi + Folat">Zat Besi + Folat</option>
                            <option value="Kalsium laktat">Kalsium Laktat</option>
                            <option value="Vitamin B kompleks">Vitamin B Kompleks</option>
                        </select>
                        <div class="invalid-feedback" id="editSuplemenError"></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jumlah</label>
                        <select class="form-control" name="jumlah_obat" id="editJumlahObat" required>
                            <option value="">-- Pilih jumlah --</option>
                            <option value="30 tablet/bulan">30 tablet (1 bulan)</option>
                            <option value="60 tablet/bulan">60 tablet (2 bulan)</option>
                            <option value="90 tablet/bulan">90 tablet (3 bulan)</option>
                        </select>
                        <div class="invalid-feedback" id="editJumlahObatError"></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Waktu Minum</label>
                        <select class="form-control" name="waktu_minum" id="editWaktuMinum" required>
                            <option value="">-- Pilih jam --</option>
                            <option value="06:00">06.00 (Pagi)</option>
                            <option value="07:00">07.00 (Pagi)</option>
                            <option value="09:00">09.00 (Pagi)</option>
                            <option value="12:00">12.00 (Siang)</option>
                            <option value="13:00">13.00 (Siang)</option>
                            <option value="15:00">15.00 (Sore)</option>
                            <option value="18:00">18.00 (Sore)</option>
                            <option value="19:00">19.00 (Malam)</option>
                            <option value="21:00">21.00 (Malam)</option>
                        </select>
                        <div class="invalid-feedback" id="editWaktuMinumError"></div>
                    </div>
                    <div class="form-group nama-obat-field">
                        <label class="form-label">Obat Tambahan (Opsional)</label>
                        <select class="form-control" name="nama_obat" id="editNamaObat">
                            <option value="">-- Pilih obat jika ada --</option>
                            @include('admin.partials.drug-options-godean')
                        </select>
                    </div>
                @else
                    <div class="form-group nama-obat-field">
                        <label class="form-label">Nama Obat</label>
                        <select class="form-control" name="nama_obat" id="editNamaObat" required>
                            <option value="">-- Pilih nama obat --</option>
                            @include('admin.partials.drug-options')
                        </select>
                        <div class="invalid-feedback" id="editNamaObatError"></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jumlah Obat</label>
                        <select class="form-control" name="jumlah_obat" id="editJumlahObat" required>
                            <option value="">-- Pilih jumlah --</option>
                            <option value="30 tablet/bulan">30 tablet (1 bulan)</option>
                            <option value="60 tablet/bulan">60 tablet (2 bulan)</option>
                            <option value="90 tablet/bulan">90 tablet (3 bulan)</option>
                        </select>
                        <div class="invalid-feedback" id="editJumlahObatError"></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Waktu Minum</label>
                        <select class="form-control" name="waktu_minum" id="editWaktuMinum" required>
                            <option value="">-- Pilih jam --</option>
                            <option value="06:00">06.00 (Pagi)</option>
                            <option value="07:00">07.00 (Pagi)</option>
                            <option value="09:00">09.00 (Pagi)</option>
                            <option value="12:00">12.00 (Siang)</option>
                            <option value="13:00">13.00 (Siang)</option>
                            <option value="15:00">15.00 (Sore)</option>
                            <option value="18:00">18.00 (Sore)</option>
                            <option value="19:00">19.00 (Malam)</option>
                            <option value="21:00">21.00 (Malam)</option>
                        </select>
                        <div class="invalid-feedback" id="editWaktuMinumError"></div>
                    </div>
                    <div class="form-group suplemen-field">
                        <label class="form-label">Suplemen Tambahan (Opsional)</label>
                        <select class="form-control" name="suplemen" id="editSuplemen">
                            <option value="">-- Pilih suplemen jika ada --</option>
                            <option value="Asam folat">Asam Folat</option>
                            <option value="Zat besi">Zat Besi</option>
                            <option value="Kalsium">Kalsium</option>
                            <option value="Suplemen Multivitamin">Multivitamin untuk Ibu Hamil</option>
                        </select>
                    </div>
                @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-warning" id="editObatBtn">
                        <i class="fas fa-save mr-1"></i>Update Obat
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>