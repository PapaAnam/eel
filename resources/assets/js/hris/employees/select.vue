<template>
	<div>
		<select2 :id="ID" :label="label">
			<option :selected="selected" v-for="e in employees" :value="e.id">{{ e.nin + ' - ' + e.name }}</option>
		</select2>
		<a v-if="employees.length == 0" @click.prevent="load" class="btn btn-primary btn-sm text-white">Load Again employee</a>
	</div>
</template>
<script>
	export default {
		data(){
			return {
				ID : '',
				LABEL : "",
				employees : [],
				loading : false,
			}
		},
		props : ['id', 'label', 'selected', 'value'],
		created(){
			this.load()
		},
		methods : {
			load(){
				if(!this.loading){
					this.loading = true
					myaxios('employees/select-mode').then(res=>{
						this.loading = false
						this.employees = res.data
					}).catch(err=>{
						this.loading = false
						errorMsg(err.response.data.message)
					})
				}
			}
		},
		watch: {
			value(val){
				setTimeout(()=>{
					$('select#'+this.ID).val(val).trigger('change')
				},2000)
			}
		},
		mounted(){
			if(this.id){
				this.ID = this.id
			}else{
				this.ID = 'employee'
			}
			if(this.label){
				this.LABEL = this.label
			}else{
				this.LABEL = 'Choose Employee'
			}
			setTimeout(()=>{
				$('select#'+this.ID).on('change', ()=>{
					this.$emit('change', $('select#'+this.ID).val())
					this.$emit('input', $('select#'+this.ID).val())
				})	
			}, 1000)

		}
	}
</script>