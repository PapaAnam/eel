<template>
	<a data-role="hint" data-hint-color="fg-white" data-hint-mode="2" data-hint-position="bottom" :href="href ? href : '#'" :data-hint="txt" data-hint-background="bg-red" target="_blank"  class="button danger fg-white cycle-button">
		<span class="mif-file-pdf"></span>
	</a>
</template>
<script>
export default {
	props : ['text', 'href'],
	computed : {
		txt(){
			return this.text ? this.text : 'Print'
		}
	}
}
</script>