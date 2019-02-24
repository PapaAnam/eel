<template>
	<div :class="['window', type]">
		<slot></slot>
	</div>
</template>
<script>
export default {
	props : ['type']
}
</script>