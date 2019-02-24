<template>
	<div :class="[size, BG, FG]" data-role="tile">
		<slot></slot>
		<span class="tile-label">{{ label }}</span>
	</div>
</template>
<script>
import colors from './colors'
export default {
	props : ['size', 'bg', 'fg', 'label'],
	computed : {
		BG(){
			return this.bg ? (this.bg.includes('bg-') ? this.bg : 'bg-'+this.bg) : colors.getBgRandom()
		},
		FG(){
			return this.fg ? this.fg : 'fg-white'
		},
		SZ(){
			return this.size ? 'tile-'+this.size : 'tile'
		}
	},
	created(){
		// console.log(this.size)
	}
}
</script>