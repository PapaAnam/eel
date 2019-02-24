<template>
	<div :class="TYPE">
		<slot></slot>
	</div>
</template>
<script>
export default {
	data(){
		return {
			
		}
	},
	props : {
		type : {
			default : 'md-12',
		}
	},
	watch : {
		
	},
	computed : {
		TYPE(){
			let t = ''
			for(let o of this.type){
				t += 'col-'+o+' '
			}
			return typeof this.type === 'object' ? t : 'col-'+this.type
		}
	},
	methods : {

	},
	created(){

	},
	mounted(){
	
	}
}
</script>