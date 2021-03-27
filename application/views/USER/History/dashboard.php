<div class="container">
    <div class="row mt-3">
        <div class="col-md">
            <center>

                <?= $this->session->flashdata('history-dashboard-page-flash') ?>

                <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#modal-logout-history-confirmation">
                    LOGOUT
                </button>
                <br>
                <img src="<?= base_url('assets/IMAGES/ATURAN_LAB.png') ?>" class="img-fluid" width="600" alt="Responsive image">
            </center>
        </div>
    </div>
</div>