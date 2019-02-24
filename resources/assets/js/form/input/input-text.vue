<template>
	<div class="form-group">
		<label :for="id">{{ lbl }}</label>
		<input :readonly="readonly || readonly != undefined" class="form-control" v-on:focus="resErr('#'+id)" type="text" :name="id" :id="id" :value="value">
		<span class="help-block">
			<strong></strong>
		</span>
	</div>
</template>
<script>
export default {
	props : ['id', 'label', 'value', 'readonly'],
	methods : {
		resErr(selector){
			resetError(selector, this.$el)
			$(this.$el).find('input').removeClass('is-invalid')
		}
	},
	computed : {
		lbl(){
			return this.label ? this.label : _.capitalize(_.replace(this.id, '_', ' '))
		}
	}
}
</script>