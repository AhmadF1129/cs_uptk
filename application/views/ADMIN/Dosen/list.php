<div class="container">
    <div class="row mt-3">
        <div class="col">
            <div id="page-title" class="mb-3 mt-5">
                <h5><?= $pageTitle ?></h5>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <div id="search_area">
                        <input type="text" id="search-data-dosen" name="search-data-dosen" placeholder="Search" class="form-control">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="float-right">
                        <button class="btn btn-success fas fa-plus-square mb-3" title="ADD" href="#modal-add-edit-dosen" data-toggle="modal" data-btn-show-modal-mode="ADD-INIT">
                            <span class="ml-2">ADD</span>
                        </button>
                    </div>
                </div>
            </div>

            <?= $this->session->flashdata('page-flash') ?>

            <div id="data-dosen"></div>
        </div>
    </div>
</div>