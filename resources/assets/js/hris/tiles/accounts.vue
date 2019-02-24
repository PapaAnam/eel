<template>
	<div @click="to" data-tile="account" :class="['tile', $store.getters.bgTiles.account]" data-title="Accounts" data-role="tile">
		<div class="tile-content iconic" >
			<i :class="['icon', $store.getters.modul.account.icon]" data-icon="fa fa-user-circle-o"></i>
		</div>
		<span class="tile-label">Accounts</span>
	</div>
</template>
<script>
export default {
	methods : {
		to(){
			if(this.$store.getters.activeUser.auth.account == 1){
				this.$router.push('accounts')
			}else{
				notAuthorizedMsg()
			}
		}
	}
}
</script>