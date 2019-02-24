<template>
	<li :class="[active ? 'active' : '']">
		<slot></slot>
	</li>
</template>
<script>
export default {
	props : ['active']
}
</script>