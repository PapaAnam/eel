<template>
	<div class="table-responsive">
		<table class="table table-striped table-bordered" id="datatable">
			<slot></slot>
		</table>
	</div>
</template>
<script>
	export default {
		mounted(){
			$(this.$el).find('#datatable').DataTable()
		},
		props : {
			data : {
				type : Array,
				default : [],
			}
		},
		watch : {
			data(v){
				if($.fn.DataTable.isDataTable('#datatable')){
					$(this.$el).find('#datatable').DataTable().destroy()
				}
				setTimeout(()=>{
					$(this.$el).find('#datatable').DataTable()
				}, 1000)
			}
		}
	}
</script>