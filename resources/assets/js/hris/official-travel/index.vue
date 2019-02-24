<template>
	<div>
		<div class="mac">
			<mac-header title="Official Travel" :icon="[icons.officialTravel]"></mac-header>
			<div class="mac-content">
				<div class="row">
					<div class="col-md-12">
						<router-link to="/official-travel/new">
							<btn-primary text="New"></btn-primary>
						</router-link>
					</div>
					<div class="col-md-12">
						<official-travel-view></official-travel-view>
					</div>
				</div>
			</div>
			<div class="mac-footer"></div>
		</div>
		<!-- <mac-preloader :icon="[icons.officialTravel]" :bg="bgTiles.officialTravel"></mac-preloader> -->
	</div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
	data(){
		return {
			currentView : 'salary-rules-view'
		}
	},
	mounted(){
		this.$store.dispatch('showView')
		fadeOutPreloader()
		$('#employee').on('change', () => {
			this.getSalaryRule($('#employee').val())
		})
		document.title = 'Official Travel | '+$store.getters.appTitle
	},
	computed : {
		...mapGetters([
			'bgTiles',
			'icons'
			])
	},
	methods : {
		...mapActions([
			'getSalaryRule'
			]),
		filter(){
			this.getSalaryRule($('#employee').val())
		},
		baru(){
			this.currentView = 'salary-rules-new'
			this.getSalaryRule($('#employee').val())
		}
	},
}
</script>