<script>
    $(document).ready(function() {
        // ALERT - ANIMATION
        $('.admin-page-flash').hide(5000);
        $('.page-alert').hide(5000);

        // DATAGRID - SHOW DATA INIT
        load_data_user();

        function load_data_user(query) {
            $.ajax({
                url: 'cUser/loadData',
                method: 'POST',
                // dataType: 'JSON',
                data: {
                    query: query
                },
                success: function(result) {
                    // console.log(result);
                    $('#data-user').html(result);
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }

        // DATAGRID - SEARCH DATA
        $('#search-data-user').keyup(function() {
            var search = $(this).val();
            if (search != '') {
                load_data_user(search);
            } else {
                load_data_user();
            }
        });
    });
</script>