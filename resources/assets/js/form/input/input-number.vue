<template>
	<div class="form-group">
		<label :for="id">{{ lbl }}</label>
		<input :min="min == undefined ? false : min" :readonly="readonly" class="form-control" v-on:focus="resErr('#'+id)" type="number" :name="id" :id="id" :value="value">
		<span class="help-block">
			<strong></strong>
		</span>
	</div>
</template>
<script>
export default {
	props : ['id', 'label', 'value', 'readonly','min'],
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
		// console.log(this.value)
	}
}
</script>