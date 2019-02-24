<template>
	<div class="row">
		<div class="col-md-12">
			<a data-role="hint" data-hint-color="fg-white" data-hint-mode="2" data-hint-position="bottom" data-hint="Print" data-hint-background="bg-steel" @click.prevent="toPrint" class="button bg-steel fg-white cycle-button">
				<span class="mif-printer"></span>
			</a>
			<a @click.prevent="toExcel" data-role="hint" data-hint-color="fg-white" data-hint-mode="2" data-hint-position="bottom" data-hint="Excel" data-hint-background="bg-green" class="button success fg-white cycle-button">
				<span class="mif-file-excel"></span>
			</a>
			<b-button @click="excelAllURL" size="sm" variant="success">
				<i class="fa fa-file-excel-o"></i> All Employee
			</b-button>
			<b-button size="sm" class="dm" :disabled="generating" @click="generate" variant="success">{{ generating ? 'Generating' : 'Generate until end month' }}</b-button>
			<b-button size="sm" class="dm" :disabled="canceling" @click="cancel" variant="danger">{{ canceling ? 'Canceling' : 'Cancel generate' }}</b-button>
		</div>
		<div class="col-sm-6 col-md-4 col-lg-4">
			<employees-select v-model="emp"></employees-select>
		</div>
		<div class="col-sm-4 col-md-4 col-lg-2">
			<months-select v-model="month"></months-select>
		</div>
		<div class="col-sm-4 col-md-4 col-lg-2">
			<years-select v-model="year"></years-select>
		</div>
		<div class="col-md-2" style="margin-top: 32px; margin-bottom: 20px;">
			<b-button size="sm" class="dm" :disabled="gettingFromServer" @click="filter" variant="primary">{{ gettingFromServer ? 'Filtering' : 'Filter' }}</b-button>
		</div>
		<div class="col-md-12" v-if="editable">
			<e @refresh="filter" :att="att" @setEditable="editable = false"></e>
		</div>
		<div class="col-md-12">
			{{ attendances.length > 0 && attendances != 'processing' ? 'Showing attendance for ' + attendances[0].emp.name + ' '+attendances[0].emp.pos.name : '' }}
			<my-table v-if="typeof attendances == 'object' && attendances.length > 0">
				<thead>
					<tr>
						<th width="10px">#</th>
						<th width="100px">Att ID</th>
						<th width="100px">Day</th>
						<th width="200px">Date</th>
						<th width="400px">Status</th>
						<th width="300px">Enter At</th>
						<th width="100px">Break</th>
						<th width="200px">End Break</th>
						<th width="300px">Out At</th>
						<th width="300px">Work Total</th>
						<th width="300px">Total Time (W)</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<template v-for="(s, index) in attendances">
						<tr v-if="s.is_holiday" class="bg-danger text-light">
							<td class="border-danger">{{ ++index }}</td>
							<td class="border-danger">{{ s.id }}</td>
							<td class="border-danger">{{ s.day }}</td>
							<td class="border-danger">{{ s.created_at }}</td>
							<td class="border-danger">{{ s.status }}</td>
							<td class="border-danger">{{ s.enter }}</td>
							<td class="border-danger">{{ s.break }}</td>
							<td class="border-danger">{{ s.end_break }}</td>
							<td class="border-danger">{{ s.out }}</td>
							<td align="right" class="border-danger">{{ s.work_total }}</td>
							<td align="right" class="border-danger">{{ s.work_total_in_week }}</td>
							<td>
								<edit-btn v-if="activeUser.auth.attendance_edit == 1" @click.prevent.native="edit(s.id +'?date='+s.created_at+'&employee='+s.employee)"></edit-btn>
								<hapus-btn v-if="activeUser.auth.attendance_delete == 1" @click.prevent.native="hapus(s.id)"></hapus-btn>
							</td>
						</tr>
						<tr v-else>
							<td>{{ ++index }}</td>
							<td>{{ s.id }} </td>
							<td>{{ s.day }} </td>
							<td>{{ s.created_at }}</td>
							<td @click="showStatus($event, s.id)">
								<template v-if="editedStatus && s.id == statusId">
									<form id="form-status">
										<status v-model="s.status" />
										<b-button @click="editStatus(s.id, s.status)" variant="primary" size="sm" :disabled="savingStatus">{{ savingStatus ? 'saving' : 'save' }}</b-button>
										<b-button size="sm" @click="editedStatus = false">Cancel</b-button>
									</form>
								</template>
								<template v-else>
									{{ s.status }}
								</template>
							</td>
							<td @click="showEnter($event, s.enter, s.id)">
								<template v-if="editedEnter && s.id == enterId">
									<form @submit.prevent="editEnter(s.id)" id="form-enter">
										<timemask v-model="enterValue" id="enter" label="Enter At" />
										<b-button size="sm" @click="editedEnter = false">Cancel</b-button>
									</form>
								</template>
								<template v-else>
									{{ s.enter }}
								</template>
							</td>
							<td>{{ s.break }}</td>
							<td>{{ s.end_break }}</td>
							<td @click="showOut($event, s.id)">
								<template v-if="editedOut && outId == s.id">
									<form @submit.prevent="editOut(s.id, s.out)" id="form-out">
										<timemask v-model="s.out" id="out" label="Out At" />
										<b-button size="sm" @click="editedOut = false">Cancel</b-button>
									</form>
								</template>
								<template v-else>
									{{ s.out }}
								</template>
							</td>
							<td align="right">{{ s.work_total }}</td>
							<td align="right">{{ s.work_total_in_week }}</td>
							<td>
								<edit-btn v-if="activeUser.auth.attendance_edit == 1" @click.prevent.native="edit(s.id +'?date='+s.created_at+'&employee='+s.employee)"></edit-btn>
								<hapus-btn v-if="activeUser.auth.attendance_delete == 1" @click.prevent.native="hapus(s.id)"></hapus-btn>
							</td>
						</tr>
					</template>
					<tr>
						<td colspan="8" align="right"><strong>Total</strong></td>
						<td align="right">{{ totalTxt }}</td>
					</tr>
					<template v-if="!isMix">
						<tr>
							<td colspan="8" align="right">
								<strong>Standart Time Work / Month</strong>
							</td>
							<td align="right" @click="showEditStandartTime($event)">
								<template v-if="editedWorkTime">
									<form @submit.prevent="editStandartTime" id="form-standart-time">
										<inp v-model="standartWorkTimeInNumber" id="standartWorkTimeInNumber" label="Standart Work Time" />
										<b-button size="sm" @click="editedWorkTime = false">Cancel</b-button>
									</form>
								</template>
								<template v-else>
									{{ standartWorkTime }}
								</template>
							</td>
						</tr>
						<tr>
							<td colspan="8" align="right"><strong>Over Time Regular</strong></td>
							<td align="right" @click="showEditOtRegular($event)">
								<template v-if="editedOtRegular">
									<form @submit.prevent="editOtRegular" id="form-ot-regular">
										<inp v-model="ot_regular_in_hours" id="ot_regular_in_hours" label="OT Regular" />
										<b-button size="sm" @click="editedOtRegular = false">Cancel</b-button>
									</form>
								</template>
								<template v-else>
									{{ over_time_regular }}
								</template>
							</td>
						</tr>
						<tr>
							<td colspan="8" align="right"><strong>Over Time Holiday</strong></td>
							<td align="right"  @click="showEditOtHoliday($event)">
								<template v-if="editedOtHoliday">
									<form @submit.prevent="editOtHoliday" id="form-ot-holiday">
										<inp v-model="ot_holiday_in_hours" id="ot_holiday_in_hours" label="OT Holiday" />
										<b-button size="sm" @click="editedOtHoliday = false">Cancel</b-button>
									</form>
								</template>
								<template v-else>
									{{ over_time_holiday }}
								</template>
							</td>
						</tr>
					</template>
				</tbody>
			</my-table>
			<template v-else-if="attendances === 'processing'">
				<b-alert show variant="info">
					Processing
				</b-alert>
			</template>
			<template v-else>
				<b-alert show variant="danger">
					Data not available
				</b-alert>
			</template>
		</div>
	</div>
