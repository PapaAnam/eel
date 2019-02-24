<template>
	<div class="alert alert-danger" v-if="data.length == 0">
		No Data available
	</div>
	<div v-else class="table-responsive">
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
			},
			delay : {
				type : Number,
				default : 2000,
			}
		},
		watch : {
			data(v){
				if($.fn.DataTable.isDataTable($(this.$el).find('#datatable'))){
					$(this.$el).find('#datatable').DataTable().destroy()
				}
				setTimeout(()=>{
					$(this.$el).find('#datatable').DataTable()
				}, this.delay)
			}
		}
	}
</script>