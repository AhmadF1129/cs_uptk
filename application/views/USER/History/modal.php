<!-- MODAL - LOGOUT => CONFIRMATION -->
<div class="modal fade text-dark" id="modal-logout-history-confirmation" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">KONFIRMASI !</h5>
            </div>
            <div class="modal-body">
                <div id="msg-modal-logout">
                    Hai <strong><?= strtoupper($this->session->userdata('name')) ?></strong>, anda yakin ingin keluar dari aplikasi ?
                </div>
            </div>
            <div class="modal-footer">
                <a id="btn-modal-logout-process" class="btn btn-danger" data-toggle="modal" href="#modal-kondisi-akhir">YA</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TIDAK</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL - HISTORY - KONDISI AKHIR -->
<div class="modal fade text-dark" id="modal-kondisi-akhir" tabindex="-1" role="dialog" aria-labelledby="modalLogoutLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLogoutLabel">KONDISI AKHIR RUANGAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-input-history-logout" action="editItem_updateHistoryPemakaian?flagFrom=fromLogout" method="POST" enctype="multipart/form-data">

                    <label for="cmb-kondisi-akhir">Kondisi Akhir Ruangan</label>
                    <select id="cmb-kondisi-akhir" name="cmb-kondisi-akhir" class="form-control">
                        <option value="default">Choose ...</option>
                        <option value="Rapi">Rapi</option>
                        <option value="Kurang Rapi">Kurang Rapi</option>
                    </select>
                    <button type="submit" class="btn btn-danger mt-5 float-right">LOGOUT</button>
                </form>
            </div>
        </div>
    </div>
</div>