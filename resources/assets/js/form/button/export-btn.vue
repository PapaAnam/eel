<template>
	<div class="mb-2 mt-2 btn-group">
		<!-- <a data-role="hint" data-hint-color="fg-white" data-hint-mode="2" data-hint-position="bottom" :href="printUrl" data-hint="Print" data-hint-background="bg-steel" target="_blank"  class="button bg-steel fg-white cycle-button">
			<span class="mif-printer"></span>
		</a>
		<a target="_blank" data-role="hint" data-hint-color="fg-white" data-hint-mode="2" data-hint-position="bottom" :href="pdfUrl" data-hint="PDF" data-hint-background="bg-red" class="button danger fg-white cycle-button">
			<span class="mif-file-pdf"></span>
		</a>
		<a target="_blank" data-role="hint" data-hint-color="fg-white" data-hint-mode="2" data-hint-position="bottom" :href="excelUrl" data-hint="Excel" data-hint-background="bg-green" class="button success fg-white cycle-button">
			<span class="mif-file-excel"></span>
		</a> -->
		<a target="_blank" :href="printUrl" class="fg-white btn btn-secondary btn-sm">
			<span class="mif-printer"></span> Print
		</a>
		<a target="_blank" :href="excelUrl" class="fg-white btn btn-success btn-sm">
			<span class="mif-file-excel"></span> Excel
		</a>
		<a target="_blank" :href="printUrl" class="fg-white btn btn-danger btn-sm">
			<span class="mif-file-pdf"></span> PDF
		</a>
	</div>
</template>
<script>
	export default {
		props : ['url'],
		computed : {
			printUrl(){
				return this.url+'/print'
			},
			pdfUrl(){
				return this.url+'/pdf'
			},
			excelUrl(){
				return this.url+'/excel'
			}
		}
	}
</script>