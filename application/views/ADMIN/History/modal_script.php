<script>
    $(document).ready(function() {
        // MODAL - EXPORT
        $('#modal-export-history').on('show.bs.modal', function() {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('cGlobal/getExportModalInit') ?>',
                dataType: 'JSON',

                success: function(result) {
                    // console.log(result);
                    // Clean cmb-prodi Input Value
                    $('#cmb-jurusan-export').empty();
                    $('#cmb-ruangan-export').empty();

                    $.each(result.allJurusan, function(index, allJurusan) {
                        $('#cmb-jurusan-export').append('<option value="' + allJurusan.jurusan_id + '">' + allJurusan.jurusan_name + '</option>');
                    });
                    $.each(result.allRuangan, function(index, allRuangan) {
                        if (allRuangan.ruangan_id == 7 || allRuangan.ruangan_id == 9 || allRuangan.ruangan_id == 10) {
                            $('#cmb-ruangan-export').append('');
                        } else {
                            $('#cmb-ruangan-export').append('<option value="' + allRuangan.ruangan_id + '">' + allRuangan.ruangan_name + '</option>');
                        }
                    });
                },
                error: function(error) {
                    console.log(error)
                }
            });

        });

        document.querySelectorAll('.filter-by').forEach((radio, id) => {
            radio.addEventListener('click', () => {
                radio.childNodes[1].checked = true;
                let select = id == 0 ? 'Ruangan' : 'Jurusan';
                let disabled = id == 0 ? 'Jurusan' : 'Ruangan';
                document.querySelector(`#radio${select}`).checked = false;
                radioFilterByIsDisabled(`#radio${select}`, `#radio${disabled}`, 3);
            });
        });

        radioFilterByIsDisabled = (param1, param2, child) => {
            document.querySelectorAll(param1).forEach(() => {
                document.querySelector(param1).parentNode.parentNode.parentNode.childNodes[child].disabled = true;
                document.querySelector(param2).parentNode.parentNode.parentNode.childNodes[child].disabled = false;
            });
        }

        document.querySelectorAll('.time-line').forEach((radio, id) => {
            radio.addEventListener('click', () => {
                radio.childNodes[1].checked = true;
                let select = id == 0 ? 'Tahun' : 'Bulan';
                let disabled = id == 0 ? 'Bulan' : 'Tahun';
                document.querySelector(`#radio${select}`).checked = false;
                radioTimeLineIsDisabled(`#radio${select}`, `#radio${disabled}`, 3);
            });
        });

        radioTimeLineIsDisabled = (param1, param2, child) => {
            document.querySelectorAll(param1).forEach(() => {
                document.querySelector(param1).parentNode.parentNode.parentNode.childNodes[child].disabled = true;
                document.querySelector(param2).parentNode.parentNode.parentNode.childNodes[child].disabled = false;
            });
        }

        $.fn.exportData = function(format) {
            // FILTER BY
            const radioJurusan = document.querySelector('#radioJurusan');
            let whereFilterBy = '',
                valueFilterBy = '',
                filterBy_Info_Name = '',
                filterBy_Info_Value = '';
            if (radioJurusan.checked) {
                whereFilterBy = 'jurusan_id';
                valueFilterBy = $('#cmb-jurusan-export').children("option:selected").val();
                filterBy_Info_Name = 'Jurusan';
                filterBy_Info_Value = $('#cmb-jurusan-export').children("option:selected").html();
            } else {
                whereFilterBy = 'ruangan_id';
                valueFilterBy = $('#cmb-ruangan-export').children("option:selected").val();
                filterBy_Info_Name = 'Ruangan';
                filterBy_Info_Value = $('#cmb-ruangan-export').children("option:selected").html();
            }

            // TIME LINE
            const radioBulan = document.querySelector('#radioBulan');
            let whereTimeLine = '',
                valueTimeLine = '';
            if (radioBulan.checked) { // BULAN
                whereTimeLine = 'Bulan';
                valueTimeLine = $('#cmb-bulan').children("option:selected").val();
            } else { // TAHUN
                whereTimeLine = 'Tahun';
                valueTimeLine = $('#cmb-tahun').children("option:selected").val();
            }

            // EXECUTE
            $.ajax({ // AJAX 1 => GET DATA
                type: 'POST',
                url: 'cHistory/getExportData', // cPengaduan
                dataType: 'JSON',
                async: false,
                data: { // REQUEST_1
                    checkMode: format,
                    whereFilterBy: whereFilterBy,
                    valueFilterBy: valueFilterBy,
                    filterBy_Info_Name: filterBy_Info_Name,
                    filterBy_Info_Value: filterBy_Info_Value,

                    whereTimeLine: whereTimeLine,
                    valueTimeLine: valueTimeLine
                },
                success: function(res1) { // RESPONSE_1
                    // console.log(res1);

                    let pathURL = format == 'pdf' ? '<?= base_url('cExport/exportPDF'); ?>' : '<?= base_url('cExport/exportXLS'); ?>'

                    $.ajax({ // AJAX 2 => CREATE REPORT
                        type: 'POST',
                        url: pathURL, // cExport
                        dataType: 'JSON',
                        async: false,
                        data: { // REQUEST_2
                            jenisLayanan: res1.jenisLayanan,
                            filterBy: res1.filterBy,
                            padaWaktu: res1.padaWaktu,
                            tableFields: res1.tableFields,
                            tableData: res1.tableData
                        },
                        success: function(res2) { // RESPONSE_2
                            // console.log(res2);
                            if (res2.mode == 'pdf') { // PDF
                                if (res2.url) window.open(res2.url);
                            } else { // XLS
                                if (res2.file) window.open(res2.file);
                            }
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });

                },
                error: function(err) {
                    console.log(err);
                }
            });
        }

        // MODAL - DETAIL
        $('#modal-detail-history').on('show.bs.modal', function(e) {
            const detailRowID = $(e.relatedTarget).data('btn-show-modal-detail-row-id'); // get DETAIL button show modal data (Row ID) tag

            // Clean All Input Value
            $('#d-txt-jurusan').val('');
            $('#d-txt-prodi').val('');
            $('#d-txt-dosen').val('');
            $('#d-txt-matkul').val('');
            $('#d-txt-kondisi-awal').val('');
            $('#d-txt-kondisi-akhir').val('');
            $('#d-txt-hari').val('');
            $('#d-txt-tanggal').val('');
            $('#d-txt-jam-masuk').val('');
            $('#d-txt-jam-keluar').val('');

            $.ajax({
                type: 'POST',
                url: 'cHistory/getItemByID',
                dataType: 'JSON',
                data: {
                    rowID: detailRowID
                },

                success: function(result) {
                    $('#d-txt-jurusan').val(result.item.jurusan_name);
                    $('#d-txt-prodi').val(result.item.prodi_name);
                    $('#d-txt-dosen').val(result.item.dosen_name);
                    $('#d-txt-matkul').val(result.item.mata_kuliah);
                    $('#d-txt-kondisi-awal').val(result.item.kondisi_awal);
                    $('#d-txt-kondisi-akhir').val(result.item.kondisi_akhir);
                    $('#d-txt-hari').val(result.item.hari);
                    $('#d-txt-tanggal').val(result.item.tanggal);
                    $('#d-txt-jam-masuk').val(result.item.jam_masuk);
                    $('#d-txt-jam-keluar').val(result.item.jam_keluar);

                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        // MODAL - DELETE => CONFIRMATION
        $('#modal-delete-history').on('show.bs.modal', function(e) {
            const deleteInfo = $(e.relatedTarget).data('btn-show-modal-delete-info');
            const deleteRowID = $(e.relatedTarget).data('btn-show-modal-delete-row-id');

            $('#msg-modal-delete').html('Anda yakin ingin menghapus data pada tanggal : ' + deleteInfo.bold() + ' ini ?');
            $('#btn-modal-delete-process').attr('href', 'cHistory/deleteItem?rowID=' + deleteRowID);
        });
    });
</script>