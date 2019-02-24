<template>
	<div @click="toRouter" :class="['tile bunder', bg ? bg : setting.bgTile]" data-role="tile">
		<div class="tile-content iconic" >
			<i :class="['icon', icon ? icon : setting.icon]"></i>
		</div>
		<span class="tile-label">{{ title ? title : setting.title }}</span>
	</div>
</template>
<script>
	export default {
		props : ['title','icon','bg', 'setting', 'to'],
		methods : {
			toRouter(){
				if(this.$store.getters.activeUser.auth[this.to[1]] == 1){
					this.$router.push(this.to[0])
				}else{
					notAuthorizedMsg()
				}
			}
		}
	}
</script>