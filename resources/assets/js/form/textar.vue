<template>
	<div class="form-group">
		<label :for="id" class="text-capitalize">{{ label ? label : id.replace('_', ' ') }}</label>
		<textarea class="form-control" v-on:focus="resErr('#'+id)" :name="id" :id="id">{{ value }}</textarea>
		<span class="invalid-feedback">
		</span>
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
		mounted(){
			// console.log(this)
		}
	}
</script>