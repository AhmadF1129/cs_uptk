<!-- MODAL - ADD EDIT -->
<div class="modal fade" id="modal-add-edit-dosen" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal-title" class="modal-title"></h5>
            </div>
            <div class="modal-body body-add-dosen">
                <form id="form-modal-add-edit-dosen" method="post" enctype="multipart/form-data">

                    <label for="txt-name-dosen">Nama Dosen</label>
                    <input type="text" id="txt-name-dosen" name="txt-name-dosen" class="form-control" required>

            </div>
            <div class="modal-footer">
                <button type="submit" id="btn-modal-add-edit-process" class="btn btn-success"></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL - DELETE => CONFIRMATION -->
<div class="modal fade" id="modal-delete-dosen" tabindex="-1" role="dialog">
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