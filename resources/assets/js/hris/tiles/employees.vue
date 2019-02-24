<template>
	<div @click.prevent="to" data-tile="employee" :class="['tile', $store.getters.bgTiles.employee]" data-title="Employees" data-role="tile">
		<div class="tile-content iconic">
			<i :class="['icon', $store.getters.modul.employee.icon]"></i>
		</div>
		<span class="tile-label">Employees</span>
	</div>
</template>
<script>
export default {
	methods : {
		to(){
			if(this.$store.getters.activeUser.auth.employee == 1){
				this.$router.push('employees')
			}else{
				notAuthorizedMsg()
			}
		}
	}
}
</script>