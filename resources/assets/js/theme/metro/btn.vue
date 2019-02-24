<template>
	<button data-hint-color="fg-white" data-hint-position="top" :data-role="hint ? 'hint' : false" :data-hint="hint" :data-hint-background="HINT_COLOR" :class="['button', TYPE, SIZE]" :disabled="disabled">
		<slot></slot>
	</button>
</template>
<script>
export default {
	props : ['type', 'size', 'default', 'disabled', 'hint'],
	computed : {
		TYPE(){
			return this.type === undefined ? (this.default !== undefined ? '' : 'primary') : this.type
		},
		SIZE(){
			return this.size === undefined ? '' : this.size+'-button'
		},
		HINT_COLOR(){
			if(this.TYPE == 'primary')
				return 'bg-blue'
			if(this.TYPE == 'alert' || this.TYPE == 'danger')
				return 'bg-red'
			if(this.TYPE == 'success')
				return 'bg-green'
			if(this.TYPE == 'warning')
				return 'bg-orange'
		}
	},
	mounted(){

	}
}
</script>