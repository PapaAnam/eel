<template>
	<div class="tile-content iconic">
		<span :class="['icon', icon]"></span>
	</div>
</template>
<script>
export default {
	props : ['icon'],
}
</script>