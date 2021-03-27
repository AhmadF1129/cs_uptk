<!-- MODAL - EXPORT -->
<div class="modal fade" id="modal-export-history" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">FILTER BY</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- FILTER BY -->
                <div id="divFilterBy" class="form-group">
                    <!-- JURUSAN -->
                    <div class="form-group mt-3">
                        <div class="form-row">
                            <div class="col-3">
                                <div class="custom-control custom-radio filter-by">
                                    <input type="radio" class="custom-control-input" id="radioJurusan" checked>
                                    <label class="custom-control-label" for="radioJurusan">Jurusan</label>
                                </div>
                            </div>
                            <select id="cmb-jurusan-export" name="cmb-jurusan-export" class="form-control custom-select col-8"></select>
                        </div>
                    </div>
                    <!-- RUANGAN -->
                    <div class="form-group mt-3">
                        <div class="form-row">
                            <div class="col-3">
                                <div class="custom-control custom-radio filter-by">
                                    <input type="radio" class="custom-control-input" id="radioRuangan">
                                    <label class="custom-control-label" for="radioRuangan">Ruangan</label>
                                </div>
                            </div>
                            <select id="cmb-ruangan-export" name="cmb-ruangan-export" class="form-control custom-select col-8" disabled></select>
                        </div>
                    </div>
                </div>

                <!-- TIME LINE -->
                <div id="divTimeLine" class="form-group">
                    <h5>TIME LINE</h5>
                    <hr>
                    <!-- BULAN -->
                    <div class="form-group mt-3">
                        <div class="form-row">
                            <div class="col-3">
                                <div class="custom-control custom-radio time-line">
                                    <input type="radio" class="custom-control-input" id="radioBulan" checked>
                                    <label class="custom-control-label" for="radioBulan">Bulan</label>
                                </div>
                            </div>
                            <select id="cmb-bulan" name="cmb-bulan" class="form-control custom-select col-8">
                                <?php
                                $currentYear = date('Y');
                                $arrMonth = [
                                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                ];
                                for ($i = 0; $i < 12; $i++) {
                                    echo '<option value="' . $currentYear . '-' . str_pad(($i + 1), 2, 0, STR_PAD_LEFT) . '">' . $arrMonth[$i] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- TAHUN -->
                    <div class="form-group mt-3">
                        <div class="form-row">
                            <div class="col-3">
                                <div class="custom-control custom-radio time-line">
                                    <input type="radio" class="custom-control-input" id="radioTahun">
                                    <label class="custom-control-label" for="radioTahun">Tahun</label>
                                </div>
                            </div>
                            <select id="cmb-tahun" name="cmb-tahun" class="form-control custom-select col-8" disabled>
                                <?php
                                $starting_year = date('Y', strtotime('-5 year'));
                                $curentYear = date('Y');
                                for ($curentYear; $curentYear >= $starting_year; $curentYear--) {
                                    echo '<option value="' . $curentYear . '">' . $curentYear . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" onclick="$(this).exportData('xls');">Excel</button>
                <button class="btn btn-danger" onclick="$(this).exportData('pdf');">PDF</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL - DETAIL  -->
<div class="modal fade" id="modal-detail-history" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">DETAIL</h5>
            </div>
            <div class="modal-body">
                <label for="d-txt-jurusan">Jurusan</label>
                <input type="text" id="d-txt-jurusan" class="form-control" readonly>

                <label for="d-txt-prodi">Program Studi</label>
                <input type="text" id="d-txt-prodi" class="form-control" readonly>

                <label for="d-txt-dosen">Dosen</label>
                <input type="text" id="d-txt-dosen" class="form-control" readonly>

                <label for="d-txt-matkul">Mata Kuliah</label>
                <input type="text" id="d-txt-matkul" class="form-control" readonly>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="d-txt-kondisi-awal">Kondisi Awal</label>
                        <input type="text" id="d-txt-kondisi-awal" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="d-txt-kondisi-akhir">Kondisi Akhir</label>
                        <input type="text" id="d-txt-kondisi-akhir" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="d-txt-hari">Hari</label>
                        <input type="text" id="d-txt-hari" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="d-txt-tanggal">Tanggal</label>
                        <input type="text" id="d-txt-tanggal" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="d-txt-jam-masuk">Jam Masuk</label>
                        <input type="text" id="d-txt-jam-masuk" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="d-txt-jam-keluar">Jam Keluar</label>
                        <input type="text" id="d-txt-jam-keluar" class="form-control" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL - DELETE => CONFIRMATION -->
<div class="modal fade" id="modal-delete-history" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">KONFIRMASI !</h5>
            </div>
            <div class="modal-body">
                <div id="msg-modal-delete"></div>
            </div>
            <div class="modal-footer">
                <a id="btn-modal-delete-process" class="btn btn-danger">YA</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TIDAK</button>
            </div>
        </div>
    </div>
</div>