<template>
	<hris-mac :title="$store.getters.modul.payroll.title" :icon="$store.getters.modul.payroll.icon">
		<b-tabs>
			<b-tab title="By Period" active>
				<div class="row mt-3">
					<div class="col-md-12">
						<b-row>
							<b-col md="12" v-if="errorMsg">
								<b-alert show variant="danger" v-html="errorMsg"></b-alert>
							</b-col>
							<b-col lg="4" md="6">
								<my-card title="Filter" class="mb-3">
									<b-row>
										<b-col md="6">
											<months-select v-model="month"></months-select>
										</b-col>
										<b-col md="6">
											<years-select v-model="year"></years-select>
										</b-col>
										<b-col md="12">
											<b-button @click="filter" size="sm" variant="primary">
												Filter
											</b-button>
											<b-button v-if="!multiple_slip" @click="multiple_slip = true" size="sm" variant="success">
												Multiple Slip
											</b-button>
											<b-button v-else @click="multiple_slip = false" size="sm">
												Cancel Multiple Slip
											</b-button>
											<b-button @click="slipAll" size="sm" variant="danger">
												All Slip
											</b-button>
											<b-button @click="globalReport" size="sm" variant="success">
												<i class="fa fa-file-excel-o"></i> Global Report
											</b-button>
										</b-col>
										<b-col style="margin-top: 20px;" md="12" v-if="multiple_slip">
											<tags id="employee_slip">
												<option v-for="e in $store.getters.employees" :value="e.id">{{ e.nin+' '+e.name }}</option>
											</tags>
										</b-col>
										<b-col md="12" v-if="multiple_slip">
											<b-button @click="getSlip('print')" size="sm" variant="primary">
												<i class="fa fa-print"></i> Get Slip
											</b-button>
										</b-col>
									</b-row>
								</my-card>
							</b-col>
							<b-col lg="4" md="6">
								<pay-all :disabledRecal="disabledRecal" @filter="filter" @setMonth="setMonth" @setYear="setYear" @showError="showError"></pay-all>
							</b-col>
							<b-col lg="4" md="6">
								<my-card title="Slip By Group" class="mb-3">
									<b-row>
										<b-col md="12">
											<sg></sg>
										</b-col>
										<b-col md="12">
											<b-button @click="printByGroup" size="sm" variant="secondary">
												<i class="fa fa-print"></i> Print
											</b-button>
										</b-col>
									</b-row>
								</my-card>
							</b-col>
						</b-row>
						<br>
						<v-card :data="salaries">
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
						</v-card>
					</div>
				</div>
			</b-tab>
			<b-tab title="By Employee">
				<by-employee></by-employee>
			</b-tab>
		</b-tabs>
	</hris-mac>
</template>
<script>
	import payAll from './pay-all'
	import empSelect from './../employees/select'
	import sg from './../salary-group/select'
	import byEmployee from './by-employee'
	export default {
		data(){
			return {
				salaries : [],
				month : String(new Date().getMonth()+1),
				year : String(new Date().getFullYear()),
				employee : '',
				total : 0,
				totalTxt : '',
				payroll : 0,
				multiple_slip : false,
				monthName : null,
				errorMsg : '',
				disabledRecal : false,
			}
		},
		created(){
			myaxios('employees/select-mode').then(res=>{
				this.$store.commit('SET_EMPLOYEES', res.data)
			}).catch(err=>{
				errorMsg(err.response.data.message)
			})
			myaxios('salary-rules/not-set').then(res=>{
				let msg = ''
				if(res.data.length > 0){
					this.disabledRecal = true
					msg = 'Not yet set salary rule <br>'
					let a = 1
					for (let i of res.data) {
						msg += a+'. ['+(i.nin ? i.nin : 'why there is no nin ?')+'] '+i.name+' <br>'
						a++
					}
				}
				this.errorMsg = msg
			}).catch(err=>{
				errorMsg(err.response.data.message)
			})
		},
		mounted(){
			this.$store.dispatch('showView')
		},
		methods : {
			getSlip(method = 'print'){
				let employees 	= $('#employee_slip').val()
				if(!employees){
					alert('please select employee!!!')
					return
				}
				let month 		= $('#month').val()
				let year 		= $('#year').val()
				if(method == 'print')
					window.open(base_url('/salaries/multiple-slip?year='+year+'&month='+month+'&employees='+employees.join(',')))
				else
					window.open(base_url('/salaries/multiple-slip-pdf?year='+year+'&month='+month+'&employees='+employees.join(',')))
			},
			slip(id, type){
				return base_url('/payroll/slip/'+type+'/'+id)
			},
			filter(){
				if(this.month == null){
					alert('select month')
					return
				}
				if(this.month == null){
					alert('select year')
					return
				}
				this.monthName = monthName(this.month)
				this.salaries 		= 'processing'
				myaxios('payroll?month='+this.month+'&year='+this.year).then(res=>{
					this.salaries = res.data
				}).catch(err=>{
					this.salaries 	= []
				})
			},
			round(number){
				return Math.round(number*100)/100
			},
			convertHour(time){
				return Math.floor(time)+' hours '+Math.round((time-Math.floor(time))*60)+' minutes'
			},
			getDay(day){
				let d = new Date(day);
				return d.getDay()
			},
			slipAll(){
				window.open(base_url('/payroll/all-slip?month='+this.month+'&year='+this.year))
			},
			showError(errorMsg){
				this.errorMsg = errorMsg
			},
			setMonth(month){
				this.month = month
			},
			setYear(year){
				this.year = year
			},
			globalReport(){
				window.open(base_url('/payroll/global-report?month='+this.month+'&year='+this.year))
			},
			printByGroup(){
				window.open(base_url('/payroll/slip/by-group/'+$('#salary_group').val()+'?month='+this.month+'&year='+this.year))
			},
			pdfByGroup(){
				window.open(base_url('/payroll/slip/by-group/pdf/'+$('#salary_group').val()))
			}
		},
		components : {
			empSelect, payAll, sg, byEmployee
		},
		computed : {

		},
		watch : {
			salaries(val){
				if(typeof val == 'object' && val.length > 0){
					this.total = 0
					_.each(val, (item)=>{
						if(typeof item.work_total_in_hours == 'number')
							this.total += item.work_total_in_hours
					})
					this.totalTxt = this.convertHour(this.total)
					if(this.total > 176)
						this.payroll = this.convertHour(this.total - 176)
					else
						this.payroll = 0
				}
			},
		},
	}
</script>