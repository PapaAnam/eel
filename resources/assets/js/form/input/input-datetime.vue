<template>
	<div class="form-group">
		<label :for="id">{{ lbl }}</label>
		<input v-on:focus="resErr('#'+id)" type="text" class="form-control date-mask" :name="id" :id="id" :value="value">
		<span class="help-block"><strong></strong></span>
	</div>
</template>
<script>
export default {
	props : ['id', 'label', 'value'],
	methods : {
		resErr(selector){
			resetError(selector, this.$el)
		}
	},
	computed : {
		lbl(){
			return this.label ? this.label : _.capitalize(_.replace(this.id, '_', ' '))
		}
	},
	mounted(){
		$(this.$el).find('.date-mask').inputmask("datetime");
	}
}
</script>