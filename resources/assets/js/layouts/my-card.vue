<template>
	<b-card :header="title" :header-bg-variant="variant ? variant : 'primary'" header-text-variant="white">
		<slot></slot>
	</b-card>
</template>
<script>
export default {
	data(){
		return {
			
		}
	},
	props : ['title', 'variant'],
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