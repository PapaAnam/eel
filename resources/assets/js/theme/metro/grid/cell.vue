<template>
	<div :class="['cell', SPAN]">
		<slot></slot>
	</div>
</template>
<script>
export default {
	props : ['span'],
	computed : {
		SPAN(){
			return this.span ? 'colspan'+this.span : ''
		}
	}
}
</script>