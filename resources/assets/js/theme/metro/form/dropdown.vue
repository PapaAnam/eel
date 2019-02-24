<template>
	<div class="input-control select full-size" :label="label">
		<label :for="id"><strong>{{ label }}</strong></label>
		<select :id="id" :name="id">
			<slot></slot>
		</select>
	</div>
</template>
<script>
export default {
	props : ['label', 'id']
}
</script>