<template>
	<div id="my-window">
		<window style="overflow: auto;">
			<window-caption :bg="myWindow.bg" :caption="myWindow.caption" :icon="myWindow.icon">
				<router-link to="/">
					<span class="btn-close"></span>
				</router-link>
			</window-caption>
			<window-content>
				<my-content>
					<router-view></router-view>
				</my-content>
			</window-content>
		</window>
	</div>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
	props : ['caption', 'icon'],
	mounted() {
		let h = $(this.$el).height()
		let w = $(this.$el).width()
		let h2 = $(this.$el).find('.window-caption').height()
		$(this.$el).find('.window').height(h-h2).css({
			maxWidth : w+'px'
		})
	},
	computed : {
		...mapGetters([
			'myWindow'
			])
	}
}
</script>
<style scoped>
#my-window {
	position: fixed;
	top: 0;
	left: 0;
	z-index: 999;
	width: 100%;
	height: 100%;
	display: none;
}
</style>