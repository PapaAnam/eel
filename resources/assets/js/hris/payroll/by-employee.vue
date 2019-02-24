<template>
	<div class="row mt-3">
		<b-col md="12" v-if="errorMsg">
			<b-alert show variant="danger" v-html="errorMsg"></b-alert>
		</b-col>
		<b-col md="6" lg="4">
			<form id="add-enter-form">
				<my-card title="Recalculation Salary Per Employee" class="mb-2">
					<b-row>
						<b-col md="12">
							<employees-select v-model="emp"></employees-select>
						</b-col>
						<b-col md="6">
							<months-select v-model="month"></months-select>
						</b-col>
						<b-col md="6">
							<years-select v-model="year"></years-select>
						</b-col>
						<b-col lg="12">
							<b-button size="sm" @click="pay" :disabled="processing" variant="primary">{{ processing ? 'Paying' : 'Pay' }}</b-button>
							<b-button size="sm" @click="view" :disabled="salaries == 'processing'" variant="primary">{{ salaries == 'processing' ? 'Searching' : 'View' }}</b-button>
							<a v-if="salaries.length > 0 && salaries != 'processing'" class="text-light btn btn-sm btn-secondary" target="_blank" href="#" @click.prevent="getSlip">
								<i class="fa fa-print"></i> Slip
							</a>
						</b-col>
					</b-row>
				</my-card>
			</form>
		</b-col>
		<b-col md="12">
			<v-card :data="salaries">
				<my-card title="Data">
					Showing salaries in {{ monthName }} {{ year }}
					<my-dt :data="salaries">
						<thead>
							<tr>
								<th>#</th>
								<th>NIN</th>
								<th>Employee</th>
								<th>Seguranca ID</th>
								<th>Clear Salary</th>
								<th>Created At</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(s, i) in salaries">
								<td>{{ ++i }}</td>
								<td>
									<template v-if="s.emp">
										{{ s.emp.nin }}
									</template>
								</td>
								<td>
									<template v-if="s.emp">
										{{ s.emp.name }}
									</template>
								</td>
								<td>{{ s.seguranca_id }}</td>
								<td>{{ s.clear_salary }}</td>
								<td>{{ s.created_at }}</td>
								<td>
									<a class="text-light btn btn-sm btn-secondary" target="_blank" :href="slip(s.id, 'print')">
										<i class="fa fa-print"></i> Slip
									</a>
								</td>
							</tr>
						</tbody>
					</my-dt>
				</my-card>
			</v-card>
		</b-col>
	</div>
</template>

<script>
	import { mapGetters } from 'vuex'
	export default{
		data(){
			return {
				processing : false,
				month : getMonth(),
				year : getYear(),
				emp : '',
				salaries : [],
				monthName : "",
				errorMsg : null,
			}
		},
		methods : {
			pay(){
				this.success = false
				if(!this.processing){
					if(this.month == ''){
						alert('please select month first')
						return
					}
					if(this.year == ''){
						alert('please select year first')
						return
					}
					if(this.emp == ''){
						this.emp = $('#employee').val()
					}
					this.errorMsg = null
					this.processing = true
					myaxios.post('payroll/pay', {
						month : this.month,
						year : this.year,
						employee : this.emp
					}).then(res=> {
						this.processing = false
						successMsg(res.data)
					}).catch(err=>{
						this.errorMsg = err.response.data
						errorMsg(err.response.data)
						this.processing = false
						handleError(err)
					})
				}
			},
			view(){
				if(this.month == null){
					alert('select month')
					return
				}
				if(this.month == null){
					alert('select year')
					return
				}
				if(this.emp == ''){
					this.emp = $('#employee').val()
				}
				this.monthName = monthName(this.month)
				this.salaries 		= 'processing'
				myaxios('payroll?month='+this.month+'&year='+this.year+'&employee='+this.emp).then(res=>{
					this.salaries = res.data
				}).catch(err=>{
					this.salaries 	= []
				})
			},
			slip(id, type){
				return base_url('/payroll/slip/'+type+'/'+id)
			},
			getSlip(){
				if(this.emp == ''){
					this.emp = $('#employee').val()
				}
				window.open(base_url('/payroll/slip?employee='+this.emp+'&year='+this.year+'&month='+this.month))
			}
		},
		computed : {
			...mapGetters([
				])
		},
		created(){
			
		},
		mounted(){
			$(this.$el).find('#month').append('<option value="all">All</option>')
		}
	}
</script>