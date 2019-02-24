<template>
	<my-card title="Data">
		<div class="row">
			<div class="col-md-12">
				<export-btn :url="exportUrl"></export-btn>
			</div>
			<div class="col-md-12">
				<my-dt :data="positions">
					<thead>
						<tr>
							<th width="10px">#</th>
							<th>Name</th>
							<th width="200px">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(s, index) in positions">
							<td>{{ ++index }}</td>
							<td>{{ s.name }}</td>
							<td>
								<edit-btn @click.prevent.native="edit(s.id)"></edit-btn>
								<hapus-btn @click.prevent.native="hapusPosition(s.id)"></hapus-btn>
							</td>
						</tr>
					</tbody>
				</my-dt>
			</div>
		</div>
	</my-card>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
	data(){
		return {
			exportUrl : base_url('/positions')
		}
	},
	computed : {
		...mapGetters([
			'positions'
			])
	},
	methods : {
		...mapActions([
			'getPositions', 'hapusPosition'
			]),
		edit(id){
			this.$store.state.positionEditable = {
				status : true,
				id
			}
			document.getElementsByClassName('mac-content')[0].scrollTo(0,0)
		}
	},
	watch : {
		// positions(){
		// 	// setDatatable()
		// 	setTimeout(() => {
		// 		$('.mac-preloader').fadeOut('slow')
		// 	}, 1500)
		// }
	},
	created(){
		this.getPositions()
	}
}
</script>