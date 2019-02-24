<template>
	<div class="mac">
		<mac-header title="Job Title" :icon="$store.getters.modul.jobTitle.icon"></mac-header>
		<div class="mac-content">
			<div class="row">
				<div class="col-md-8">
					<job-view></job-view>
				</div>
				<div class="col-md-4">
					<job-add></job-add>
					<job-edit :id="$store.state.positionEditable.id"></job-edit>
				</div>
			</div>
		</div>
		<div class="mac-footer"></div>
	</div>
</template>
<script>
	import { mapGetters, mapActions } from 'vuex'
	export default {
		mounted(){
			this.$store.dispatch('showView')
		},
		computed : {
			...mapGetters(['bgTiles'])
		}
	}
</script>