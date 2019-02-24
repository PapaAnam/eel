<template>
	<button :class="['btn', TYPE, SIZE]" :disabled="disabled" :data-toggle="TOOLTIP" :data-title="tooltip">
		<slot></slot>
	</button>
</template>
<script>
export default {
	props : ['type', 'size', 'default', 'disabled', 'tooltip'],
	computed : {
		TYPE(){
			return this.type === undefined ? (this.default !== undefined ? 'btn-secondary' : 'btn-primary') : 'btn-'+this.type
		},
		SIZE(){
			return this.size === undefined ? '' : 'btn-'+this.size
		},
		TOOLTIP(){
			return this.tooltip ? 'tooltip' : ''
		}
	},
	mounted(){

	}
}
</script>