<template>
	<div @click="to" data-tile="salary-rule" :class="['tile-wide', $store.getters.bgTiles.salaryRules]" data-role="tile">
		<div class="tile-content iconic">
			<i :class="['icon', $store.getters.modul.salaryRule.icon]"></i>
		</div>
		<span class="tile-label">Salary Rules</span>
	</div>
</template>
<script>
export default {
	methods : {
		to(){
			if(this.$store.getters.activeUser.auth.salary_rule == 1){
				this.$router.push('salary-rules')
			}else{
				notAuthorizedMsg()
			}
		}
	}
}
</script>