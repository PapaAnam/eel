<template>
	<div class="menu-body"> 
		<div class="tile-area">
			<div class="single-tile-group"> 
				<router-link to="/pelanggan" @click.native.prevent="showLoader">
					<div class="tile-large fg-white" data-title="Pelanggan" data-role="tile" data-datatable="" data-url="">
						<div class="tile-content iconic">
							<i class="icon fa fa-users mif-ani-flash mif-ani-slow" data-icon="fa fa-users"></i>
						</div>
						<span class="tile-label">Pelanggan</span>
					</div>
				</router-link>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	methods : {
		showLoader(){
			$('.preloader').fadeIn()
		}
	},
	mounted(){
		setTileBg()
		metro_init()
		$('body').css('overflowY', 'hidden')
	}
}
</script>