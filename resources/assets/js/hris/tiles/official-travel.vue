<template>
	<div @click="to" :class="['tile', $store.getters.bgTiles.officialTravel]" data-role="tile">
		<div class="tile-content iconic">
			<i :class="['icon', $store.getters.modul.officialTravel.icon]"></i>
		</div>
		<span class="tile-label">Official Travel</span>
	</div>
</template>
<script>
export default {
	methods : {
		to(){
			if(this.$store.getters.activeUser.auth.official_travel == 1){
				this.$router.push('official-travel')
			}else{
				notAuthorizedMsg()
			}
		}
	}
}
</script>