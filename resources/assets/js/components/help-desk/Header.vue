<template>
	<div class="menu-header">
		<skin></skin>
		<div class="menu-title">
			<h1>Help Desk</h1>
		</div>
		<div class="menu-setting">
			<div class="setting"> 
				<div class="image-container image-format-hd">
					<div class="frame">
						<div style="max-width: 50px; max-height: 50px;" class="usr">
							<!-- <img onclick="profile()" src="@if(Auth::user()->avatar){{ asset('storage/'.Auth::user()->avatar) }}@else{{ asset('images/avatars/default.png') }}@endif" style="border-radius: 50%; cursor: pointer;"> -->
						</div>
					</div>
				</div>
				<div class="split-button">
					<!-- <button onclick="profile()" class="button rounded bg-steel no-border fg-white" style="max-width: 250px;">{{ Auth::user()->username }}</button> -->
					<ul class="split-content d-menu" data-role="dropdown">
						<li><a href="#">Reply</a></li>
						<li><a href="#">Reply All</a></li>
						<li><a href="#">Forward</a></li>
					</ul>
				</div>
				<button class="cycle-button bg-steel fg-white no-border" onclick="showCharms('#charmSettings')">
					<span data-role="hint" data-hint-background="bg-steel" data-hint-color="fg-white" data-hint-mode="2" data-hint="Skins" data-hint-position="bottom" class="mif-palette"></span>
				</button>
				<button class="cycle-button bg-steel fg-white no-border" onclick="announcement()">
					<span data-role="hint" data-hint-background="bg-steel" data-hint-color="fg-white" data-hint-mode="2" data-hint="Announcement" data-hint-position="bottom" class="mif-bell"></span>
				</button>
				<button class="cycle-button bg-steel fg-white no-border" @click="keluar">
					<i data-role="hint" data-hint-background="bg-steel" data-hint-color="fg-white" data-hint-mode="2" data-hint="Sign Out" data-hint-position="bottom" class="fa fa-sign-out"></i>
				</button>
			</div>
		</div>
	</div>
</template>
<script type="text/javascript">
export default { 
	methods : {
		keluar(){
			window.location = base_url('/')
		}
	}
}
</script>