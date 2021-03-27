<script>
    $(document).ready(function() {

        load_data_ketinggalan();

        function load_data_ketinggalan(query) {
            $.ajax({
                url: 'cKetinggalan/loadData',
                method: 'POST',
                data: {
                    query: query
                },
                success: function(res) {
                    // console.log(result)
                    $('#data-ketinggalan').html(res);
                },
                error: function(err) {
                    console.log(err);
                }
            })
        }

        $('#search-data-ketinggalan').keyup(function() {
            var search = $(this).val();
            if (search != '') {
                // console.log(search)
                load_data_ketinggalan(search);
            } else {
                load_data_ketinggalan();
            }
        });
    });
</script>