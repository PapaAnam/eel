<template>
	<div class="mac">
		<mac-header :title="$store.getters.modul.leavePeriod.title" :icon="$store.getters.modul.leavePeriod.icon"></mac-header>
		<div class="mac-content">
			<b-tabs>
				<b-tab title="Data" active>
					<div class="card mt-2" v-if="isNew">
						<div class="card-header bg-primary text-white">
							New Leave Period
						</div>
						<div class="card-body">
							<b-alert variant="danger" :show="errorMsg.length > 0">
								{{errorMsg}}
							</b-alert>
							<form id="form-tambah" action="" @submit.prevent="save">
								<div class="row">
									<div class="col-md-4">
										<employees-select></employees-select>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="status">Status</label>
											<select v-model="statusActive" class="form-control" name="status" id="status">
												<option v-for="s in status" :value="s.id">{{s.status_name}}</option>
											</select>
											<span class="invalid-feedback"></span>
										</div>
									</div>
									<div class="col-md-4">
										<datepicker v-model="startDate" label="Start Date" id="start_date"></datepicker>
									</div>
									<div class="col-md-4">
										<datepicker v-model="endDate" label="End Date" id="end_date"></datepicker>
									</div>
									<div class="col-md-4" v-if="openAttach">
										<div class="form-group">
											<label for="attachment">Attachment</label>
											<input class="form-control" type="file" name="attachment" id="attachment">
											<span class="invalid-feedback"></span>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="reason">Reason</label>
											<textarea class="form-control" name="reason" id="reason"></textarea>
											<span class="invalid-feedback"></span>
										</div>
									</div>
									<div class="col-md-12">
										<button type="submit" :class="[saving ? 'disabled' : '', 'btn btn-primary btn-sm']">
											{{ saving ? 'Saving' : 'Save' }}
										</button>
										<button type="button" class="btn btn-danger btn-sm" @click.prevent="isNew = false">Cancel</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<button v-else class="mt-2 ml-2 btn btn-primary btn-sm" @click.prevent="isNew = true">New</button>
					<div class="card mt-2">
						<div class="card-header bg-primary text-white">
							Leave Period
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-2">
									<months-select v-model="activeMonth"></months-select>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="year" id="year">Select Year</label>
										<select v-model="activeYear" class="form-control" name="year" id="year">
											<option v-for="y in years" :value="y">{{ y }}</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<button id="getFilter" style="margin-top: 35px;" @click.prevent="getFilter" :class="['mb-2 btn btn-sm btn-primary', gettingData ? 'disabled' : '']">
										{{ gettingData ? 'Getting Data From Server' : 'View' }}
									</button>
									<button style="margin-top: 35px;" @click.prevent="getNow" :class="['mb-2 btn btn-sm btn-primary', gettingData ? 'disabled' : '']">
										{{ gettingData ? 'Getting Data From Server' : thisMonth + ' ' + thisYear }}
									</button>
								</div>
							</div>
							<div v-if="gettingData" class="alert alert-info">
								Getting Data From Server
							</div>
							<div class="table-responsive" v-else-if="leavePeriods.length > 0">
								<table id="tabel-leave" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>ID</th>
											<th>Status</th>
											<th>Employee</th>
											<th>Start Date</th>
											<th>End Date</th>
											<th>Day Total</th>
											<th>Created At</th>
											<th>Attachment</th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>ID</th>
											<th>Status</th>
											<th>Employee</th>
											<th>Start Date</th>
											<th>End Date</th>
											<th>Day Total</th>
											<th>Created At</th>
											<th>Attachment</th>
											<th>Action</th>
										</tr>
									</tfoot>
									<tbody>
										<tr v-for="d in leavePeriods">
											<td>{{ d.id }}</td>
											<td>{{ d.status }}</td>
											<td>{{ d.employee.name }}</td>
											<td>{{ d.start_date }}</td>
											<td>{{ d.end_date }}</td>
											<td>{{ d.day_total }}</td>
											<td>{{ d.created_at }}</td>
											<td>
												<a target="_blank" :href="d.attachment" v-if="d.attachment">Download</a>
											</td>
											<td>
												<button v-if="kurangDari(d.start_date)" data-toggle="tooltip" title="Remove" @click.prevent="hapus(d.id)" class="btn btn-sm btn-danger">
													X
												</button>
												<a :href="d.print_link" class="btn btn-sm btn-secondary text-white" target="_blank"><i class="fa fa-print"></i></a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div v-else class="alert alert-danger">
								Data not found
							</div>
						</div>
					</div>
				</b-tab>
				<b-tab title="Rule Template">
					<rule></rule>
				</b-tab>
				<b-tab title="Left of Leave Period">
					<status></status>
				</b-tab>
			</b-tabs>
		</div>
		<div class="mac-footer"></div>
	</div>
