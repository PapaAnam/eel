<template>
	<b-button @click="onClick" :variant="variant">{{teks}}</b-button>
</template>
<script>
	export default {
		data(){
			return {
				
			}
		},
		props : {
			variant : {
				default : 'success',
				type : String,
			},
			teks : {
				default : 'Detail',
				type : String,
			},
		},
		methods : {
			onClick(){
				this.$emit('click')
			}
		},
		computed : {
			
		},
		watch : {
			
		},
		created(){
			
		},
		mounted(){
			
		}
	}
</script>