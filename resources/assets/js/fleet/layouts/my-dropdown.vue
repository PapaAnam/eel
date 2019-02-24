<template>
	<dropdown :id="id" :label="label">
		<option v-for="(value, key) in data" :value="key">{{ value }}</option>
	</dropdown>
</template>
<script>
export default {
	props : ['id', 'label', 'data']
}
</script>