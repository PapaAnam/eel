<template>
	<div class="tile-area-controls">
		<skin-btn></skin-btn>
		<a href="#" @click.prevent="to" class="square-button fg-white bg-dark no-border"><span class="mif-switch"></span></a>
	</div>
</template>
<script>
export default {
	data(){
		return {
			
		}
	},
	props : [],
	watch : {
		
	},
	computed : {

	},
	methods : {
		to(){
			window.location = base_domain('/')
		}
	},
	created(){

	},
	mounted(){

	}
}
</script>