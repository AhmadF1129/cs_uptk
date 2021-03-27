<script>
    $(document).ready(function() {
        // ALERT - ANIMATION
        $('.page-alert').hide(5000);

        // DATAGRID - SHOW DATA INIT
        load_data_dosen();

        function load_data_dosen(query) {
            $.ajax({
                url: 'cDosen/loadData',
                method: 'POST',
                // dataType: 'JSON',
                data: {
                    query: query
                },
                success: function(result) {
                    // console.log(result);
                    $('#data-dosen').html(result);
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }

        // DATAGRID - SEARCH DATA
        $('#search-data-dosen').keyup(function() {
            var search = $(this).val();
            if (search != '') {
                load_data_dosen(search);
            } else {
                load_data_dosen();
            }
        });
    });
</script>