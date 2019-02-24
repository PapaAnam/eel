<template>
	<div>
		<div class="mac">
			<mac-header title="Accounts" :icon="icons.account"></mac-header>
			<div class="mac-content">
				<div class="row">
					<div class="col-md-12">
						<router-link to="/accounts/new">
							<btn-primary text="New"></btn-primary>
						</router-link>
					</div>
					<div class="col-md-12">
						<accounts-view></accounts-view>
					</div>
				</div>
			</div>
			<div class="mac-footer"></div>
		</div>
		<!-- <mac-preloader :icon="icons.account" :bg="bgTiles.account"></mac-preloader> -->
	</div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
	mounted(){
		this.$store.dispatch('showView')
	},
	computed : {
		...mapGetters([ 'bgTiles', 'icons' ])
	}
}
</script>