<template>
	<div v-if="!processing" class="scroll">
		<template v-if="data.length > 0">
			<table class="table table-bordered table-striped" id="datatable">
				<thead>
					<tr>
						<th width="10px">#</th>
						<th v-for="(d, key) in data[0]">
							{{ key }}
						</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(d, i) in data">
						<td>{{ ++i }}</td>
						<td v-for="(dd, key) in d">
							{{ dd }}
						</td>
					</tr>
				</tbody>
			</table>
		</template>
		<template v-else>
			No data available
		</template>
	</div>
	<div v-else>
		Getting data from server
	</div>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
	props : ['data'],
	computed : {
		...mapGetters([
			'processing'
			])
	},
	watch : {
		data(){
			$(this.$el).find('#datatable').DataTable('destroy')
			setTimeout(()=>{
				$(this.$el).find('#datatable').DataTable()
			}, 500)
		}
	}
}
</script>
<style scoped>
.scroll {
	overflow-x: auto;
}	
</style>