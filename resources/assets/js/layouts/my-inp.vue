<template>
	<b-form-group :label="label">
		<b-form-input :readonly="readonly" :id="id" :name="id" v-model="newVal"></b-form-input>
		<b-form-invalid-feedback :id="id"></b-form-invalid-feedback>
	</b-form-group>
</template>
<script>
export default {
	data(){
		return {
			newVal : ''
		}
	},
	props : ['id', 'label', 'value', 'readonly'],
	watch : {
		newVal(val){
			this.$emit('input', val)
		},
		value(val){
			this.newVal = val
		}
	},
	computed : {

	},
	methods : {

	},
	created(){

	},
	mounted(){
		
	}
}
</script>