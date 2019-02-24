<template>
	<div :class="['row', SZ]">
		<slot></slot>
	</div>
</template>
<script>	
export default {
	props : ['size'],
	computed : {
		SZ(){
			return this.size === undefined ? '' : 'cells'+this.size
		}
	}
}
</script>