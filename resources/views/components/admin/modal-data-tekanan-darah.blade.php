<!-- Modal Data Tekanan Darah -->
<div class="modal fade" id="dataModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Data Tekanan Darah</h4>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                        <tbody id="dataModalTableBody">
                            <!-- Data will be loaded here -->
                        </tbody>
                    </table>
                </div>
                <div id="modalPagination" class="d-flex justify-content-center mt-3">
                    <!-- Pagination will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>