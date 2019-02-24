<template>
	<div class="row">
		<div class="col-md-12">
			<export-btn :url="exportUrl"></export-btn>
			<b-button @click="load" variant="primary" :disabled="refreshing" size="sm">
				{{ refreshing ? 'Refreshing' : 'Refresh' }}
			</b-button>
		</div>
		<div class="col-sm-12" v-if="showNonActivate">
			<my-card title="Non activate an employee">
				<select2 id="reason">
					<option value="1">Stand Down</option>
					<option value="2">Chronic Pain</option>
					<option value="3">Move District</option>
					<option value="4">Family Reason</option>
					<option value="5">No Mention</option>
					<option value="6">Termination Of Employment</option>
					<option value="7">Other</option>
				</select2>
				<b-button variant="primary" size="sm" @click="nonAct">Non Activate</b-button>
				<b-button size="sm" @click="showNonActivate = false">Close</b-button>
			</my-card>
		</div>
		<div class="col-md-12">
			<b-alert show variant="info" v-if="refreshing">
				Refreshing
			</b-alert>
			<my-dt v-else :data="employees">
				<thead>
					<tr>
						<th>NIN</th>
						<th>Name</th>
						<th>Department</th>
						<th>Job Title</th>
						<th width="100px">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(s, index) in employees">
						<td>{{ s.nin }}</td>
						<td>{{ s.name }}</td>
						<td>{{ s.dep ? s.dep.name : '-' }}</td>
						<td>{{ s.job ? s.job.name : '-' }}</td>
						<td>
							<b-dropdown text="Choose" variant="info" size="sm">
								<b-dropdown-item :to="'/employees/edit/'+s.id">Edit</b-dropdown-item>
								<b-dropdown-item @click="hapusEmployee(s.id)">Delete</b-dropdown-item>
								<b-dropdown-item :to="'/employees/detail/'+s.id">Detail</b-dropdown-item>
								<b-dropdown-item @click="nonActivate(s.id)">Non Activate</b-dropdown-item>
								<b-dropdown-item :href="identityUrl+'/print/'+s.id">Print</b-dropdown-item>
								<b-dropdown-item :href="identityUrl+'/excel/'+s.id">Excel</b-dropdown-item>
							</b-dropdown>
						</td>
					</tr>
				</tbody>
			</my-dt>
		</div>
	</div>
</template>
<script>
	import { mapGetters, mapActions } from 'vuex'
	export default {
		data(){
			return {
				exportUrl : base_url('/employees'),
				identityUrl : base_url('/employees/identity'),
				showNonActivate : false,
				id : null,
				refreshing : false,
			}
		},
		computed : {
			...mapGetters([ 'employees', 'employee', 'employeeEditable' ])
		},
		watch : {
			employeeEditable(){
				this.getEmployee(this.employeeEditable.id)
			}
		},
		methods : {
			...mapActions([ 'getEmployees', 'hapusEmployee', 'getEmployee' ]),
			edit(id){
				this.$store.state.employeeEditable = {
					status : true,
					id
				}
			},
			nonActivate(id){
				this.id = id 
				this.showNonActivate = true	
				document.getElementsByClassName('mac-content')[0].scrollTo(0,0)
			},
			nonAct(){
				myaxios.post('employees/non-activate/'+this.id,{
					_method : 'PUT',
					reason : $('#reason').val()
				}).then(res=>{
					this.showNonActivate = false
					successMsg(res.data)
					this.getEmployees()
				}).catch(err=>{
					handleError(err)
				})
			},
			load(){
				if(!this.refreshing){
					this.refreshing = true
					myaxios('employees/active?with=job,dep').then(res=>{
						this.refreshing = false
						this.$store.commit('SET_EMPLOYEES', res.data)
					}).catch(err=>{
						this.refreshing = false
						errorMsg(err.response.data.message)
					})	
				}
			}
		},
		created(){
			this.load()
		}
	}
</script>