</template>
<script>
	import { mapGetters, mapActions } from 'vuex'
	import rule from './rule'
	import status from './status'
	export default {
		data(){
			return {
				leavePeriods : [],
				exportUrl : base_url('/leave-period'),
				isNew : false,
				sg : {},
				editable : false,
				status : [],
				openAttach : false,
				statusActive : 1,
				saving : false,
				startDate : null,
				isNew : false,
				endDate : null,
				thisMonth : 'January',
				thisYear : (new Date()).getFullYear(),
				gettingData : false,
				data : [],
				activeMonth : null,
				activeYear : null,
				years : [],
				errorMsg : '',
			}
		},
		methods : {
			get(url){
				if(!this.gettingData){
					if($.fn.DataTable.isDataTable('#tabel-leave')){
						$('#tabel-leave').DataTable().destroy()
					}
					this.gettingData = true
					myaxios(url).then(res=>{
						this.leavePeriods = res.data
						this.gettingData = false
					}).catch(err=>{
						handleError(err)
						this.gettingData = false
					})
				}
			},
			edit(id){
				this.sg = this.leavePeriods.find((item)=>{
					return item.id == id
				})
				document.getElementsByClassName('mac-content')[0].scrollTo(0,0)
				this.editable = true
				this.isNew = true
			},
			cancel(){
				this.isNew = false
				this.editable = false
			},
			hapus(id){
				if(confirm('Are you sure?')){
					myaxios.post('leave-period/'+id, {
						_method : 'DELETE'
					}).then(res=>{
						successMsg(res.data)
						$('#getFilter').trigger('click')
					}).catch(err=>{
						handleError(err)
					})	
				}
			},
			getStatus(){
				myaxios('leave-period/rule-status').then(res=>{
					this.status = res.data.data
				}).catch(err=>{
					handleError(err)
				})
			},
			save(){
				if(!this.saving){
					this.errorMsg = ''
					resetAllError()
					this.saving = true
					let data = new FormData(document.getElementById('form-tambah'))
					myaxios.post('leave-period', data).then(res=>{
						successMsg(res.data)
						this.saving = false
					}).catch(err=>{
						if(err.response.status == 409){
							this.errorMsg = err.response.data
						}else{
							handleError(err, '#form-tambah')
						}
						this.saving = false
					})
				}
			},
			getNow(){
				this.activeMonth = thisMonth()
				this.activeYear = thisYear()
				this.getFilter()
			},
			getFilter(){
				this.get('leave-period?month='+this.activeMonth+'&year='+this.activeYear)
			},
			kurangDari(startDate){
				return new Date(thisYear()+'-'+thisMonth()+'-'+thisDate()) <= new Date(startDate)
			}
		},
		watch : {
			leavePeriods(val){
				setTimeout(()=>{
					$('#tabel-leave').DataTable({
						responsive: true
					})
				},1000)
			},
			statusActive(val){
				let s = _.find(this.status, ['id', val])
				this.openAttach = s.attachment == 'true'
			},
			endDate(endDate){
				let ed = new Date(endDate)
				let sd = new Date(this.startDate)
				let range = ed.getTime() - sd.getTime()
				range = range / 3600 / 24 / 1000
				if(range <= 0){
					alert('end date must be greater than start date')
					this.endDate = ''
				}
			}
		},
		created(){
			this.get('leave-period?month='+thisMonth()+'&year='+thisYear())
			this.getStatus()
			this.startDate = this.$store.getters.now
			this.endDate = this.$store.getters.tomorrow
			this.thisMonth = monthName(thisMonth())
			this.activeMonth = thisMonth()
			this.activeYear = thisYear()
			this.years = []
			for(let y = 2018; y <= (thisYear()+1); y++){
				this.years.push(y)
			}
		},
		mounted(){
			this.$store.dispatch('showView')
		},
		computed : {
		},
		components : {
			rule, status
		}
	}
</script>