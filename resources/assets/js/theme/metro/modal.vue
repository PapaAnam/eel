<template>
	<div :data-width="width" data-role="dialog" :id="id" :data-close-button="closeBtn" :data-overlay="overlay" :data-overlay-color="overlay ? 'op-dark': ''" :data-overlay-click-close="overlay" :data-windows-style="windowsStyle">
		<slot></slot>
	</div>
</template>
<script>
export default {
	props : [
	'closeBtn', 'type', 'overlay', 'id', 'windowsStyle', 'width'
	]
}
</script>