<template>
	<li>
		<a :href="'#'+id">
			<slot></slot>
		</a>
	</li>
</template>
<script>
export default {
	props : ['id']
}
</script>