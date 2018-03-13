<script>
	var BASE_URL = '{{ config('app.url') }}'

	function base_url(uri = ''){
		return BASE_URL+uri
	}
</script>