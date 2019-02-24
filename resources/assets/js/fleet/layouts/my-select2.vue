<template>
	<select2 :id="id" :label="label">
		<option v-for="(value, key) in data" :value="key">{{ value }}</option>
	</select2>
</template>
<script>
export default {
	props : ['id', 'label', 'data']
}
</script>