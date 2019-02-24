<template>
	<div class="mac">
		<mac-header title="New Payroll" :icon="$store.getters.modul.payroll.icon"></mac-header>
		<div class="mac-content">
			<back-btn to="/payroll"></back-btn>
			<b-row>
				<b-col md="12" v-if="errorMsg">
					<b-alert show variant="danger" v-html="errorMsg">
					</b-alert>
				</b-col>
				<b-col lg="4" sm="6">
					<form id="add-enter-form">
						<my-card title="Pay All Employee">
							<b-row>
								<b-col lg="12">
									<months-select v-model="month"></months-select>
								</b-col>
								<b-col lg="12">
									<years-select v-model="year"></years-select>
								</b-col>
								<b-col lg="12">
									<b-progress v-if="" class="mb-2" :value="progress" :variant="progress <= 30 ? 'danger' : 'success'" show-progress></b-progress>
									<b-button size="sm" @click="processAll" :disabled="isProcessAll" variant="primary">{{ isProcessAll ? 'Processing' : 'Process All Employee' }}</b-button>
									<!-- <b-button @click="eek"></b-button> -->
									<b-button size="sm" v-if="success" to="/payroll">Ok</b-button>
								</b-col>
							</b-row>
						</my-card>
					</form>
				</b-col>
				<!-- <b-col md="4" sm="6">
					<form id="multiply-form">
						<my-card title="Employee To Attendance (Multiply)">
							<div class="row">
								<div class="col-md-12">
									<my-select label="Department" id="dep" v-model="depSelected">
										<option v-for="d in dep" :value="d.id">{{ d.name }}</option>
									</my-select>
								</div>
								<div class="col-md-12" v-if="sub">
									<b-form-group label="Sub Department">
										<b-form-select name="subdep" id="subdep" v-model="subDepSelected">
											<option v-for="d in subDep" :value="d.id">{{ d.name }}</option>
										</b-form-select>
									</b-form-group>
								</div>
								<div class="col-md-12" v-if="subSub">
									<b-form-group label="Sub Sub Department">
										<b-form-select name="subsubdep" id="subsubdep" v-model="subSubDepSelected">
											<option v-for="d in subSubDep" :value="d.id">{{ d.name }}</option>
										</b-form-select>
									</b-form-group>
								</div>
								<div class="col-sm-12">
									<div class="form-group">
										<label for="time">Time</label>
										<select v-model="time" name="time" id="time" class="select2 form-control" style="width: 100%;">
											<option value="enter">Enter</option>
											<option value="break">Break</option>
											<option value="end_break">End Break</option>
										</select>
									</div>
								</div>
								<div class="col-md-12">
									<my-datepicker id="created_at" label="Attendance Date"></my-datepicker>
								</div>
								<div class="col-sm-12">
									<timemask id="time_at" :label="timeText"></timemask>
								</div>
								<div class="col-sm-12">
									<simpan-btn @simpan="saveMulti" :saving="saving2"></simpan-btn>
								</div>
							</div>
						</my-card>
					</form>
				</b-col>
				<b-col md="4" sm="6">
					<form id="excel-form">
						<my-card title="Employee To Attendance (Load From Excel File)">
							<b-row>
								<div class="col-md-12">
									<b-form-group label="Excel File">
										<b-form-file accept=".xls, .xlsx" id="attendance_excel" name="attendance_excel"></b-form-file>
									</b-form-group>
								</div>
								<div class="col-md-12">
									<div class="alert alert-info">
										<h5><i class="icon fa fa-info-circle"></i> Please Read :)</h5>
										File extension must .xls or .xlsx<br>
										<a target="_blank" :href="exampleExcel">Download</a> this example for rule of attendance file 
									</div>
								</div>
								<div class="col-sm-12">
									<simpan-btn :saving="saving3" @simpan="uploadExcel"></simpan-btn>
								</div>
							</b-row>
						</my-card>
					</form>
				</b-col> -->
			</b-row>
		</div>
		<div class="mac-footer"></div>
	</div>
