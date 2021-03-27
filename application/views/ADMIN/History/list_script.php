<script>
    $(document).ready(function() {
        // ALERT - ANIMATION
        $('.page-alert').hide(5000);

        // DATAGRID - SHOW DATA INIT
        load_data_history();

        function load_data_history(query) {
            $.ajax({
                url: 'cHistory/loadData',
                method: 'POST',
                // dataType: 'JSON',
                data: {
                    query: query
                },
                success: function(result) {
                    // console.log(result);
                    $('#data-history').html(result);
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }

        // DATAGRID - SEARCH DATA
        $('#search-data-history').keyup(function() {
            var search = $(this).val();
            if (search != '') {
                load_data_history(search);
            } else {
                load_data_history();
            }
        });
    });
</script>