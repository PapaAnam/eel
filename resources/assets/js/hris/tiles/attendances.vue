<template>
	<div @click="to" data-tile="attendance" :class="['tile', $store.getters.bgTiles.attendance]" data-title="Manage Attendance" data-role="tile">
		<div class="tile-content iconic" >
			<i :class="['icon', $store.getters.modul.attendance.icon]" data-icon="fa fa-bell-o"></i>
		</div>
		<span class="tile-label">Manage Attendance</span>
	</div>
</template>
<script>
export default {
	methods : {
		to(){
			if(this.$store.getters.activeUser.auth.attendance == 1){
				this.$router.push('attendances')
			}else{
				notAuthorizedMsg()
			}
		}
	}
}
</script>