<script>
    $(document).ready(function() {
        // MODAL - ADD EDIT
        $('#cmb-role').change(function() {
            const RoleID = this.value;

            if (RoleID == 1) { // ADMIN
                $('#user-content-only').attr('hidden', true);
                $('#txt-nim').removeAttr('required');
                $('#txt-kelas').removeAttr('required');
            } else { // USER
                $('#user-content-only').removeAttr('hidden');
                $('#txt-nim').attr('required', true);
                $('#txt-kelas').attr('required', true);
            }
        });

        $('#cmb-jurusan').change(function() {
            const JurusanID = this.value;

            $.ajax({
                type: 'POST',
                url: '<?= base_url('cGlobal/getAddEditModalInit_getAllProdiByJurusanID') ?>',
                dataType: 'JSON',
                data: {
                    JurusanID: JurusanID
                },

                success: function(result) {
                    const btnModalProcessMode = $('#btn-modal-add-edit-process').data('btn-modal-add-edit-process-mode');

                    // Clean cmb-prodi Input Value
                    $('#cmb-prodi').empty();

                    if (btnModalProcessMode == 'ADD') {
                        $.each(result.allProdiByJurusanID, function(index, allProdiByJurusanID) {
                            $('#cmb-prodi').append('<option value="' + allProdiByJurusanID.prodi_id + '">' + allProdiByJurusanID.prodi_name + '</option>');
                        });

                    } else {
                        const prodiID = $('#cmb-prodi').data('prodi-id');

                        $.each(result.allProdiByJurusanID, function(index, allProdiByJurusanID) {
                            if (allProdiByJurusanID.prodi_id == prodiID) { // m_program_studi.id == tb_users.prodi_id
                                $('#cmb-prodi').append('<option value="' + allProdiByJurusanID.prodi_id + '" selected>' + allProdiByJurusanID.prodi_name + '</option>');
                            } else {
                                $('#cmb-prodi').append('<option value="' + allProdiByJurusanID.prodi_id + '">' + allProdiByJurusanID.prodi_name + '</option>');
                            }
                        });
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        $('#modal-add-edit-user').on('show.bs.modal', function(e) {
            const btnShowModalMode = $(e.relatedTarget).data('btn-show-modal-mode'); // get each (ADD/EDIT) button show modal data (Mode) tag

            $.ajax({ // REQUEST 1 = Get Initial Custom Item of "modal-add-edit-user" (cGlobal/add_edit_ModalInit)
                type: 'POST',
                url: '<?= base_url('cGlobal/getAddEditModalInit') ?>',
                dataType: 'JSON',
                data: {
                    btnShowModalMode: btnShowModalMode
                },

                success: function(res1) { // RESPONSE 1

                    // Clean All Input Value
                    $('#modal-title').html('');
                    $('#form-modal-add-edit-user').removeAttr('action');
                    $('#cmb-role').empty();
                    $('#txt-username').val('');
                    $('#txt-password').val('');
                    $('#txt-name').val('');
                    $('#txt-email').val('');
                    $('#txt-phone-no').val('');
                    $('#txt-nim').val('');
                    $('#cmb-jurusan').empty();
                    $('#cmb-prodi').empty();
                    $('#txt-kelas').val('');
                    $('#btn-modal-add-edit-process').html('');
                    $('#btn-modal-add-edit-process').removeAttr('data-btn-modal-add-edit-process-mode');

                    if (res1.btnProcessMode == 'ADD') { // ===================== ADD =====================
                        // modal title
                        $('#modal-title').html(res1.title);

                        // form action
                        $('#form-modal-add-edit-user').attr('action', 'cUser/addItem');

                        // role
                        $('#select-role').removeAttr('hidden');
                        $.each(res1.allRole, function(index, allRole) {
                            $('#cmb-role').append('<option value="' + allRole.role_id + '">' + allRole.role_name + '</option>');

                            // Trigger on Change for user-content-only | value = ADMIN
                            $('#cmb-role').val(1).change();
                        });

                        // username
                        $('#txt-username').val('');

                        // set password => password
                        $('#set-password').removeAttr('hidden');
                        $('#txt-password').val('');

                        // name | email | phone no
                        $('#txt-name').val('');
                        $('#txt-email').val('');
                        $('#txt-phone-no').val('');

                        // user content only => nim | jurusan | program studi | kelas => (depends on cmb-role content)
                        $('#txt-nim').val('');
                        let i = 1;
                        $.each(res1.allJurusan, function(index, allJurusan) {
                            $('#cmb-jurusan').append('<option value="' + allJurusan.jurusan_id + '">' + allJurusan.jurusan_name + '</option>');

                            /* ============== */
                            // Print Prodi for Init (Jurusan) Only (First Get Only)
                            // Trigger on Change from cmb-jurusan (jurusan) for cmb-prodi (program studi) content | value = allJurusan.jurusan_id
                            if (i == 1) $('#cmb-jurusan').val(allJurusan.jurusan_id).change();
                            i++;
                            /* ============== */
                        });
                        $('#txt-kelas').val('');

                        // modal process button
                        $('#btn-modal-add-edit-process').html(res1.btnProcessMode);
                        $('#btn-modal-add-edit-process').attr('data-btn-modal-add-edit-process-mode', res1.btnProcessMode);

                    } else { // ===================== EDIT =====================
                        const editRowID = $(e.relatedTarget).data('btn-show-modal-edit-row-id'); // get EDIT button show modal data (Row ID) tag

                        // REQUEST 2 = Get Item of "modal-add-edit-user" on Edit Mode (cUser/getItemByID)
                        $.ajax({
                            type: 'POST',
                            url: 'cUser/getItemByID',
                            dataType: 'JSON',
                            data: {
                                rowID: editRowID
                            },

                            // RESPONSE 2
                            success: function(res2) {
                                // res1 => cGlobal/add_edit_ModalInit | res2 => cUser/getItemByID

                                // modal title
                                $('#modal-title').html(res1.title);

                                // form action
                                $('#form-modal-add-edit-user').attr('action', 'cUser/editItem?rowID=' + editRowID);

                                // role
                                $('#select-role').attr('hidden', true);
                                $.each(res1.allRole, function(index, allRole) {
                                    if (allRole.role_id == res2.item.role_id) { // m_role.id == tb_users.role_id
                                        $('#cmb-role').append('<option value="' + allRole.role_id + '" selected>' + allRole.role_name + '</option>');

                                        // Trigger on Change for user-content-only | value = res2.item.role_id
                                        $('#cmb-role').val(res2.item.role_id).change();
                                    } else {
                                        $('#cmb-role').append('<option value="' + allRole.role_id + '">' + allRole.role_name + '</option>');
                                    }
                                });

                                // username
                                $('#txt-username').val(res2.item.username);

                                // set password => password
                                $('#set-password').attr('hidden', true);
                                $('#txt-password').removeAttr('required');
                                $('#txt-password').val('');

                                // name | email | phone no
                                $('#txt-name').val(res2.item.name);
                                $('#txt-email').val(res2.item.email);
                                $('#txt-phone-no').val(res2.item.phone_no);

                                // user content only => nim | jurusan | program studi | kelas => (depends on cmb-role content)
                                $('#txt-nim').val(res2.item.nim);

                                $.each(res1.allJurusan, function(index, allJurusan) {
                                    if (allJurusan.jurusan_id == res2.item.jurusan_id) { // m_jurusan.id == tb_users.jurusan_id
                                        $('#cmb-jurusan').append('<option value="' + allJurusan.jurusan_id + '" selected>' + allJurusan.jurusan_name + '</option>');

                                        /* ============== */
                                        // Set data-prodi-id for compare on change as selected result1
                                        $('#cmb-prodi').attr('data-prodi-id', res2.item.prodi_id);
                                        // Trigger on Change from cmb-jurusan (jurusan) for cmb-prodi (program studi) content | value = res2.item.jurusan_id
                                        $('#cmb-jurusan').val(res2.item.jurusan_id).change();
                                        /* ============== */
                                    } else {
                                        $('#cmb-jurusan').append('<option value="' + allJurusan.jurusan_id + '">' + allJurusan.jurusan_name + '</option>');
                                    }
                                });
                                $('#txt-kelas').val(res2.item.kelas);

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

        // MODAL - DETAIL
        $('#d-txt-role').change(function() {
            const RoleName = this.value;

            RoleName == 'Admin' ?
                $('#d-user-content-only').attr('hidden', true) :
                $('#d-user-content-only').removeAttr('hidden');
        });

        $('#modal-detail-user').on('show.bs.modal', function(e) {
            const detailRowID = $(e.relatedTarget).data('btn-show-modal-detail-row-id'); // get DETAIL button show modal data (Row ID) tag

            // Clean All Input Value
            $('#d-txt-role').val('');
            $('#d-txt-username').val('');
            $('#d-txt-name').val('');
            $('#d-txt-email').val('');
            $('#d-txt-phone-no').val('');
            $('#d-txt-nim').val('');
            $('#d-txt-jurusan').val('');
            $('#d-txt-prodi').val('');
            $('#d-txt-kelas').val('');

            $.ajax({
                type: 'POST',
                url: 'cUser/getItemByID',
                dataType: 'JSON',
                data: {
                    rowID: detailRowID
                },

                success: function(result) {
                    $('#d-txt-role').val(result.item.role_name).change(); // on DETAIL => Trigger on Change for user-content-only
                    $('#d-txt-username').val(result.item.username);
                    $('#d-txt-name').val(result.item.name);
                    $('#d-txt-email').val(result.item.email);
                    $('#d-txt-phone-no').val(result.item.phone_no);
                    $('#d-txt-nim').val(result.item.nim);
                    $('#d-txt-jurusan').val(result.item.jurusan_name);
                    $('#d-txt-prodi').val(result.item.prodi_name);
                    $('#d-txt-kelas').val(result.item.kelas);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        // MODAL - DELETE => CONFIRMATION
        $('#modal-delete-user').on('show.bs.modal', function(e) {
            const deleteInfo = $(e.relatedTarget).data('btn-show-modal-delete-info');
            const deleteRowID = $(e.relatedTarget).data('btn-show-modal-delete-row-id');

            $('#msg-modal-delete').html('Anda yakin ingin menghapus data dengan Nama : ' + deleteInfo.bold() + ' ini ?');
            $('#btn-modal-delete-process').attr('href', 'cUser/deleteItem?rowID=' + deleteRowID);
        });

        // MODAL - CHANGE PASSWORD
        $('#modal-change-password').on('show.bs.modal', function(e) {
            const cpInfo = $(e.relatedTarget).data('btn-show-modal-change-password-info');
            const cpRowID = $(e.relatedTarget).data('btn-show-modal-change-password-row-id');

            $('#form-modal-change-password').attr('action', 'cUser/changePassword?rowID=' + cpRowID);
            $('#cp-name').html(cpInfo);
        });

        $("#form-modal-change-password").validate({
            rules: {
                'new-password': {
                    required: true,
                    minlength: 4,
                },
                'repeat-password': {
                    required: true,
                    equalTo: "#new-password",
                }
            },
            messages: {
                'new-password': {
                    required: "Tidak boleh kosong",
                    minlength: "Minimal 4 Karakter",
                },
                'repeat-password': {
                    required: "Tidak boleh kosong",
                    equalTo: "Repeat Password tidak sama",
                }
            }
        });
    });
</script>