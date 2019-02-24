<template>
	<div @click="to" :class="['tile', $store.getters.bgTiles.payroll]" data-role="tile" data-tile="payroll">
		<div class="tile-content iconic">
			<i :class="['icon', $store.getters.modul.payroll.icon]"></i>
		</div>
		<span class="tile-label">Payroll</span>
	</div>
</template>
<script>
export default {
	methods : {
		to(){
			if(this.$store.getters.activeUser.auth.payroll == 1){
				this.$router.push('payroll')
			}else{
				notAuthorizedMsg()
			}
		}
	}
}
</script>