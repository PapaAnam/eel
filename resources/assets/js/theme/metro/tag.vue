<template>
	<span :class="['tag', type]">
		<slot></slot>
	</span>
</template>
<script>
export default {
	props : ['type'],
}
</script>