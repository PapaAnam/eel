<template>
	<grid>
		<row>
			<cell>
				<my-data :data="drivers"></my-data>
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
			'drivers', 'moduls'
			])
	},
	methods : {
		...mapActions([
			'getAllDrivers'
			])
	},
	watch : {
		
	},
	created(){
		this.getAllDrivers()
		this.$store.commit('SET_MY_WINDOW', 'drivers')
	},
	mounted(){
	}
}
</script>