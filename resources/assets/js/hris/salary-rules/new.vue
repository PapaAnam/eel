<template>
	<my-card title="New">
		<form id="add-form" role="form" method="post">
			<div class="row">
				<input type="hidden" name="tipe" value="2">
				<div class="col-md-4">
					<input-text readonly id="name" :value="sr ? sr.emp.name : employee"></input-text>
				</div>
				<div class="col-md-4">
					<input-number :value="sr.incentive ? sr.incentive : 0" id="incentive" label="Incentive"></input-number>
				</div>
				<div class="col-md-4">
					<input-number :value="sr.eat_cost ? sr.eat_cost : 0" id="eat_cost" label="Food Allowance"></input-number>
				</div>
				<div class="col-md-4">
					<input-number :value="sr.etc ? sr.etc : 0" id="etc"></input-number>
				</div>
				<div class="col-md-4">
					<input-number :value="sr.thr ? sr.thr : 0" id="thr"></input-number>
				</div>
				<div class="col-md-4">
					<input-number :value="sr.ritation ? sr.ritation : 0" id="ritation" label="Retention"></input-number>
				</div>
				<div class="col-md-4">
					<input-number :value="sr.rent_motorcycle ? sr.rent_motorcycle : 0" id="rent_motorcycle"></input-number>
				</div>
				<div class="col-md-4" v-if="segurancaManual">
					<input-number :value="sr.seguranca ? sr.seguranca : 0" id="seguranca" label="Seguranca Social"></input-number>
				</div>
				<div class="col-md-4">
					<input-number :value="sr.cash_receipt ? sr.cash_receipt : 0" id="cash_receipt" label="Cash Witdrawal"></input-number>
				</div>
				<div class="col-md-12">
					<simpan-btn @click.native.prevent="simpan" :saving="saving"></simpan-btn>
				</div>
			</div>
		</form>
	</my-card>
</template>

<script>
	import { mapActions, mapGetters } from 'vuex'
	export default{
		data(){
			return {
				saving : false,
				sr : {
					emp : {
						name : '',
						id : '',
					}
				},
				employee : ''
			}
		},
		methods : {
			...mapActions([
				'saveSalaryRule'
				]),
			simpan(){
				if(!this.saving){
					this.saving = true
					myaxios.post('salary-rules?employee='+$('#employee').val()+'&user_id='+this.$store.getters.activeUser.id, $('#add-form').serialize()).then(res=>{
						this.saving = false
						this.$emit('refresh')
						successMsg(res.data)
					}).catch(err=>{
						this.saving = false
						handleError(err)
					})
				}
			}
		},
		created(){
			myaxios('employees/'+$('#employee').val()).then(res=>{
				this.employee = res.data.name
			}).catch(err=>{
				handleError(err)
			})
			myaxios('salary-rules?employee='+$('#employee').val()).then(res=>{
				this.sr = res.data
			}).catch(err=>{
				handleError(err)
			})
		},
		computed : {
			...mapGetters([
				'salaryRules'
				])
		},
		props : [
		'segurancaManual'
		]
	}
</script>