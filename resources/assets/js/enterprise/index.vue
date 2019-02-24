<template>
	<div>
		<enterprise-header>
			<skin></skin>
			<div class="menu-title">
				<h1>{{ title }}</h1>
			</div>
			<div class="tile-area-controls">
				<skin-btn></skin-btn>
			</div>
		</enterprise-header>
		<enterprise-menu></enterprise-menu>
	</div>
</template>

<script>
export default {
	data(){
		return {
			cbg : localStorage.getItem('bg') || 'bg-blue',
			title : 'Enterprise Edition',
		}
	},
	methods : {
		changeBg(color){
			$('body').attr('class', '').addClass(color);
			localStorage.setItem('bg', color);
			this.cbg = color;
		}
	},
	created(){
		axios('/api/my-app-name').then(res=>{
			this.title = res.data
		})
	},
	mounted(){
		let v = this
		$('body').addClass(v.cbg);
		metro_init()
		v.changeBg(v.cbg)
	}
}
</script>
<style>
@media screen and (min-width: 768px){
	.menu {
		overflow-x: hidden;
		-webkit-overflow-x: hidden;
		-moz-overflow-x: hidden;
		-ms-overflow-x: hidden;
	}
}
</style>