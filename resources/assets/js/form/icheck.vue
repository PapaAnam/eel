<template>
	<div class="form-group">
		<label class="input-control checkbox">
			<input type="checkbox" :checked="checked" :id="id" :name="id" :value="value" class="minimal"> {{ lbl }}
		</label>
	</div>
</template>
<script>
export default {
	props : ['id', 'label', 'value', 'checked', 'delay'],
	methods : {
		resErr(selector){
			resetError(selector, this.$el)
		}
	},
	watch : {
		checked(val){
			// console.log(val)
			$(this.$el).find('input[type="checkbox"]').iCheck('toggle')
		}
	},
	computed : {
		lbl(){
			return this.label ? this.label : _.capitalize(_.replace(this.id, '_', ' '))
		}
	},
	mounted() {
		setTimeout(() => {
			$(this.$el).find('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
				checkboxClass: 'icheckbox_minimal-blue',
				radioClass: 'iradio_minimal-blue'
			});
		}, (this.delay ? this.delay : 0))
		// console.log(this.checked)
	}
}
</script>