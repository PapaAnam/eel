<template>
	<div class="form-group">
		<label :for="id"><strong>{{ label }}</strong></label>
		<select @change="updateVal($event.target.value)" :name="id" :id="id" class="form-control">
			<slot></slot>
		</select>
	</div>
</template>
<script>
export default {
	data(){
		return {
			
		}
	},
	props : ['label', 'id'],
	watch : {
		
	},
	computed : {

	},
	methods : {
		updateVal(val)
		{
			this.$emit('input', val)
		}
	},
	created(){

	},
	mounted(){

	}
}
</script>