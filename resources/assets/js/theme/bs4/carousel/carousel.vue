<template>
	<div :id="id" class="carousel slide" data-ride="carousel">
		<slot></slot>
	</div>
</template>
<script>
export default {
	data(){
		return {
			
		}
	},
	props : ['id'],
	watch : {
		
	},
	computed : {

	},
	methods : {

	},
	created(){

	},
	mounted(){
	
	}
}
</script>