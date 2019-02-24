<template>
	<div class="mac-header" style="background-color: #104479;">
		<div class="mac-icon float-left">
			<i :class="icon"></i>
		</div>
		<div class="mac-title float-left">{{ title }}</div>
		<router-link @click.native="close" to="/home">
			<div class="mac-close float-right text-white">
				<i class="fa fa-close"></i>
			</div>
		</router-link>
	</div>  
</template>

<script>
	export default {
		methods : {
			close(){
				$('.mac-view').find('.mac').fadeOut('slow')
			}
		},
		props : [
		'title', 'icon'
		],
	}
</script>
<style>
.mac-footer {
	background-color: #104479;
	height: 5px;
	border-bottom-right-radius: 10px;
	border-bottom-left-radius: 10px;
}
.mac-content {
	border-right: 5px solid #104479;
	border-left: 5px solid #104479;
	height: calc(100% - 40px);
	max-height: calc(100% - 40px);
}
.mac-header {
	height: 35px;
	border-top-right-radius: 10px;
	border-top-left-radius: 10px;
}
.mac {
	width: 98% !important;
	height: 98% !important;
	left: 1% !important;
	top: 1% !important;
	background-color: transparent;
}
.mac-close:hover {
    border-top-right-radius: 10px;
    transition: 1s;
}
</style>
