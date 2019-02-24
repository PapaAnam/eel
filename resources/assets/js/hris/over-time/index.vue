<template>
	<hris-mac :title="$store.getters.modul.overTime.title" :icon="$store.getters.modul.overTime.icon">
		<div class="row">
			<div class="col-md-12">
				<my-card title="Filter" class="mb-3">
					<b-row>
						<b-col md="4">
							<emp-select></emp-select>
						</b-col>
						<b-col md="4">
							<months-select v-model="month"></months-select>
						</b-col>
						<b-col md="4">
							<years-select v-model="year"></years-select>
						</b-col>
						<b-col md="12">
							<b-button @click="filter" size="sm" variant="primary">
								Filter
							</b-button>
							<b-button @click="excelURL" v-if="typeof attendances == 'object' && attendances.length > 0" size="sm" variant="success">
								<i class="fa fa-file-excel-o"></i> Excel
							</b-button>
							<b-button @click="excelAllURL" v-if="typeof attendances == 'object' && attendances.length > 0" size="sm" variant="success">
								<i class="fa fa-file-excel-o"></i> All Employee
							</b-button>
						</b-col>
					</b-row>
				</my-card>
				<my-card v-if="typeof attendances == 'object' && attendances.length > 0" :title="'Attendance '+employee+' in '+monthName(month)+' '+year">
					<my-table>
						<thead>
							<tr>
								<th width="10px">#</th>
								<th>Day</th>
								<th>Date</th>
								<th>Status</th>
								<th>Enter At</th>
								<th>Break</th>
								<th>End Break</th>
								<th>Out At</th>
								<th>Work Total</th>
								<!-- <th>Over Time</th> -->
								<!-- <th>Over Time ($)</th> -->
								<th>Total Time (W)</th>
								<!-- <th>OT In Week</th> -->
							</tr>
						</thead>
						<tbody>
							<template v-for="(s, index) in attendances">
								<tr v-if="s.is_holiday" class="bg-danger text-light">
									<td class="border-danger">{{ ++index }}</td>
									<td class="border-danger">{{ s.day }}
										<td class="border-danger">{{ s.created_at }}</td>
										<td class="border-danger">{{ s.status }}</td>
										<td class="border-danger">{{ s.enter }}</td>
										<td class="border-danger">{{ s.break }}</td>
										<td class="border-danger">{{ s.end_break }}</td>
										<td class="border-danger">{{ s.out }}</td>
										<td align="right" class="border-danger">{{ s.work_total }}</td>
										<!-- <td align="right" class="border-danger">{{ s.over_time }}</td> -->
										<!-- <td align="right" class="border-danger">{{ s.over_time_in_money }}</td> -->
										<td align="right" class="border-danger">{{ s.work_total_in_week }}</td>
										<!-- <td align="right" class="border-danger">{{ s.over_time_in_week }}</td> -->
									</tr>
									<tr v-else>
										<td>{{ ++index }}</td>
										<td>{{ s.day }} </td>
										<td>{{ s.created_at }}</td>
										<td>{{ s.status }}</td>
										<td>{{ s.enter }}</td>
										<td>{{ s.break }}</td>
										<td>{{ s.end_break }}</td>
										<td>{{ s.out }}</td>
										<td align="right">{{ s.work_total }}</td>
										<!-- <td align="right">{{ s.over_time }}</td> -->
										<!-- <td align="right">{{ s.over_time_in_money }}</td> -->
										<td align="right">{{ s.work_total_in_week }}</td>
										<!-- <td align="right">{{ s.over_time_in_week }}</td> -->
									</tr>
								</template>
								<tr>
									<td colspan="8" align="right"><strong>Total</strong></td>
									<td align="right">{{ totalTxt }}</td>
								<!-- <td align="right">{{ totalOTTxt }}</td>
									<td align="right">{{ totalOTTxt2 }}</td> -->
								</tr>
								<tr>
									<td colspan="8" align="right"><strong>Standart Time Work / Month</strong></td>
									<td align="right">176 hours</td>
								<!-- <td align="right">{{ totalOTTxt }}</td>
									<td align="right">{{ totalOTTxt2 }}</td> -->
								</tr>
								<tr>
									<td colspan="8" align="right"><strong>Over Time Regular</strong></td>
									<td align="right">{{ over_time_regular }}</td>
								<!-- <td align="right">{{ totalOTTxt }}</td>
									<td align="right">{{ totalOTTxt2 }}</td> -->
								</tr>
								<tr>
									<td colspan="8" align="right"><strong>Over Time Holiday</strong></td>
									<td align="right">{{ over_time_holiday }}</td>
								<!-- <td align="right">{{ totalOTTxt }}</td>
									<td align="right">{{ totalOTTxt2 }}</td> -->
								</tr>
							<!-- <tr>
								<td colspan="7" align="right"><strong>Minimum work in a month</strong></td>
								<td align="right">176 hours</td>
							</tr>
							<!-- <tr>
								<td colspan="7" align="right"><strong>Over time</strong></td>
								<td align="right">{{ overTime }}</td>
							</tr> -->
							<!-- <tr v-for="(o, index) in over_time_in_week_money">
								<td colspan="7" align="right"><strong>Over time In Week {{ index+1 }}</strong></td>
								<td align="right">{{ over_time_in_week[index] }}</td>
								<td align="right">{{ o }}</td>
							</tr> -->
						</tbody>
					</my-table>
				</my-card>
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
	</hris-mac>
