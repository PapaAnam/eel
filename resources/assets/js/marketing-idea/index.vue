<template>
	<div>
		<skin></skin>
		<about-app></about-app>
		<div class="menu">
			<hider></hider>
			<tiles></tiles>
		</div>
		<mac></mac>
		<whats-new></whats-new>
	</div>
</template>
<script>
	import hider from './header'
	import tiles from './tiles/all'
	export default {
		methods : {
			getActiveUser(){
				axios('user/active').then(res=>{
					this.$store.commit('SET_ACTIVE_USER', res.data)
				}).catch(err=>{

				})
			},
			getAnimationSetting(){
				myApi('setting/animation-icon').then(res=>{
					this.$store.commit('SET_ANIMATION', res.data)
				}).catch(err=>{

				})
			}
		},
		created(){
			// this.getActiveUser()
			this.getAnimationSetting()
		},
		mounted(){
		},
		components : {
			hider, tiles
		}
	}
</script>
<style lang="scss">
@media screen and (min-width: 320px) and (max-width: 425px){
	body {
		overflow-y: auto;
		overflow-x: hidden;
	}
	.tile-area {
		margin-left: -150px;
		left: 50%;
	}
	.menu{
		padding-bottom: 20px;
		.single-tile-group {
			float: left;

			.tile-large {
				width: 260px;
				height: 260px;
			}
			.tile-wide {
				width: 260px;
				height : 125px;
			}
			.tile-square-x {
				width: 125px;
				height : 125px;
			}
			.tile {
				width: 125px;
				height : 125px;
			}
			.icon {
				width: 50px;
				height: 50px;
				font-size: 50px !important;
				margin-left: -25px !important;
			}
		}
	}
	.mac {

		.panel-body {
			overflow-x: auto;
		}
	}
	.mac-preloader {
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
	}
}
@media screen and (min-width: 768px) and (max-width: 1023px){
	.menu{
		padding-bottom: 20px;
		.menu-body { 
		}
		.single-tile-group {
			width: 240px;
			float: left;

			.tile-large {
				width: 220px;
				height: 220px;
			}
			.tile-wide {
				width: 220px;
				height : 105px;
			}
			.tile-square-x {
				width: 105px;
				height : 105px;
			}
			.tile {
				width: 105px;
				height : 105px;
			}
			.icon {
				width: 55px;
				height: 55px;
				font-size: 40px !important;
				margin-left: -27.5px !important;
				margin-top: -27.5px !important;
			}
		}
	}
	.mac {

		.panel-body {
			overflow-x: auto;
		}
	}
	.mac-preloader {
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
	}
}
@media screen and (min-width: 1440px) and (max-width: 1920px){
	body {
		overflow-y: auto;
	}
	.menu{
		padding-bottom: 20px;
		.menu-body { 
		}
		.single-tile-group {
			width: 440px;
			float: left;

			.tile-large {
				width: 370px;
				height: 370px;
				margin: 10px;
			}
			.tile-wide {
				width: 370px;
				height : 175px;
				margin: 10px;
			}
			.tile-square-x {
				width: 175px;
				height : 175px;
				margin: 10px;
			}
			.tile {
				width: 175px;
				height : 175px;
				margin: 10px;
			}
			.icon {
				width: 75px;
				height: 75px;
				font-size: 75px !important;
				margin-left: -37.5px !important;
				margin-top: -37.5px !important;
			}
			.tile-label {
				font-size: 20px;
			}
		}
	}
}
@media screen and (min-width: 2560px){
	body {
		overflow-y: auto;
	}
	.menu{
		padding-bottom: 20px;
		.menu-body { 
		}
		.single-tile-group {
			width: 800px;
			float: left;

			.tile-large {
				width: 600px;
				height: 600px;
				margin: 10px;
			}
			.tile-wide {
				width: 600px;
				height : 290px;
				margin: 10px;
			}
			.tile-square-x {
				width: 290px;
				height : 290px;
				margin: 10px;
			}
			.tile {
				width: 290px;
				height : 290px;
				margin: 10px;
			}
			.icon {
				width: 110px;
				height: 110px;
				font-size: 110px !important;
				margin-left: -55px !important;
				margin-top: -55px !important;
			}
			.tile-label {
				font-size: 30px;
			}
		}
		.menu-title {
			h1 {
				font-size: 70px;
			}
		}
		.setting {
			button {
				width: 70px;
				height: 70px;
				font-size: 30px;
			}
		}
	}
	.mac-preloader {
		.fa {
			font-size : 200px;
		}
		.preloader-ring {
			height: 100px;
			width: 100px;
			.wrap {
				height: 100px;
				width: 100px;
				.circle { 
					height: 100px;
					width: 100px;
				}
			}
		}
	}
	.mac { 
		font-size: 30px;
		.mac-header {
			height: 50px;
		}
		.mac-content {
			height: calc(100% - 70px);
		}
	}
}
</style>