</template>
<script>
	import v from './v.vue'
	import { mapGetters, mapActions } from 'vuex'
	import e from './form-edit.vue'
	import status from './status'
	export default {
		data(){
			return {
				editable : false,
				exportUrl : base_url('/attendances'),
				gettingFromServer : false,
				attendances : [],
				emp : '',
				month : getMonth(),
				year : getYear(),
				monthName : null,
				empName : '',
				totalTxt : '',
				over_time_regular : 0,
				over_time_holiday : 0,
				att : {
					emp : {

					}
				},
				editedStatus : false,
				editedEnter : false,
				editedOut : false,
				savingStatus : false,
				enterValue : null,
				editedOtRegular : false,
				editedOtHoliday : false,
				ot_regular_in_hours : null,
				ot_holiday_in_hours : null,
				isMix : false,
				enterId : null,
				outId : null,
				statudId : null,
				standartWorkTime : null,
				standartWorkTimeInNumber : null,
				editedWorkTime : false,
				canceling : false,
				generating : false,
			}
		},
		computed : {
			...mapGetters([
				'activeUser'
				]),
			date : {
				get(){
					return this.now
				},
				set(val){
					this.now = val
				}
			}
		},
		methods : {
			...mapActions([
				'hapusAttendance'
				]),
			edit(id){
				this.editable = true
				document.getElementsByClassName('mac-content')[0].scrollTo(0,0)
				myaxios('attendances/'+id).then(res=>{
					this.att = res.data
				})
			},
			excelAllURL(){
				window.open(base_url('/over-time/excel?employee=all&year='+this.year+'&month='+this.month))
			},
			filter(){
				this.load()
			},
			setEmp(){
				this.emp = $(this.$el).find('#employee').val()
			},
			generate(){
				this.setEmp()
				if(this.validate()){
					this.generating = true
					myaxios.post('attendances/generate?employee='+this.emp+'&month='+this.month+'&year='+this.year).then(res=>{
						this.generating = false
						successMsg(res.data)
						this.filter()
					}).catch(err=>{
						this.generating = false
					})
				}
			},
			cancel(){
				this.setEmp()
				if(this.validate()){
					this.canceling = true
					myaxios.post('attendances/cancel-generate?employee='+this.emp+'&month='+this.month+'&year='+this.year).then(res=>{
						this.canceling = false
						successMsg(res.data)
						this.filter()
					}).catch(err=>{
						this.canceling = false
					})
				}
			},
			load(){
				this.setEmp()
				if(this.validate()){
					this.gettingFromServer = true
					this.monthName = monthName(this.month)
					this.attendances = 'processing'
					axios('attendances/data/filter-employee?employee='+this.emp+'&month='+this.month+'&year='+this.year).then(res=>{
						this.attendances = res.data
						this.empName = this.attendances[0].emp.name
						this.gettingFromServer = false
					}).catch(err=>{
						this.attendances = []
						this.gettingFromServer = false
					})
				}
				this.getOTReg()
				if(this.editable){
					myaxios('attendances?employee='+this.emp+'&created_at='+$(this.$el).find('#created_at').val()).then(res=>{
						this.att = res.data
					})
				}
				myaxios('attendances/standart-time?month='+this.month+'&year='+this.year).then(res=>{
					this.standartWorkTime = res.data
				}).catch(err=>{
					handleError(err)
				})
			},
			getOTReg(){
				axios('over-time/regular?employee='+this.emp+'&month='+this.month+'&year='+this.year).then(res=>{
					this.over_time_regular = res.data
				})
				axios('over-time/holiday?employee='+this.emp+'&month='+this.month+'&year='+this.year).then(res=>{
					this.over_time_holiday = res.data
				})
				myaxios('attendances/work-total?employee='+this.emp+'&month='+this.month+'&year='+this.year).then(res=>{
					this.totalTxt = res.data
				})
			},
			toExcel(){
				this.setEmp()
				if(this.validate())
					window.open(base_url('/attendances/filter-employee/excel?employee='+this.emp+'&month='+this.month+'&year='+this.year))
			},
			toPrint(){
				this.setEmp()
				if(this.validate())
					window.open(base_url('/attendances/filter-employee/print?employee='+this.emp+'&month='+this.month+'&year='+this.year))	
			},
			validate(){
				this.setEmp()
				if(!this.emp){
					alert('select employee first!')
					return
				}
				if(!this.month){
					alert('select month first!')
					return
				}
				if(!this.year){
					alert('select year first!')
					return
				}
				return true
			},
			setEdit(){
				this.edit = true
			},
			hapus(id){
				let con = confirm('Are you sure?')
				if(con){
					axios.post('attendances/delete/'+id, {
						_method : 'DELETE'
					}).then((res) => {
						successMsg(res.data)
						this.$emit('refresh')
					}).catch((err) => {
						handleError(err)
					})
				}
			},
			editEnter(id){
				myaxios.post('attendances/enter/'+id+'/update?user_id='+this.$store.getters.activeUser.id, {
					_method : 'PUT',
					enter : this.enterValue
				}).then((res) => {
					successMsg(res.data)
					this.editedEnter = false
					this.filter()
				}).catch((err) => {
					handleError(err, '#form-enter')
				})
			},
			editOut(id, out){
				myaxios.post('attendances/out/'+id+'/update?user_id='+this.$store.getters.activeUser.id, {
					_method : 'PUT',
					out
				}).then((res) => {
					successMsg(res.data)
					this.editedOut = false
					this.filter()
				}).catch((err) => {
					handleError(err, '#form-out')
				})
			},
			editStatus(id, status){
				this.savingStatus = true
				myaxios.post('attendances/status/'+id+'/update?user_id='+this.$store.getters.activeUser.id, {
					_method : 'PUT',
					status
				}).then((res) => {
					successMsg(res.data)
					this.editedStatus = false
					this.filter()
					this.savingStatus = false
				}).catch((err) => {
					handleError(err, '#form-status')
					this.savingStatus = false
				})
			},
			showStatus(event, id){
				let target = $(event.target)
				if(target.context.tagName == 'TD'){
					this.editedStatus = true
					this.statusId = id
				}
			},
			showEnter(event, enterValue, id){
				console.log(id)
				let target = $(event.target)
				if(target.context.tagName == 'TD'){
					this.editedEnter = true
					this.enterValue = enterValue
					this.enterId = id
				}
			},
			showOut(event, id){
				let target = $(event.target)
				if(target.context.tagName == 'TD'){
					this.editedOut = true
					this.outId = id
				}
			},
			showEditOtRegular(event){
				if(!this.isMix){
					let target = $(event.target)
					if(target.context.tagName == 'TD'){
						this.editedOtRegular = true
						myaxios('over-time/regular-in-hours?employee='+this.emp+'&month='+this.month+'&year='+this.year).then(res=>{
							this.ot_regular_in_hours = res.data
						}).catch(err=>{
							handleError(err)
						})
					}
				}
			},
			editOtRegular(){
				myaxios.post('over-time/regular-in-hours/update?employee='+this.emp+'&month='+this.month+'&year='+this.year,{
					_method : 'PUT',
					ot_regular_in_hours : this.ot_regular_in_hours
				}).then(res=>{
					successMsg(res.data)
					this.filter()
					this.editedOtRegular = false
				}).catch(err=>{
					handleError(err, 'form-ot-regular')
				})
			},
			showEditOtHoliday(event){
				if(!this.isMix){
					let target = $(event.target)
					if(target.context.tagName == 'TD'){
						this.editedOtHoliday = true
						myaxios('over-time/holiday-in-hours?employee='+this.emp+'&month='+this.month+'&year='+this.year).then(res=>{
							this.ot_holiday_in_hours = res.data
						}).catch(err=>{
							handleError(err)
						})
					}	
				}
			},
			editOtHoliday(){
				myaxios.post('over-time/holiday-in-hours/update?employee='+this.emp+'&month='+this.month+'&year='+this.year,{
					_method : 'PUT',
					ot_holiday_in_hours : this.ot_holiday_in_hours
				}).then(res=>{
					successMsg(res.data)
					this.filter()
					this.editedOtHoliday = false
				}).catch(err=>{
					handleError(err, 'form-ot-holiday')
				})
			},
			showEditStandartTime(event){
				if(!this.isMix){
					let target = $(event.target)
					if(target.context.tagName == 'TD'){
						this.editedWorkTime = true
						myaxios('attendances/max-work-time?month='+this.month+'&year='+this.year).then(res=>{
							this.standartWorkTimeInNumber = res.data
						}).catch(err=>{
							handleError(err)
						})
					}	
				}
			},
			editStandartTime(){
				myaxios.post('attendances/max-work-time/update?month='+this.month+'&year='+this.year,{
					_method : 'PUT',
					standartWorkTime : this.standartWorkTimeInNumber
				}).then(res=>{
					successMsg(res.data)
					this.filter()
					this.editedWorkTime = false
				}).catch(err=>{
					handleError(err, 'form-standart-time')
				})
			},
		},
		watch : {
			// enterValue(val){
			// 	console.log('enterValue '+val)
			// }
		},
		created(){
			myaxios('is-mix').then(res=>{
				this.isMix = res.data == 1
			}).catch(err=>{
				handleError(err)
			})
			this.year = (new Date()).getFullYear()
			// console.log(this.year)
		},
		components : {
			v, e, status
		},
		mounted(){
			this.$store.dispatch('showView')
		}
	}
</script>
<style>
@media screen and (max-width: 425px){
	.dm {
		margin-bottom: 20px;
		margin-top: -30px;
	}
}
</style>