<template>
	<b-button @click="edit" size="sm" variant="primary" data-role="hint" data-hint-background="bg-primary" data-hint-color="fg-white" href="#" data-hint-mode="2" data-hint="Edit" data-hint-position="top">
		<span class="mif-pencil fg-white" style="font-size: 10px;"></span>
	</b-button>
</template>
<script>
	export default {
		methods : {
			edit(){
				this.$emit('edit')
			}
		},
		props : []
	}
</script>