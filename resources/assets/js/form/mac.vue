<template>
	<div>
		<div class="mac">
			<mac-header :title="title" :icon="icons[module]"></mac-header>
			<div class="mac-content">
				<slot></slot>
			</div>
			<div class="mac-footer"></div>
		</div>
		<mac-preloader :icon="icons[module]" :bg="bgTiles[module]"></mac-preloader>
	</div>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
	props : ['title', 'module'],
	computed : {
		...mapGetters([
			'icons', 'bgTiles'
			])
	},
	mounted(){
		this.$store.dispatch('showView')
	}
}
</script>