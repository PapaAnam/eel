<template>
	<grid>
		<row>
			<cell>
				<my-data :data="sales"></my-data>
			</cell>
		</row>
	</grid>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
	data(){
		return {
		}
	},
	computed : {
		...mapGetters([
			'sales'
			])
	},
	methods : {
		...mapActions([
			'getAllSales'
			])
	},
	watch : {
		
	},
	created(){
		this.getAllSales()
		this.$store.commit('SET_MY_WINDOW', 'sales')
	},
	mounted(){
	}
}
</script>