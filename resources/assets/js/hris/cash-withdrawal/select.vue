<template>
	<my-select id="salary_group" label="Salary Group">
		<option v-for="e in salaryGroups" :value="e.id">{{ e.name }}</option>
	</my-select>
</template>
<script>
	export default {
		data(){
			return {
				salaryGroups : [],
			}
		},
		props : ['value'],
		created(){
			myaxios('salary-group').then(res=>{
				this.salaryGroups = res.data
			}).catch(err=>{
				handleError(err)
			})
		},
		watch : {
			value(v){
				console.log(v)
				setTimeout(()=>{
					$('#salary_group').val(v)
				}, 1000)
			}
		},
		mounted(){
			setTimeout(()=>{
				$('select#'+this.ID).on('change', ()=>{
					this.$emit('change', $('select#'+this.ID).val())
					this.$emit('input', $('select#'+this.ID).val())
					$('#salary_group').val(this.value)
				})	
			}, 1000)
		}
	}
</script>