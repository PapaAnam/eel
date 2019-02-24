<template>
	<div class="form-group">
		<label :for="id">{{ label }}</label>
		<input @keyup="setVal" :value="newValue" :id="id" type="text" class="form-control date-mask" :name="id">
		<span class="invalid-feedback"></span>
	</div>
</template>
<script>
export default {
	data(){
		return {
			newValue : null
		}
	},
	props : ['id', 'label', 'value'],
	watch : {
		value(value){
			this.newValue = value
			$(this.$el).find('input').inputmask('hh:mm:ss')
		},
		// newValue(val){
		// 	this.$emit('input', val)
		// }
	},
	computed : {

	},
	methods : {
		onEnter(){
			this.$emit('input', $(this.$el).find('input').val())
			// console.log($(this.$el).find('input').val())
			this.$emit('onEnter', $(this.$el).find('input').val())
		},
		setVal(){
			this.$emit('input', $(this.$el).find('input').val())
		}
	},
	created(){
		this.newValue = this.value
	},
	mounted(){
		$(this.$el).find('input').inputmask('hh:mm:ss')
	}
}
</script>