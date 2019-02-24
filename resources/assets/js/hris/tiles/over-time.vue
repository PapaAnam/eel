<template>
	<div @click="to" data-tile="over-time" :class="['tile', $store.getters.bgTiles.overTime]" data-role="tile">
		<div class="tile-content iconic">
			<i :class="['icon', $store.getters.modul.overTime.icon]" data-icon="fa fa-gavel"></i>
		</div>
		<span class="tile-label">Over Time</span>
	</div>
</template>
<script>
export default {
	methods : {
		to(){
			if(this.$store.getters.activeUser.auth.over_time == 1){
				this.$router.push('over-time')
			}else{
				notAuthorizedMsg()
			}
		}
	}
}
</script>