<template>
	<div class="form-group">
		<label class="input-control radio">
			<input type="radio" :id="id" :value="value" :name="id" class="minimal check-menu"> {{ lbl }}
		</label>
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
	mounted() {
		$(this.$el).find('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass: 'iradio_minimal-blue'
		})
		$(this.$el).find('#'+this.id).on('ifChecked', (event) =>{
			this.$emit('check')
		})
		$(this.$el).find('#'+this.id).on('ifUnchecked', (event) =>{
			console.log(event)
			this.$emit('uncheck')
		})
	}
}
</script>