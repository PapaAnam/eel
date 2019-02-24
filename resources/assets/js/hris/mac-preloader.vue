<template>
	<div :class="['mac-preloader', bg]" style="display: block;">
		<div class="mac-module-icon">
			<i :class="[icon]"></i>
		</div>
		<div class="mac-loader" style="display: block;">
			<div data-role="preloader" data-type="ring"></div>
		</div>
	</div>
</template>
<script>
export default {
	props : ['icon', 'bg'],
	mounted(){
	}
}
</script>