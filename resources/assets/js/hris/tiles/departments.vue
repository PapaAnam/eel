<template>
	<div @click.prevent="to" data-tile="department" href="#" :class="['tile-large', bgTiles.department]" data-title="Departments" data-role="tile">
		<div class="tile-content iconic">
			<i :class="['icon', $store.getters.modul.department.icon]" data-icon="fa fa-university"></i>
		</div>
		<span class="tile-label">Departments</span>
	</div>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
	computed : {
		...mapGetters(['bgTiles'])
	},
	methods : {
		to(){
			if(this.$store.getters.activeUser.auth.department == 1){
				this.$router.push('departments')
			}else{
				notAuthorizedMsg()
			}
		}
	}
}
</script>