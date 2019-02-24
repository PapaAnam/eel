<template>
	<div>
		<label for="status">Status</label>
		<b-form-select v-model="selected" id="status" name="status" :options="absenceStatus"></b-form-select>
		<span class="invalid-feedback"></span>
	</div>
</template>
<script>
export default {
	data(){
		return {
			absenceStatus : [
			{ value : '', text : '' }, 
			{ value : 'Present', text : 'Present' }, 
			{ value : 'Sick', text : 'Sick' }, 
			{ value : 'Absent', text : 'Absence' }, 
			{ value : 'Official Travel', text : 'Official Travel' }, 
			{ value : 'Father Leave', text : 'Father Leave' }, 
			{ value : 'Annual Leave', text : 'Annual Leave' }, 
			{ value : 'Special Permit', text : 'Special Permit' }, 
			{ value : 'Pregnancy', text : 'Pregnacy Leave' }
			],	
			selected : null
		}
	},
	props : ['status','value'],
	watch : {
		status(val){
			this.selected = val
		},
		selected(val){
			this.$emit('input', val)
		}
	},
	computed : {
		
	},
	methods : {

	},
	created(){
		this.selected = this.value
	},
	mounted(){
		
	}
}
</script>