<template>
	<div>
		<label for="status">Status</label>
		<b-form-select v-model="status" id="status" name="status" :options="absenceStatus"></b-form-select>
		<span class="invalid-feedback"></span>
	</div>
</template>
<script>
export default {
	data(){
		return {
			absenceStatus : [
			{ value : 'Present', text : 'Present' }, 
			{ value : 'Sick', text : 'Sick' }, 
			{ value : 'Absent', text : 'Absent' }, 
			{ value : 'Official Travel', text : 'Official Travel' }, 
			{ value : 'Father Leave', text : 'Father Leave' }, 
			{ value : 'Holiday', text : 'Holiday' }, 
			{ value : 'Special Permit', text : 'Special Permit' }, 
			{ value : 'Pregnancy', text : 'Pregnancy' }
			],	
		}
	},
	props : ['status'],
	watch : {
		
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