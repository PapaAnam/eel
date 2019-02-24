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
				default : 'primary',
				type : String,
			},
			teks : {
				default : 'Edit',
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