<template>
	<div class="form-group">
		<label :for="unik">{{ lbl }}</label>
		<input class="form-control" v-on:focus="resErr('#'+unik)" type="password" :name="unik" :id="unik">
		<span class="help-block">
			<strong></strong>
		</span>
	</div>
</template>
<script>
export default {
	props : ['id', 'label'],
	methods : {
		resErr(selector){
			resetError(selector, this.$el)
		}
	},
	computed : {
		lbl(){
			return this.label ? this.label : _.capitalize(_.replace(this.id ? this.id : 'password', '_', ' '))
		},
		unik(){
			return this.id ? this.id : 'password'
		}
	}
}
</script>