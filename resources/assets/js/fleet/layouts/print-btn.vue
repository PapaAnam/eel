<template>
	<btn @click.native="print" default size="small"><i class="fa fa-print"></i> Print</btn>
</template>
<script>
export default {
	data(){
		return {
			
		}
	},
	props : ['link'],
	watch : {
		
	},
	computed : {

	},
	methods : {
		print(){
			if(this.link){
				window.open(this.link)
			}
		}
	},
	created(){

	},
	mounted(){
	
	}
}
</script>