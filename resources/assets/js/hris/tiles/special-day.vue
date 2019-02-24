<template>
	<div @click="to" :class="['tile', $store.getters.bgTiles.specialDay]" data-role="tile">
		<div class="tile-content iconic" >
			<i :class="['icon', $store.getters.modul.specialDay.icon]"></i>
		</div>
		<span class="tile-label">Special Day</span>
	</div>
</template>
<script>
export default {
	methods : {
		to(){
			if(this.$store.getters.activeUser.auth.special_day == 1){
				this.$router.push('special-day')
			}else{
				notAuthorizedMsg()
			}
		}
	}
}
</script>