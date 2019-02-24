<template>
	<my-card title="New" variant="danger">
		<form id="add-form" role="form" method="post">
			<div class="row">
				<input type="hidden" name="tipe" value="1">
				<div class="col-md-4">
					<input-text readonly id="name" :value="sr ? sr.emp.name : employee"></input-text>
				</div>
				<div class="col-md-4">
					<my-select id="out_at_rule" label="Out At Rule">
						<option value="17:00:00" :selected="sr ? sr.out_at_rule == '17:00:00' : false">17:00:00</option>
						<option value="17:30:00" :selected="sr ? sr.out_at_rule == '17:30:00' : false">17:30:00</option>
						<option value="18:00:00" :selected="sr ? sr.out_at_rule == '18:00:00' : false">18:00:00</option>
						<option value="18:30:00" :selected="sr ? sr.out_at_rule == '18:30:00' : false">18:30:00</option>
						<option value="19:00:00" :selected="sr ? sr.out_at_rule == '19:00:00' : false">19:00:00</option>
						<option value="19:30:00" :selected="sr ? sr.out_at_rule == '19:30:00' : false">19:30:00</option>
						<option value="20:00:00" :selected="sr ? sr.out_at_rule == '20:00:00' : false">20:00:00</option>
						<option value="20:30:00" :selected="sr ? sr.out_at_rule == '20:30:00' : false">20:30:00</option>
						<option value="21:00:00" :selected="sr ? sr.out_at_rule == '21:00:00' : false">21:00:00</option>
						<option value="21:30:00" :selected="sr ? sr.out_at_rule == '21:30:00' : false">21:30:00</option>
						<option value="22:00:00" :selected="sr ? sr.out_at_rule == '22:00:00' : false">22:00:00</option>
						<option value="22:30:00" :selected="sr ? sr.out_at_rule == '22:30:00' : false">22:30:00</option>
						<option value="23:00:00" :selected="sr ? sr.out_at_rule == '23:00:00' : false">23:00:00</option>
						<option value="23:30:00" :selected="sr ? sr.out_at_rule == '23:30:00' : false">23:30:00</option>
						<option value="23:59:00" :selected="sr ? sr.out_at_rule == '23:59:00' : false">23:59:00</option>
					</my-select>
				</div>
				<b-col sm="4">
					<select2 id="salary_type" label="Salary Type">
						<option value="daily" :selected="sr ? sr.salary_type == 'daily' : false">Daily</option>
						<option value="standart" :selected="sr ? sr.salary_type == 'standart' : false">Standart</option>
					</select2>
				</b-col>
				<b-col sm="4">
					<salary-group v-model="sr.salary_group_id"></salary-group>
				</b-col>
				<div class="col-md-4">
					<input-number :value="sr ? sr.basic_salary : 0" id="basic_salary"></input-number>
				</div>
				<div class="col-md-4">
					<input-number :value="sr ? sr.allowance : 0" id="allowance"></input-number>
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
	import salaryGroup from './../salary-group/select'
	export default {
		data(){
			return {
				sr : {
					emp : {
						name : '',
						id : '',
					}
				},
				saving : false,
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
		computed : {
			...mapGetters([
				'salaryRules'
				])
		},
		watch : {
			sr(val){
				$('#salary_type').val(val.salary_type).select2()
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
				setTimeout(()=>{
					$('#out_at_rule').val(this.sr.out_at_rule)
				},p1000)
			}).catch(err=>{
				handleError(err)
			})
		},
		mounted(){
			$('#salary_type').val(this.sr.salary_type).select2()
		},
		components : {
			salaryGroup
		},
	}
</script>