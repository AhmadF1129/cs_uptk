<script>
	$(document).ready(function() {
		// INIT
		loadData();

		function loadData(query) {
			$.ajax({
				url: 'searchItem',
				method: 'POST',
				data: {
					query: query
				},
				success: function(res) {
					$('#result').html(res);
				},
				error: function(err) {
					console.log(err);
				}
			})
		}

		$('#search-text').keyup(function() {
			var search = $(this).val();
			if (search != '') loadData(search);
			else loadData();
		});
	});
</script>