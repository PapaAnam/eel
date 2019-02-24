<template>
	<dropdown data-role="select" :id="id" :label="label">
		<slot></slot>
	</dropdown>
</template>
<script>
export default {
	props : ['id', 'label'],
	mounted(){
	}
}
</script>