</template>
<script>
	import empSelect from './../employees/select'
	export default {
		data(){
			return {
				attendances : [],
				month : '',
				year : '',
				employee : '',
				total : 0,
				totalTxt : '',
				overTime : 0,
				month 	: String(new Date().getMonth()+1),
				year 	: String(new Date().getFullYear()),
				totalOTTxt : '',
				totalOTTxt2 : '',
				over_time_in_week_money : 0,
				over_time_in_week : 0,
				mingguKe : 0,
				over_time_regular : 0,
				over_time_holiday : 0,
			}
		},
		mounted(){
			this.$store.dispatch('showView')
		},
		methods : {
			getOTReg(){
				axios('over-time/regular?employee='+$('#employee').val()+'&month='+this.month+'&year='+this.year).then(res=>{
					this.over_time_regular = res.data
				})
				axios('over-time/holiday?employee='+$('#employee').val()+'&month='+this.month+'&year='+this.year).then(res=>{
					this.over_time_holiday = res.data
				})
			},
			filter(){
				if($('#employee').val() == null){
					alert('select employee')
					return
				}
				if($('#month').val() == null){
					alert('select month')
					return
				}
				if($('#year').val() == null){
					alert('select year')
					return
				}
				this.month 			= $('#month').val()
				this.year 			= $('#year').val()
				this.employee 		= document.getElementById('employee').selectedOptions[0].innerText
				this.attendances 	= 'processing'
				axios('attendances/filter?employee='+$('#employee').val()+'&month='+this.month+'&year='+this.year).then(res=>{
					this.attendances = res.data
				}).catch(err=>{
					this.attendances 	= []
				})
				this.getOTReg()
			},
			round(number){
				return Math.round(number*100)/100
			},
			convertHour(time){
				let jam 	= Math.floor(time)
				let prefix 	= jam > 1 ? jam + ' hours' : (jam > 0 ? jam + ' hour' : '')
				let menit 	= Math.round((time-Math.floor(time))*60)
				let suffix 	= menit > 1 ? menit + ' minutes' : (menit > 0 ? menit + ' minute' : '')
				return (prefix+' '+suffix).trim() == '' ? '-' : prefix+' '+suffix
			},
			getDay(day){
				let d = new Date(day);
				return d.getDay()
			},
			excelURL(){
				window.open(base_url('/over-time/excel?employee='+$('#employee').val()+'&year='+this.year+'&month='+this.month))
			},
			excelAllURL(){
				window.open(base_url('/over-time/excel?employee=all&year='+this.year+'&month='+this.month))
			},
			monthName(m){
				return monthName(m)
			}
		},
		components : {
			empSelect
		},
		computed : {
			years(){
				let d = new Date()
				let years = []
				for (let i = 2018; i <= d.getFullYear(); i++) {
					years.push(i)
				}
				return years
			}
		},
		watch : {
			attendances(val){
				if(typeof val == 'object' && val.length > 0){
					this.total = 0
					_.each(val, (item)=>{
						if(typeof item.work_total_in_hours == 'number')
							this.total += item.work_total_in_hours
					})
					this.totalTxt = this.convertHour(this.total)
					if(this.total > 176)
						this.overTime = this.convertHour(this.total - 176)
					else
						this.overTime = 0

				// total over time dalam satuan waktu
				let totalOT = 0
				_.each(val, (item)=>{
					if(typeof item.over_time_in_hours == 'number')
						totalOT += item.over_time_in_hours
				})
				this.totalOTTxt = this.convertHour(totalOT)

				// total over time dalam satuan duit
				totalOT = 0
				_.each(val, (item)=>{
					if(typeof item.over_time_in_money == 'number')
						totalOT += item.over_time_in_money
				})
				this.totalOTTxt2 = Math.round(totalOT*100)/100
				this.over_time_in_week_money = []
				this.over_time_in_week = []
				// let ti = 0
				// let ta = 0
				// this.over_time_holiday = 0
				// this.over_time_regular = 0
				// for(let a of val){
				// 	let dt = new Date(a.created_at)
				// 	if(dt.getDay() === 0){
				// 		this.over_time_in_week_money.push(Math.round(ti*100)/100)
				// 		this.over_time_in_week.push(this.convertHour(ta))
				// 		ti = 0
				// 		ta = 0
				// 	}else{
				// 		ta += a.over_time_in_hours
				// 		ti += a.over_time_in_money
				// 	}
				// 	if(a.is_holiday)
				// 		this.over_time_holiday += a.over_time_in_hours
				// 	else
				// 		this.over_time_regular += a.over_time_in_hours
				// }
				// let ot_holiday = this.over_time_holiday
				// this.over_time_holiday = this.convertHour(this.over_time_holiday)
				// let ot_reg = this.total - 176 - ot_holiday
				// this.over_time_regular = this.convertHour(ot_reg)
				// this.over_time_regular = this.convertHour(this.over_time_regular)
			}
		}
	},
	created(){

	}
}
</script>