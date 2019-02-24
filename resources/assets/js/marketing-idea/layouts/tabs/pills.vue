<template>
	<b-card no-body>
		<pills v-model="tabAktif">
			<slot></slot>
		</pills>
	</b-card>
</template>
<script>
	export default {
		data(){
			return {
				tabAktif : 0,
			}
		},
		props : {

		},
		methods : {
			setAktif(value){
				this.tabAktif = value
			}
		},
		computed : {

		},
		watch : {

		},
		created(){

		},
		mounted(){
			this.$on('aktif',this.setAktif)
		}
	}
</script>