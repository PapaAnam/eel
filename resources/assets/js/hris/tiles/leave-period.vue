<template>
	<div @click="to" :class="['tile', $store.getters.bgTiles.leavePeriod]" data-role="tile">
		<div class="tile-content iconic" >
			<i :class="['icon', $store.getters.modul.leavePeriod.icon]"></i>
		</div>
		<span class="tile-label">{{ $store.getters.modul.leavePeriod.title }}</span>
	</div>
</template>
<script>
export default {
	methods : {
		to(){
			if(this.$store.getters.activeUser.auth.leave_period == 1){
				this.$router.push('leave-period')
			}else{
				notAuthorizedMsg()
			}
		}
	}
}
</script>