<template>
	<div class="menu-body"> 
		<div class="tile-area">
			<div class="single-tile-group"> 
				<tile size="large" :to="['catalog','cash_withdrawal']" :setting="$store.getters.modul.catalog"></tile>
				<tile :to="['maps','cash_withdrawal']" :setting="$store.getters.modul.maps"></tile>
				<tile :to="['customer-outlet','cash_withdrawal']" :setting="$store.getters.modul.customerOutlet"></tile>
			</div>
		</div>
	</div>
</template>
<script>
	import tile from './my-tile'
	export default {
		methods : {
			c(){
				comingSoon()
			},
			setBg(modul){
				let bg = $('[data-tile="'+modul+'"]').css('backgroundColor')
				setTimeout(()=>{
					$('.mac-header, .mac-footer').css({
						backgroundColor : bg,
					})
					$('.mac-content').css({
						borderColor : bg,
					})
				}, 1000)
			},
		},
		created() {
			this.$store.dispatch('setBgTiles')
		},
		mounted(){

		},
		components : {
			tile
		}
	}
</script>
<style>
.bunder {
	border-radius: 20px;
}
</style>