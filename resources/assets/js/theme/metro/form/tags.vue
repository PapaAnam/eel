<template>
	<div class="input-control text full-size">
		<label :for="id"><strong>{{ lbl }}</strong></label>
		<select :name="id+'[]'" :id="id"  class="full-size" multiple>
			<slot></slot>
		</select>
		<span class="help-block fg-red"></span>
	</div>
</template>
<script>
export default {
	props : ['id', 'label'],
	mounted(){
		$(this.$el).find("select").select2({
			tags : true
		});
	},
	computed : {
		lbl(){
			return this.label ? this.label : _.capitalize(_.replace(this.id, '_', ' '))
		}
	}
}
</script>
<style scoped>
.w-100 {
	width: 100% !important;
}
.select2-container--default .select2-selection--multiple {
    background-color: white;
    border: 1px solid #aaa;
    border-radius: 0;
    cursor: text;
}
</style>