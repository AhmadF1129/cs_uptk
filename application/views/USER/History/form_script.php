<script>
    $(document).ready(function() {
        // // SET isStart = false WHEN PAGE LOADED
        // history.pushState(null, "", location.href.split("?")[0]);

        // CUSTOM INPUT RULES
        $.validator.addMethod("valueNotEquals", function(value, element, arg) {
            return arg !== value;
        }, "Value must not equal arg.");

        // ALL INPUT RULES
        $("#form-input-history").validate({
            rules: {
                'txt-matkul': {
                    required: true
                },
                'cmb-ruangan': {
                    valueNotEquals: "default"
                },
                'cmb-dosen': {
                    valueNotEquals: "default"
                },
                'cmb-kondisi-awal': {
                    valueNotEquals: "default"
                }
            },
            messages: {
                'txt-matkul': {
                    required: "Tidak boleh kosong"
                },
                'cmb-ruangan': {
                    valueNotEquals: "Silahkan pilih terlebih dahulu"
                },
                'cmb-dosen': {
                    valueNotEquals: "Silahkan pilih terlebih dahulu"
                },
                'cmb-kondisi-awal': {
                    valueNotEquals: "Silahkan pilih terlebih dahulu"
                }
            }
        });

        // GET SESSION USER ID
        const sessionUserID = '<?= $this->session->userdata('id') ?>';

        // CLEAN ALL INPUT VALUE
        $('#txt-jurusan').val('');
        $('#txt-prodi').val('');
        $('#txt-kelas').val('');

        // GET ALL INPUT VALUE BY SESSION USER ID
        $.ajax({ // REQUEST_1
            type: 'POST',
            url: '<?= base_url('cGlobal/getUser_By_SessionUserID') ?>',
            dataType: 'JSON',
            data: {
                sessionUserID: sessionUserID
            },

            success: function(res1) { // RESPONSE_1
                // console.log(res1);

                $('#txt-jurusan').val(res1.item.jurusan_name);
                $('#txt-prodi').val(res1.item.prodi_name);
                $('#txt-kelas').val(res1.item.kelas);

                // GET COMBO BOX VALUE
                $.ajax({ // REQUEST_2
                    type: 'POST',
                    url: '<?= base_url('cGlobal/getInputHistoryFormInit') ?>',
                    dataType: 'JSON',

                    success: function(res2) { // RESPONSE_2
                        // console.log(res2);

                        // Clean cmb-prodi Input Value
                        $('#cmb-ruangan').empty();
                        $('#cmb-dosen').empty();

                        $('#cmb-ruangan').append('<option value="default">Choose ...</option>');
                        $.each(res2.allRuangan, function(index, allRuangan) {
                            if (allRuangan.ruangan_id == 7 || allRuangan.ruangan_id == 9 || allRuangan.ruangan_id == 10) {
                                $('#cmb-ruangan').append('');
                            } else {
                                $('#cmb-ruangan').append('<option value="' + allRuangan.ruangan_id + '">' + allRuangan.ruangan_name + '</option>');
                            }
                        });

                        $('#cmb-dosen').append('<option value="default">Choose ...</option>');
                        $.each(res2.allDosen, function(index, allDosen) {
                            $('#cmb-dosen').append('<option value="' + allDosen.dosen_id + '">' + allDosen.dosen_name + '</option>');
                        });
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>