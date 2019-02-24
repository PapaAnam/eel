<template>
	<div>
		<div class="loader"></div>
		<div class="cc">
			<div class="back-home" @click="toHome">
				<span class="mif-arrow-left" style="margin-top: -13px;"></span>
			</div>
			<div class="logo-lisun animate2 animated fadeInDown">
				<div v-if="usingLogo" class="image-container" style="margin: 0 auto;">
					<div class="frame">
						<img :src="lisunImg">
					</div>
				</div>
				<h1 v-else class="nama-perusahaan">Nama Perusahaan Anda</h1>
			</div>
			<div :class="['login-form', 'padding20', 'block-shadow', 'animate4', 'animated fadeInUp', bg, 'bunder']">
				<form method="post" id="login-form">
					<h1 :class="['text-light align-center animate8 animated fadeIn', bg ? 'fg-black' : 'fg-white']">Login to service</h1>
					<hr :class="['thin animate10 animated rotateInDownLeft', hr]"/>
					<br />
					<div class="input-control text full-size animate10 animated fadeInLeft" data-role="input">
						<label for="username" :class="[bgColor]">Username:</label>
						<input required @keydown.enter.prevent="login" type="text" class="rounded bunder" name="username" id="username">
						<button class="button helper-button clear">
							<span :class="[bgColor, 'mif-cross']"></span>
						</button>
						<span class="help-block margin20 no-margin-left no-margin-right">
							<strong class="fg-red" id="errorTxt"></strong>
						</span>
					</div>
					<br />
					<br />
					<div class="input-control password full-size animate12 animated fadeInRight" data-role="input">
						<label for="password" :class="[bgColor]">Password:</label>
						<input required @keydown.enter.prevent="login" type="password" :class="[bgColor,'bunder']" name="password" id="password">
						<button class="button helper-button reveal">
							<span :class="[bgColor, 'mif-looks']"></span>
						</button>
						<span class="help-block"><strong></strong></span>
					</div>
					<br />
					<br />
					<div class="form-actions">
						<div class="animate16 animated bounce" >
							<button @click.prevent="login" type="submit" :class="[hr, 'bunder button full-size animate14 animated fadeIn']">Login</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	data() {
		return {
			lisunImg : false,
			lightColor : ['bg-white', 'bg-grayLighter', 'bg-lightOrange'],
			bg : this.set_background(this.color()),
			hr : this.set_background(this.color()),
			usingLogo : false,
		}
	},
	methods : {
		toHome(){
			window.location = base_url('/home')
		},
		set_background(color)
		{
			let fg = 'fg-white';
			if(color=='white' || color=='grayLighter')
				fg = 'fg-black';
			return 'bg-'+color+' '+fg;
		},
		color()
		{
			let colors = ['black', 'white', 'lime', 'green', 'emerald', 'teal', 'blue', 'cyan', 'cobalt', 'indigo', 'violet', 'pink', 'magenta', 'crimson', 'red', 'orange', 'amber', 'yellow', 'brown', 'olive', 'steel', 'mauve', 'taupe', 'gray', 'dark', 'darker', 'darkBrown', 'darkCrimson', 'darkMagenta', 'darkIndigo', 'darkCyan', 'darkCobalt', 'darkTeal', 'darkEmerald', 'darkGreen', 'darkOrange', 'darkRed', 'darkPink', 'darkViolet', 'darkBlue', 'lightBlue', 'lightRed', 'lightGreen', 'lighterBlue', 'lightTeal', 'lightOlive', 'lightOrange', 'lightPink', 'grayDark', 'grayDarker', 'grayLight', 'grayLighter'];
			return _.sample(colors);
		},
		isLight(color){
			return _.includes(this.lightColor, color)
		},
		login() {
			$('.cc').fadeOut('slow');
			$('.loader').html('<div data-role="preloader" data-type="ring"></div>').append('<h3 class="margin50 no-margin-left no-margin-right no-margin-bottom fg-white">Login</h3>');
			var login;
			setInterval(function(){
				login = $('.loader').find('h3');
				login.append('.');
				if(login.text()=='Login......')
					login.text('Login');
			}, 200);
			// console.log($('#login-form').serialize())
			// return
			axios.post('api/hris/login', $('#login-form').serialize()).then(res=>{
				window.location = base_url('/hris/home')
			}).catch(err=>{
				if(err.response.status == 500)
					$('#errorTxt').html("there is error in server")
				else
					$('#errorTxt').html(err.response.data.message)
				$('.cc').fadeIn('slow')
				$('.loader').empty()
			})
		}
	},
	computed : {
		bgColor() {
			return this.bg ? 'fg-black' : ''
		}
	},
	mounted() {
		this.lisunImg = $('[name="logo"]').attr('content')
		this.usingLogo = $('[name="logo"]').attr('content') != ''
		$(document).ready(function(){
			let form = $(".login-form");
			form.css({
				opacity: 1,
				"-webkit-transform": "scale(1)",
				"transform": "scale(1)",
			});
			setTimeout(function(){
				$('.image-container').addClass('rounded bordered handing ani');
			}, 4000);
		});
	}
}
</script>
<style scoped>
body{
	overflow: hidden;
}
@media screen and (min-width: 320px){
	.login-form {
		width: 270px;
		height: 260px;
		position: fixed;
		top: 30%;
		left: 50%;
		margin-left: -135px;
		opacity: 0;
		-webkit-transform: scale(.8);
		transform: scale(.8);
		-webkit-transition: .5s;
		transition: .5s;
	}
	h1{
		font-size: 22px;
	}
	.logo-lisun{
		top: 30%;
		left: 50%;
		position: fixed;
		width : 120px;
		height: 70px;
		margin-left: -60px;
		margin-top: -100px;
	}
	.back-home{
		position: fixed;
		top: 10px;
		left: 10px;
		font-size: 17px;
		border: 5px solid white;
		color: white;
		padding: 5px 2px;
		border-radius: 50%;
		width: 30px;
		height: 30px;
		cursor: pointer;
	}
}
@media screen and (min-width: 768px){
	.login-form {
		width: 25rem;
		height: 18.75rem;
		position: fixed;
		top: 55%;
		margin-top: -9.375rem;
		left: 50%;
		margin-left: -12.5rem;
		opacity: 0;
		-webkit-transform: scale(.8);
		transform: scale(.8);
		-webkit-transition: .5s;
		transition: .5s;
	}
	.logo-lisun{
		top: 30%;
		left: 50%;
		position: fixed;
		width : 200px;
		height: 100px;
		margin-left: -100px;
		margin-top: -100px;
	}
	.back-home{
		position: fixed;
		top: 10px;
		left: 10px;
		font-size: 30px;
		border: 5px solid white;
		color: white;
		padding: 5px 5px;
		border-radius: 50%;
		width: 50px;
		height: 50px;
		cursor: pointer;
	}
}
.loader{
	width: 100%;
	height: 100%;
	top: 40%;
	left: 50%;
	position: fixed;
	margin-left: -50px;
	margin-top: -50px;
}
@-moz-keyframes spin {
	from { -moz-transform: rotate(0deg); }
	to { -moz-transform: rotate(360deg); }
}
@-webkit-keyframes spin {
	from { -webkit-transform: rotate(0deg); }
	to { -webkit-transform: rotate(360deg); }
}
@keyframes spin {
	from {transform:rotate(0deg);}
	to {transform:rotate(360deg);}
}
.nama-perusahaan {
	width: 200%;
	color: white;
	margin-left: -50%;
	font-size: 30px;
	text-align: center;
}
.bunder {
    border-radius: 20px;
}
</style>