<template>
	<div>
		<div class="mac">
			<mac-header title="New Official Travel" :icon="[icons.officialTravel]"></mac-header>
			<div class="mac-content">
				<b-row>
					<div class="col-md-12">
						<router-link to="/official-travel">
							<batal-btn text="Back"></batal-btn>
						</router-link>
					</div>
				</b-row>
				<form id="add-form" role="form" method="post">
					<div class="row">
						<div class="col-md-4">
							<my-card title="New">
								<div class="row">
									<div class="col-md-12">
										<input-number id="sppd" label="SPPD Number"></input-number>
									</div>
									<div class="col-md-12">
										<employees-select id="employee" label="Officer"></employees-select>
									</div>
									<div class="col-md-12">
										<employees-select id="assignor" label="Assignor"></employees-select>
									</div>
									<div class="col-md-12">
										<input-text id="depart_from"></input-text>
									</div>
									<div class="col-md-12">
										<input-datetime id="start_date"></input-datetime>
									</div>
									<div class="col-md-12">
										<input-datetime id="end_date"></input-datetime>
									</div>
								</div>
							</my-card>
						</div>
						<div class="col-sm-6 col-md-4">
							<my-card title="Area">
								<div class="row">
									<div class="col-sm-12" v-for="i in 6">
										<input-text :id="'area_'+i"></input-text>
									</div>
								</div>
							</my-card>
						</div>
						<div class="col-md-4">
							<my-card title="Cost And Other">
								<div class="row">
									<div class="col-md-12">
										<input-number id="advanced_cost"></input-number>
									</div>
									<div class="col-md-12">
										<input-number id="lodging_cost"></input-number>
									</div>
									<div class="col-md-12">
										<input-number id="eat_cost"></input-number>
									</div>
									<div class="col-md-12">
										<input-number id="fuel_cost"></input-number>
									</div>
									<div class="col-md-12">
										<input-number id="other_cost"></input-number>
									</div>
									<div class="col-md-12">
										<simpan-btn @click.native.prevent="simpan" :saving="saving"></simpan-btn>
									</div>
								</div>
							</my-card>
						</div>
					</div>
				</form>
			</div>
			<div class="mac-footer"></div>
		</div>
		<!-- <mac-preloader :icon="[icons.officialTravel]" :bg="bgTiles.officialTravel"></mac-preloader> -->
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
			'saveOfficialTravel'
			]),
		simpan(){
			if(!this.saving){
				this.saving = true
				this.saveOfficialTravel($('#add-form').serialize()).then(()=>{
					this.saving = false
				})
			}
		}
	},
	created(){
	},
	computed : {
		...mapGetters([
			'icons', 'bgTiles'
			])
	},
	mounted(){
		this.$store.dispatch('showView')
		fadeOutPreloader()
	}
}
</script>