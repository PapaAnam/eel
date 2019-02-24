<template v-if="href">
	<a data-role="hint" data-hint-color="fg-white" data-hint-mode="2" data-hint-position="bottom" :href="href ? href : '#'" :data-hint="txt" data-hint-background="bg-steel" target="_blank"  class="button bg-steel fg-white cycle-button">
		<span class="mif-printer"></span>
	</a>
</template>
<template v-else>
	<b-button @click="print" size="sm"><i class="fa fa-print"></i>{{ this.noLabel == undefined ? 'Print' : '' }}</b-button>
</template>
<script>
	export default {
		props : ['text', 'href','link','noLabel'],
		computed : {
			txt(){
				return this.text ? this.text : 'Print'
			}
		},
		methods : {
			print(){
				if(this.link){
					window.open(this.link)
				}
			}
		},
		mounted(){
		}
	}
</script>