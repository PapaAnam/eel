<template>
	<mac-view title="Detail Official Travel" module="officialTravel">
		<div class="row">
			<div class="col-md-12">
				<router-link to="/official-travel">
					<batal-btn text="Back"></batal-btn>
				</router-link>
			</div>
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-info">
					<div class="panel-heading">
						Detail
					</div>
					<div class="panel-body">
						<table class="table table-bordered table-striped">
							<tbody>
								<tr>
									<td colspan="2"><h4 class="text-center"><strong>Officer</strong></h4></td>
								</tr>
								<tr>
									<td width="200px"><strong>Employee</strong></td>
									<td>{{ officialTravel.emp }}</td>
								</tr>
								<tr>
									<td><strong>Department</strong></td>
									<td>{{ officialTravel.department }}</td>
								</tr>
								<tr>
									<td><strong>Position</strong></td>
									<td>{{ officialTravel.position }}</td>
								</tr>
								<tr>
									<td colspan="2"><h4 class="text-center"><strong>Assignor</strong></h4></td>
								</tr>
								<tr>
									<td><strong>Employee</strong></td>
									<td>{{ officialTravel.ass }}</td>
								</tr>
								<tr>
									<td><strong>Department</strong></td>
									<td>{{ officialTravel.assdep }}</td>
								</tr>
								<tr>
									<td><strong>Position</strong></td>
									<td>{{ officialTravel.asspos }}</td>
								</tr>
								<tr>
									<td colspan="2"><h4 class="text-center"><strong>Area</strong></h4></td>
								</tr>
								<tr v-for="i in 6">
									<td><strong>Area {{ i }}</strong></td>
									<td>{{ officialTravel['area_'+i] }}</td>
								</tr>
								<tr>
									<td colspan="2"><h4 class="text-center"><strong>Cost And Other</strong></h4></td>
								</tr>
								<tr>
									<td><strong>SPPD</strong></td>
									<td>{{ officialTravel.sppd }}</td>
								</tr>
								<tr>
									<td><strong>Start Date</strong></td>
									<td>{{ officialTravel.start_date }}</td>
								</tr>
								<tr>
									<td><strong>End Date</strong></td>
									<td>{{ officialTravel.end_date }}</td>
								</tr>
								<tr>
									<td><strong>Depart From</strong></td>
									<td>{{ officialTravel.depart_from }}</td>
								</tr>
								<tr>
									<td><strong>Advanced Cost ($)</strong></td>
									<td align="right">{{ officialTravel.advanced_cost }}</td>
								</tr>
								<tr>
									<td><strong>Lodging/Hotel Cost ($)</strong></td>
									<td align="right">{{ officialTravel.lodging_cost }}</td>
								</tr>
								<tr>
									<td><strong>Eat Cost ($)</strong></td>
									<td align="right">{{ officialTravel.eat_cost }}</td>
								</tr>
								<tr>
									<td><strong>Fuel Cost ($)</strong></td>
									<td align="right">{{ officialTravel.fuel_cost }}</td>
								</tr>
								<tr>
									<td><strong>Other Cost ($)</strong></td>
									<td align="right">{{ officialTravel.other_cost }}</td>
								</tr>
								<tr>
									<td><strong>Created At</strong></td>
									<td>{{ officialTravel.created_at }}</td>
								</tr>
								<tr>
									<td><strong>Report At</strong></td>
									<td>{{ officialTravel.report_at }}</td>
								</tr>
							</tbody>
						</table>		
					</div>
				</div>
			</div>
		</div>
	</mac-view>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
	computed : {
		...mapGetters([
			'officialTravel'
			])
	},
	methods : {
		...mapActions([
			'getOfficialTravel'
			]),
		date(date){
			if(date)
				return date.substr(8,2)+date.substr(5,2)+date.substr(0,4)+date.substr(11,2)+date.substr(14,2)
			return ''
		}
	},
	watch : {
		officialTravel(){
			fadeOutPreloader()
		}
	},
	created(){
		this.$store.state.officialTravelEditable = {
			id : this.$route.params.id,
			status : true
		}
		this.getOfficialTravel()
	}
}
</script>