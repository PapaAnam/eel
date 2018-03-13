<form id="remove-form" action="{{ route($modul.'.remove') }}" method="post">
	{{ csrf_field() }}
	<input type="hidden" name="id" id="remove-id">
	<input type="hidden" name="_method" value="DELETE">
</form>
<script type="text/javascript">
	function remove(id)
	{
		var confir = confirm('Are you sure?');
		if(confir){
			$('#remove-id').val(id);
			$.ajax({
				url : '{{ route($modul.'.remove') }}',
				data : $('#remove-form').serialize(),
				type : 'POST',
				success : function(r)
				{
					$.Notify({type: 'success', caption: 'Success', content: r});
					refreshTable();
				},
				error: function(xhr, status){
					if(xhr.status==500)
						$.Notify({type: 'alert', caption: 'Failed', content: 'Please check other relation data'});
				}
			})
		}
	}
</script>