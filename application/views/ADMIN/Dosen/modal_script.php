<script>
    $(document).ready(function() {
        // MODAL - ADD EDIT
        $('#modal-add-edit-dosen').on('show.bs.modal', function(e) {
            const btnShowModalMode = $(e.relatedTarget).data('btn-show-modal-mode'); // get each (ADD/EDIT) button show modal data (Mode) tag

            $.ajax({ // REQUEST 1 = Get Initial Custom Item of "modal-add-edit-dosen" (cGlobal/add_edit_ModalInit)
                type: 'POST',
                url: '<?= base_url('cGlobal/getAddEditModalInit') ?>',
                dataType: 'JSON',
                data: {
                    btnShowModalMode: btnShowModalMode
                },

                success: function(res1) { // RESPONSE 1

                    // Clean All Input Value
                    $('#modal-title').html('');
                    $('#form-modal-add-edit-dosen').removeAttr('action');
                    $('#txt-name-dosen').val('');
                    $('#btn-modal-add-edit-process').html('');
                    $('#btn-modal-add-edit-process').removeAttr('data-btn-modal-add-edit-process-mode');

                    if (res1.btnProcessMode == 'ADD') { // ===================== ADD =====================
                        // modal title
                        $('#modal-title').html(res1.title);

                        // form action
                        $('#form-modal-add-edit-dosen').attr('action', 'cDosen/addItem');

                        // name
                        $('#txt-name-dosen').val('');

                        // modal process button
                        $('#btn-modal-add-edit-process').html(res1.btnProcessMode);
                        $('#btn-modal-add-edit-process').attr('data-btn-modal-add-edit-process-mode', res1.btnProcessMode);

                    } else { // ===================== EDIT =====================
                        const editRowID = $(e.relatedTarget).data('btn-show-modal-edit-row-id'); // get EDIT button show modal data (Row ID) tag

                        // REQUEST 2 = Get Item of "modal-add-edit-dosen" on Edit Mode (cDosen/getItemByID)
                        $.ajax({
                            type: 'POST',
                            url: 'cDosen/getItemByID',
                            dataType: 'JSON',
                            data: {
                                rowID: editRowID
                            },

                            // RESPONSE 2
                            success: function(res2) {
                                // res1 => cGlobal/add_edit_ModalInit | res2 => cDosen/getItemByID

                                // modal title
                                $('#modal-title').html(res1.title);

                                // form action
                                $('#form-modal-add-edit-dosen').attr('action', 'cDosen/editItem?rowID=' + editRowID);

                                // name
                                $('#txt-name-dosen').val(res2.item.name);

                                // modal process button
                                $('#btn-modal-add-edit-process').html(res1.btnProcessMode);
                                $('#btn-modal-add-edit-process').attr('data-btn-modal-add-edit-process-mode', res1.btnProcessMode);
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    }
                },
            });
        });

        // MODAL - DELETE => CONFIRMATION
        $('#modal-delete-dosen').on('show.bs.modal', function(e) {
            const deleteInfo = $(e.relatedTarget).data('btn-show-modal-delete-info');
            const deleteRowID = $(e.relatedTarget).data('btn-show-modal-delete-row-id');

            $('#msg-modal-delete').html('Anda yakin ingin menghapus data dengan Nama : ' + deleteInfo.bold() + ' ini ?');
            $('#btn-modal-delete-process').attr('href', 'cDosen/deleteItem?rowID=' + deleteRowID);
        });
    });
</script>