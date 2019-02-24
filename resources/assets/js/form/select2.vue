<template>
	<div class="form-group">
		<label for="name" class="text-capitalize">{{ lbl }}</label>
		<select :name="id" :id="id" style="width: 100%;" class="form-control select2">
			<slot></slot>
		</select>
		<span class="help-block"><strong></strong></span>
	</div>
</template>
<script>
export default {
	props : ['id', 'label'],
	mounted(){
		$(this.$el).find('.select2').select2()
	},
	computed : {
		lbl(){
			return this.label ? this.label : _.capitalize(_.replace(this.id, '_', ' '))
		}
	},
}
</script>