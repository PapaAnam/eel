<template>
	<div>
		<tile-group v-for="g in moduls" :key="g.id" double>
			<router-link v-for="m in g.content" @click.native="check(m.info)" :key="m.url" :to="m.url">
				<tile :size="m.size" :bg="m.bg" :label="m.caption">
					<tile-iconic :icon="m.icon"></tile-iconic>
				</tile>
			</router-link>
		</tile-group>
	</div>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
	computed : {
		...mapGetters(['moduls'])
	},
	methods : {
		check(info){
			if(info){
				infoMsg('Menu dalam pengembangan')
				this.$store.commit('SET_MY_WINDOW', {
					icon : 'fa fa-cube',
					caption : "dalam pengembangan",
					bg : 'bg-dark'
				})
			}
		}
	},
	created(){
		this.$store.commit("SET_BG_TILES")
	}
}
</script>