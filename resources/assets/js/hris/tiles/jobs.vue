<template>
	<div @click.prevent="to" data-tile="job" :class="['tile tile-square-x', $store.getters.bgTiles.position]" data-role="tile">
		<div class="tile-content iconic">
			<i :class="['icon', $store.getters.modul.jobTitle.icon]"></i>
		</div>
		<span class="tile-label">Job Title</span>
	</div>
</template>
<script>
export default {
	methods : {
		to(){
			if(this.$store.getters.activeUser.auth.job_title == 1){
				this.$router.push('jobs')
			}else{
				notAuthorizedMsg()
			}
		}
	}
}
</script>