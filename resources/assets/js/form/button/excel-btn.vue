<template>
	<a data-role="hint" data-hint-color="fg-white" data-hint-mode="2" data-hint-position="bottom" :href="href ? href : '#'" :data-hint="txt" data-hint-background="bg-green" target="_blank"  class="button success fg-white cycle-button">
		<span class="mif-file-excel"></span>
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