<template>
	<div class="row">
		<b-col sm="3">
			<employees-select v-model="employee_id"></employees-select>
		</b-col>
		<b-col sm="3">
			<years-select v-model="year" with-next />
		</b-col>
		<b-col sm="4">
			<btn-primary class="mt" @click.prevent.native="get" :disabled="searching" :text="searching ? 'Searching' : 'View'"></btn-primary>
			<b-button class="mt" @click="hide" variant="secondary" size="sm">Hide</b-button>
		</b-col>
		<div id="edit-rule" class="col-md-12" v-if="editing">
			<div class="card mb-2">
				<div class="card-header bg-primary text-white">
					Edit Rule
				</div>
				<div class="card-body">
					<form id="edit-rule-form" action="" @submit.prevent="simpanRule">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="status">Status</label>
									<input id="status" readonly="readonly" type="text" class="form-control" v-model="rule.status">
									<span class="invalid-feedback"></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="max">Max</label>
									<input min="0" id="max" type="number" class="form-control" v-model="rule.max">
									<span class="invalid-feedback"></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="used">Used</label>
									<input min="0" id="used" type="number" class="form-control" v-model="rule.used">
									<span class="invalid-feedback"></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="used">Year</label>
									<input id="year" readonly="readonly" type="number" class="form-control" v-model="rule.year">
									<span class="invalid-feedback"></span>
								</div>
							</div>
							<div class="col-md-12">
								<button :disabled="menyimpan" title="Save" type="submit" class="btn btn-primary btn-sm">
									{{ menyimpan ? 'Saving' : 'Save' }}
								</button>
								<button @click="cancelEdit" title="Cancel" type="button" class="btn btn-secondary btn-sm">
									Cancel
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<table class="table table-striped table-bordered">
				<tbody>
					<tr>
						<td><strong>Name</strong></td>
						<td>{{employee.name}}</td>
						<td><strong>Gender</strong></td>
						<td>{{employee.gender}}</td>
					</tr>
					<tr>
						<td><strong>Joining Date</strong></td>
						<td>{{employee.joining_date}}</td>
						<td><strong>Length of work</strong></td>
						<td>{{employee.length_of_work}}</td>
					</tr>
					<tr>
						<td><strong>Marital Status</strong></td>
						<td>{{employee.marry}}</td>
						<td><strong>From</strong></td>
						<td>{{employee.e_from}}</td>
					</tr>
				</tbody>
			</table>
			<my-card id="data-rule" title="Left of Leave Period Data" class="mt-2">
				<my-dt :data="leavePeriods">
					<thead>
						<tr>
							<th>ID</th>
							<th>Employee</th>
							<th>Status</th>
							<th>Max</th>
							<th>Used</th>
							<th>Left</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(s, index) in leavePeriods">
							<td>{{ s.id }}</td>
							<td>{{ s.employee }}</td>
							<td v-html="s.status_name"></td>
							<td>{{ s.max }}</td>
							<td>{{ s.used }}</td>
							<td>{{ s.leftovers }}</td>
							<td>
								<button @click="edit(year, employee_id, s.id)" title="Edit" type="button" class="btn btn-primary btn-sm">
									<i class="fa fa-pencil"></i>
								</button>
							</td>
						</tr>
					</tbody>
				</my-dt>
			</my-card>
		</div>
	</div>
</template>

<script>
	import { mapActions, mapGetters } from 'vuex'
	export default{
		data(){
			return {
				leavePeriods : [],
				searching : false,
				year : (new Date()).getFullYear(),
				employee_id : null,
				employee : {},
				rule : {
					status : null,
					max : 0,
					used : 0,
					year : null,
				},
				editing : false,
				menyimpan : false,
			}
		},
		props : [],
		methods : {
			simpan(){
				if(!this.saving){
					resetAllError()
					this.saving = true
					let data = new FormData(document.getElementById('add-form'))
					data.append('_method', 'PUT')
					myaxios.post('leave-period', data).then(res=>{
						this.saving = false
						this.get()
						successMsg(res.data)
					}).catch(err=>{
						this.saving = false
						handleError(err, '#add-form')
					})
				}
			},
			get(){
				if(this.employee_id == null || this.employee_id == 'null')
					alert('employee must be selected')
				else{
					this.getEmployee()
					this.searching = true
					myaxios('leave-period/left?year='+this.year+'&employee_id='+this.employee_id).then(res=>{
						this.searching = false
						this.leavePeriods = res.data
						macScrollTo('#data-rule', 200)
					}).catch(err=>{
						this.searching = false
						handleError(err)
					})	
				}
			},
			edit(year, employee_id, status_id){
				this.editing = true
				myaxios('leave-period/left?employee_id='+employee_id+'&year='+year+'&status_id='+status_id).then(res=>{
					this.rule.status 	= res.data.status_name
					this.rule.max 		= res.data.max
					this.rule.used 		= res.data.used
					this.rule.year 		= this.year
					this.rule.employee_id = employee_id
					this.rule.status_id = status_id
					window.macScrollTo('#edit-rule', 100)
				}).catch(err=>{
					handleError(err)
				})
			},
			hide(){
				this.leavePeriods = []
			},
			getEmployee(){
				myaxios('employees/'+this.employee_id).then(res=>{
					this.employee = res.data
				}).catch(err=>{
					handleError(err)
				})
			},
			simpanRule(){
				resetAllError()
				if(!this.menyimpan){
					this.menyimpan = true
					myaxios.post('leave-period/rule', this.rule).then(res=>{
						successMsg(res.data)
						this.menyimpan = false
						this.get()
					}).catch(err=>{
						handleError(err, '#edit-rule-form')
						this.menyimpan = false
					})
				}
			},
			cancelEdit(){
				this.editing = false
				macScrollTo('#data-rule')
			}
		},
		computed : {
		},
		created(){
			myaxios('employees/random').then(res=>{
				this.employee_id = res.data.id
				this.getEmployee()
			}).catch(err=>{
				handleError(err)
			})
		},
		mounted(){

		}
	}
</script>
<style>
@media screen and (min-width: 426px){
	.mt {
		margin-top: 2.1rem !important;
	}	
}
</style>