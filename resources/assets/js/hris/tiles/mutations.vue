<template>
	<div @click="to" data-tile="mutation" :class="['tile', $store.getters.bgTiles.mutation]" data-title="Mutations" data-role="tile">
		<div class="tile-content iconic" >
			<i :class="['icon', $store.getters.modul.mutation.icon]"></i>
		</div>
		<span class="tile-label">Mutations</span>
	</div>
</template>
<script>
export default {
	methods : {
		to(){
			if(this.$store.getters.activeUser.auth.mutation == 1){
				this.$router.push('mutations')
			}else{
				notAuthorizedMsg()
			}
		}
	}
}
</script>