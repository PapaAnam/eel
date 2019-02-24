<template>
	<div class="frame" :id="id" :data-on-tab-click="click">
		<slot></slot>
	</div>
</template>
<script>
export default {
	props : ['id', 'click']
}
</script>