</template>
<script>
	import empSelect from './../employees/select'
	import { mapActions } from 'vuex'
	export default{
		data(){
			return {
				saving : false,
				saving2 : false,
				saving3 : false,
				absenceStatus : [
				{ value : 'Present', text : 'Present' }, 
				{ value : 'Sick', text : 'Sick' }, 
				{ value : 'Absent', text : 'Absent' }, 
				{ value : 'Official Travel', text : 'Official Travel' }, 
				{ value : 'Father Leave', text : 'Father Leave' }, 
				{ value : 'Holiday', text : 'Holiday' }, 
				{ value : 'Special Permit', text : 'Special Permit' }, 
				{ value : 'Pregnancy', text : 'Pregnancy' }
				],
				dep : [],
				subDep : [],
				subSubDep : [],
				depSelected : '',
				subDepSelected : '',
				subSubDepSelected : '',
				sub : false,
				subSub : false,
				time : 'enter',
				timeText : 'Enter At',
				exampleExcel : base_url('/attendances/example'),
				isProcessAll : false,
				month : '',
				year : '',
				errorMsg : false,
				month 	: String(new Date().getMonth()+1),
				year 	: String(new Date().getFullYear()),
				progress : 0,
				success : false,
			}
		},
		methods : {
			...mapActions([
				'saveAccount'
				]),
			simpan(){
				if(!this.saving){
					this.saving = true
					resetAllError()
					let data = new FormData(document.getElementById('add-enter-form'))
					myaxios.post('attendances/store', data).then(res=>{
						this.saving = false
						successMsg(res.data)
					}).catch(err=>{
						handleError(err, '#add-enter-form')
						this.saving = false
					})
				}
			},
			saveMulti()
			{
				if(!this.saving2){
					this.saving2 = true
					resetAllError()
					let data = new FormData(document.getElementById('multiply-form'))
					myaxios.post('attendances/store-multi', data).then(res=>{
						this.saving2 = false
						successMsg(res.data)
					}).catch(err=>{
						handleError(err, '#multiply-form')
						this.saving2 = false
					})
				}
			},
			eek(){
				this.progress = Math.random() * 100
			},
			uploadExcel()
			{
				if(!this.saving3){
					this.saving3 = true
					resetAllError()
					let data = new FormData(document.getElementById('excel-form'))
					myaxios.post('attendances/store-excel', data).then(res=>{
						this.saving3 = false
						successMsg(res.data)
					}).catch(err=>{
						handleError(err, '#excel-form')
						this.saving3 = false
					})
				}
			},
			processAll()
			{
				this.progress = Math.random() * 40
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
					myaxios.post('payroll/pay-all-employee', {
						month : this.month,
						year : this.year,
					}, {
						onUploadProgress(progressEvent){
							let percent = Math.floor((progressEvent.loaded * 100) / progressEvent.total)
							this.progress = percent
							console.log(this.progress)
						}
					}).then(res=> {
						this.progress = 100
						successMsg(res.data)
						this.isProcessAll = false
						this.success = true
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
								this.success = true
							}
						}
					})
				}
			}
		},
		created(){
			this.$store.state.account = ''
			myaxios('departments').then(res=>{
				this.dep = res.data
				this.dep.push({
					id : 'all',
					name : 'All'
				})
			})
		},
		mounted(){
			this.$store.dispatch('showView')
		},
		components : {
			empSelect,
		},
		watch : {
			depSelected(val)
			{
				if(val!= 'all'){
					let selected = _.find(this.dep, (item)=>{
						return item.id == val
					})
					if(selected.depts.length > 0){
						this.sub = true
						this.subDep = []
						this.subSubDep = []
						this.subDep = selected.depts
						this.subDep.push({
							id : 'all',
							name : 'All'
						})
					}else{
						this.sub = false
						this.subSub = false
						this.subDep = []
						this.subSubDep = []
					}
				}else{
					this.sub = false
					this.subSub = false
					this.subDep = []
					this.subSubDep = []
				}
			},
			subDepSelected(val)
			{
				if(val!= 'all'){
					let selected = _.find(this.subDep, (item)=>{
						return item.id == val
					})
					if(selected.depts.length > 0){
						this.subSub = true
						this.subSubDep = []
						this.subSubDep = selected.depts
						this.subSubDep.push({
							id : 'all',
							name : 'All'
						})
					}else{
						this.subSub = false
						this.subSubDep = []
					}
				}else{
					this.subSub = false
					this.subSubDep = []
				}
			},
			time(val)
			{
				if(val === 'enter'){
					this.timeText = 'Enter At'
				}else if(val === 'break'){
					this.timeText = 'Break At'
				}else if(val === 'end_break'){
					this.timeText = 'End Break At'
				}
			}
		}
	}
</script>