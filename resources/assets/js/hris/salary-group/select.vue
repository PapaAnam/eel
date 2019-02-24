<template>
	<my-select id="salary_group" label="Salary Group">
		<option v-if="appends" :value="appends['value']">{{ appends['text'] }}</option>
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
		props : ['value','appends'],
		created(){
			myaxios('salary-group').then(res=>{
				this.salaryGroups = res.data
			}).catch(err=>{
				handleError(err)
			})
		},
		watch : {
			value(v){
				setTimeout(()=>{
					$(this.$el).find('#salary_group').val(v)
				}, 1000)
			}
		},
		mounted(){
			setTimeout(()=>{
				$(this.$el).find('#salary_group').on('change', ()=>{
					this.$emit('change', $(this.$el).find('#salary_group').val())
					this.$emit('input', $(this.$el).find('#salary_group').val())
					$(this.$el).find('#salary_group').val(this.value)
				})	
			}, 1000)
		}
	}
</script>