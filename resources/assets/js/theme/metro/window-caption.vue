<template>
	<div :class="['window-caption', bg, 'fg-white']">
		<span class="window-caption-icon"><span :class="icon"></span></span>
		<span class="window-caption-title">{{ caption }}</span>
		<slot></slot>
	</div>
</template>
<script>
export default {
	props : ['icon', 'caption', 'bg']
}
</script>