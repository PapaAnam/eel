<template>
	<form id="add-enter-form">
		<my-card title="Recalculation Salary">
			<b-row>
				<b-col md="6">
					<months-select v-model="month"></months-select>
				</b-col>
				<b-col md="6">
					<years-select v-model="year"></years-select>
				</b-col>
				<b-col lg="12">
					<b-progress v-if="" class="mb-2" :value="progress" :variant="getProgress()" show-progress></b-progress>
					<b-button size="sm" @click="processAll" :disabled="isProcessAll || disabledRecal" variant="primary">{{ isProcessAll ? 'Processing' : 'Process All Employee' }}</b-button>
					<span v-if="disabledRecal" class="badge badge-danger">
										Button disabled, you must fix salary rule issue first :)
									</span>
					<!-- <b-button size="sm" v-if="success" to="/payroll">Ok</b-button> -->
				</b-col>
			</b-row>
		</my-card>
	</form>
</template>
<script>
	import empSelect from './../employees/select'
	import { mapActions } from 'vuex'
	export default{
		data(){
			return {
				isProcessAll : false,
				errorMsg : false,
				month 	: String(new Date().getMonth()+1),
				year 	: String(new Date().getFullYear()),
				progress : 0,
				success : false,
			}
		},
		methods : {
			...mapActions([
				]),
			processAll()
			{
				this.$emit('showError', false)
				this.progress = Math.random() * 40
				// setTimeout(()=>{
				// 	this.progress = Math.random() * 60
				// }, 500)
				this.success = false
				if(!this.isProcessAll){
					if(this.month == ''){
						alert('please select month first')
						return
					}
					if(this.year == ''){
						alert('please select year first')
						return
					}
					this.errorMsg = false
					this.isProcessAll = true
					this.$emit('setMonth', this.month)
					this.$emit('setYear', this.year)
					myaxios.post('payroll/pay-all-employee', {
						month : this.month,
						year : this.year,
					}, {
						onUploadProgress(progressEvent){
							let percent = Math.floor((progressEvent.loaded * 100) / progressEvent.total)
							this.progress = percent
							// console.log(this.progress)
						}
					}).then(res=> {
						this.progress = 100
						successMsg(res.data)
						this.isProcessAll = false
						this.success = true
						this.$emit('filter')
					}).catch(err=>{
						this.progress = 100
						this.isProcessAll = false
						if(err.response.status === 422){
							this.errorMsg = err.response.data.msg
							if(err.response.data.employee){
								this.errorMsg += '<br>'
								for(let emp of err.response.data.employee){
									this.errorMsg += emp.nin+' '+emp.name+', '
								}
								this.$emit('showError', this.errorMsg)
								this.success = true
								this.$emit('filter')
							}
						}
					})
				}
			},
			getProgress(){
				if(this.progress <= 30)
					return 'danger' 
				else if(this.progress <= 50) 
					return 'warning'
				else
					return 'success'
			}
		},
		mounted(){
		},
		components : {
		},
		watch : {
		},
		props : {
			disabledRecal : {
				required : true,
				type : Boolean
			}
		}
	}
</script>