<template>
	<div>
		<div class="mac">
			<mac-header title="Special Day" :icon="icons.specialDay"></mac-header>
			<div class="mac-content">
				<div class="row">
					<div class="col-md-6">
						<calendar></calendar>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12" v-if="!eventEditable.status">
								<event-add></event-add>
							</div>
							<div class="col-md-12" v-else>
								<event-edit></event-edit>
							</div>
							<div class="col-md-12">
								<event-view></event-view>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="mac-footer"></div>
		</div>
		<!-- <mac-preloader :icon="icons.specialDay" :bg="bgTiles.specialDay"></mac-preloader> -->
	</div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
	mounted(){
		this.$store.dispatch('showView')
		fadeOutPreloader()
	},
	computed : {
		...mapGetters(['bgTiles', 'icons','eventEditable'])
	}
}
</script>