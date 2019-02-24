<template>
	<div data-role="charm" id="charmSkins" data-position="top">
		<h1 class="text-light">Skins</h1>
		<hr class="thin"/>
		<br />
		<div class="schemeButtons">
			<div v-for="color in colors" :class="'button square-button tile-area-scheme-'+color" :data-scheme="color" @click="changeBg('bg-'+color)"></div>
		</div>
	</div>
</template>

<script>
export default{
	data(){
		return {
			colors : ['dark', 'darkBrown', 'darkCrimson', 'darkViolet', 'darkMagenta', 'darkCyan', 'darkCobalt', 'darkTeal', 'darkEmerald', 'darkGreen', 'darkOrange', 'darkRed', 'darkPink', 'darkIndigo', 'darkBlue', 'lightBlue', 'lightTeal', 'lightOlive', 'lightOrange', 'lightPink', 'grayed'],
			cbg : localStorage.getItem('bg') || 'bg-blue'
		}
	},
	methods : {
		onHover(){
			let v = this
			$(".schemeButtons .button").hover(function(){
				$("body").attr('class', '').addClass("bg-" +  $(this).data('scheme'))
			}, function(){
				$("body").attr('class', '').addClass(v.cbg);
			});
		},
		changeBg(color){
			$('body').attr('class', '').addClass(color);
			localStorage.setItem('bg', color);
			this.cbg = color;
		}
	},
	mounted(){
		let v = this
		$('body').addClass(v.cbg);
		v.onHover()
		v.changeBg(v.cbg)
	}
}
</script>