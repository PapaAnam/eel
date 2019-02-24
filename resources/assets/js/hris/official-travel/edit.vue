<template>
	<div>
		<div class="mac">
			<mac-header title="Edit Official Travel" :icon="[icons.officialTravel]"></mac-header>
			<div class="mac-content">
				<div class="row">
					<div class="col-md-12">
						<router-link to="/official-travel">
							<batal-btn text="Back"></batal-btn>
						</router-link>
					</div>
					<form id="edit-form">
						<div class="col-md-4">
							<div class="panel panel-default">
								<div class="panel-heading">New</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<input-number :value="officialTravel.sppd" id="sppd" label="SPPD Number"></input-number>
										</div>
										<div class="col-md-12">
											<input-text readonly :value="'('+officialTravel.nin+') '+officialTravel.emp"></input-text>
										</div>
										<div class="col-md-12">
											<employees-select id="assignor" label="Assignor"></employees-select>
										</div>
										<div class="col-md-12">
											<input-text :value="officialTravel.depart_from" id="depart_from"></input-text>
										</div>
										<div class="col-md-12">
											<input-datetime :value="date(officialTravel.start_date)" id="start_date"></input-datetime>
										</div>
										<div class="col-md-12">
											<input-datetime :value="date(officialTravel.end_date)" id="end_date"></input-datetime>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									Area
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-sm-12">
											<input-text :id="'area_1'" :value="officialTravel.area_1"></input-text>
										</div>
										<div class="col-sm-12">
											<input-text :id="'area_2'" :value="officialTravel.area_2"></input-text>
										</div>
										<div class="col-sm-12">
											<input-text :id="'area_3'" :value="officialTravel.area_3"></input-text>
										</div>
										<div class="col-sm-12">
											<input-text :id="'area_4'" :value="officialTravel.area_4"></input-text>
										</div>
										<div class="col-sm-12">
											<input-text :id="'area_5'" :value="officialTravel.area_5"></input-text>
										</div>
										<div class="col-sm-12">
											<input-text :id="'area_6'" :value="officialTravel.area_6"></input-text>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									Cost And Other
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<input-number :value="officialTravel.advanced_cost" id="advanced_cost"></input-number>
										</div>
										<div class="col-md-12">
											<input-number :value="officialTravel.lodging_cost" id="lodging_cost"></input-number>
										</div>
										<div class="col-md-12">
											<input-number :value="officialTravel.eat_cost" id="eat_cost"></input-number>
										</div>
										<div class="col-md-12">
											<input-number :value="officialTravel.fuel_cost" id="fuel_cost"></input-number>
										</div>
										<div class="col-md-12">
											<input-number :value="officialTravel.other_cost" id="other_cost"></input-number>
										</div>
										<div class="col-md-12">
											<simpan-btn @click.native.prevent="simpan" text="Update" :saving="saving"></simpan-btn>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="mac-footer"></div>
		</div>
		<mac-preloader :icon="[icons.officialTravel]" :bg="bgTiles.officialTravel"></mac-preloader>
	</div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
export default{
	data(){
		return {
			saving : false	
		}
	},
	methods : {
		...mapActions([
			'updateOfficialTravel', 'getOfficialTravel'
			]),
		simpan(){
			if(!this.saving){
				this.saving = true
				this.updateOfficialTravel(new FormData(document.getElementById('edit-form'))).then(()=>{
					this.saving = false
				})
			}
		},
		date(date){
			if(date)
				return date.substr(8,2)+date.substr(5,2)+date.substr(0,4)+date.substr(11,2)+date.substr(14,2)
			return ''
		}
	},
	created(){
		this.$store.state.officialTravelEditable = {
			status : true,
			id : this.$route.params.id
		}
		if(this.officialTravels.length > 0){
			const data = _.find(this.officialTravels, (o) => {
				return o.id == this.$route.params.id
			})
			console.log(data)
			this.$store.commit('SET_OFFICIAL_TRAVEL', data)
		}else{
			this.getOfficialTravel()
		}
	},
	computed : {
		...mapGetters([
			'icons', 'bgTiles', 'officialTravel', 'officialTravels', 'employees'
			])
	},
	watch : {
		employees(newVal){
			setTimeout(()=>{
				$('#assignor').val(this.officialTravel ? this.officialTravel.assignor : _.first(this.$store.getters.employees).id).select2()
			}, 500)
		}
	},
	mounted(){
		this.$store.dispatch('showView')
		fadeOutPreloader()
	}
}
</script>