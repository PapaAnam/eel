<template>
	<a @click.prevent="hapus" data-role="hint" data-hint-background="bg-warning" data-hint-color="fg-white" data-hint-mode="2" data-hint="Delete" data-hint-position="top" class="fg-white btn btn-warning btn-sm">
		<span class="mif-bin" style="font-size: 10px;"></span>
	</a>
</template>
<script>
	export default {
		methods : {
			hapus(){
				this.$emit('hapus')
			}
		}
	}
</script>