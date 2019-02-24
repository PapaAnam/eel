<template>
	<div class="panel panel-default">
		<my-card title="Data">
			<div class="row">
				<div class="col-md-12">
					<export-btn :url="exportUrl"></export-btn>
				</div>
				<div class="col-md-12">
					<table class="table bordered border striped" id="datatable">
						<thead>
							<tr>
								<th width="10px">#</th>
								<th>SPPD</th>
								<th>Employee</th>
								<th>Dept/Pos</th>
								<th>Assignor</th>
								<th>Date</th>
								<th width="250px">Action</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(s, index) in officialTravels">
								<td>{{ ++index }}</td>
								<td>{{ s.sppd }}</td>
								<td>{{ '('+s.nin+') '+s.emp }}</td>
								<td>{{ s.department+'/'+s.position }}</td>
								<td>{{ '('+s.assnin+') '+s.ass }}</td>
								<td>{{ s.start_date.substr(0, 10)+' until '+s.end_date.substr(0, 10) }}</td>
								<td>
									<router-link :to="'/official-travel/detail/'+s.id">
										<detail-btn></detail-btn>
									</router-link>
									<router-link :to="'/official-travel/edit/'+s.id" @click.native="edit(s.id)">
										<edit-btn></edit-btn>
									</router-link>
									<hapus-btn @click.prevent.native="hapusOfficialTravel(s.id)"></hapus-btn>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</my-card>
	</div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
	data(){
		return {
			exportUrl : base_url('/official-travel')
		}
	},
	computed : {
		...mapGetters([
			'officialTravels',
			])
	},
	methods : {
		...mapActions([
			'getOfficialTravels', 'hapusOfficialTravel'
			]),
		edit(id){
			this.$store.state.officialTravelEditable = {
				status : true,
				id
			}
		}
	},
	watch : {
		officialTravels(){
			setDatatable()
			fadeOutPreloader()
		}
	},
	created(){
		this.getOfficialTravels()
	},
	mounted(){
		// setDatatable()
	}
}
</script>