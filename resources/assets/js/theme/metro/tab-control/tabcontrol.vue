<template>
	<div :class="[TS]" data-role="tabcontrol">
		<slot></slot>
	</div>
</template>
<script>
	export default {
		props : ['typeSecond'],
		computed : {
			TS(){
				return this.typeSecond === undefined ? 'tabcontrol' : 'tabcontrol2'
			}
		}
	}
</script>