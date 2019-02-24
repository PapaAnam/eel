<template>
	<b-button @click="click" size="sm" variant="secondary" id="cancel">{{ cancelTxt }}</b-button>
</template>
<script>
	export default {
		methods : {
			click(){
				this.$emit('click')
			}
		},
		props : ['text'],
		computed : {
			cancelTxt(){
				return this.text ? this.text : 'Cancel'
			}
		}
	}
</script>
<style>
.batal-btn {
	border-radius: 0 !important;
}
/*.batal-btn:hover {
	color: white !important;
	}*/
</style>