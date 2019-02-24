<template>
	<div :class="['tile-area', BG, 'fg-white']" style="height: 100%; max-height: 100% !important;">
		<slot></slot>
	</div>
</template>
<script>
import colors from './colors'
export default {
	props : ['bg'],
	computed : {
		BG(){
			return this.bg === undefined ? colors.getRandomScheme() : 'tile-area-scheme-'+this.bg
		}
	}
}
</script>