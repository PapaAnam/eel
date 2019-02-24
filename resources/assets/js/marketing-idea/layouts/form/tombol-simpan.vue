<template>
	<b-button :disabled="menyimpan" type="submit" :variant="variant">{{menyimpan ? teksMenyimpan : teks}}</b-button>
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
				default : 'Save',
				type : String,
			},
			menyimpan : {
				type : Boolean,
				default : false,
			},
			teksMenyimpan : {
				default : 'Saving',
				type : String,
			}
		},
		methods : {
			
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