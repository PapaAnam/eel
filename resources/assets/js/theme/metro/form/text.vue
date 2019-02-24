<template>
	<div class="input-control textarea full-size" data-role="input" data-text-auto-resize="true">
		<label :for="id"><strong>{{ label }}</strong></label>
		<textarea :id="id" :name="id">{{ value }}</textarea>
		<span class="help-block fg-red"></span>
	</div>
</template>
<script>
export default {
	props : ['id', 'value', 'label'],
	data(){
		return {
			inputVal : this.value || '',
		}
	},
	watch : {
		inputVal(newVal){
			this.$emit('input', newVal)
		}
	}
}
</script>