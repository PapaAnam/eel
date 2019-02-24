<template>
	<div class="form-group">
		<label for="name">Name</label>
		<select style="width: 100%;" :name="id+'[]'" :id="id" multiple class="form-control select2 multiple"></select>
		<span class="help-block"><strong></strong></span>
	</div>
</template>
<script>
export default {
	props : ['id'],
	mounted(){
		$(this.$el).find("select.multiple").select2({
			tags : true
		});
	}
}
</script>