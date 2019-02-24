<template>
	<a @click.prevent="savee($event)" id="save" :class="['fg-white btn btn-sm btn-primary', saving ? 'disabled' : '']">{{ saving ? 'Saving' : saveTxt }}</a>
</template>
<script>
export default {
	data(){
		return {
			saveTxt	: 'Save'
		}
	},
	props : ['text', 'saving'],
	computed : {
		
	},
	methods : {
		savee(event)
		{
			event.preventDefault()
			this.$emit('simpan')
			this.$emit('save')
		}
	},
	created(){
		this.saveTxt = this.text ? this.text : 'Save'
	}
}
</script>
<style>
.simpan-btn {
	border-radius: 0 !important;
}
.simpan-btn:hover {
	color: white !important;
}
</style>