<template>
	<div>
		<b-row v-if="editable">
			<form-edit :att="att" @setEditable="setEditable" @refresh="refresh"></form-edit>
		</b-row>
		<v-card :data="attendances">
			{{ msg }}
			<br>
			<br>
			<my-dt v-if="!byEmployee">
				<thead>
					<tr>
						<th width="10px">#</th>
						<th>Attendance ID</th>
						<th>Employee</th>
						<th>Day</th>
						<th>Date</th>
						<th>Status</th>
						<th>Enter At</th>
						<th>Break</th>
						<th>End Break</th>
						<th>Out At</th>
						<th>Work Total</th>
						<th width="100px">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(s, index) in attendances" :style="'color:'+ s.is_holiday ? 'red':''">
						<td>{{ ++index }}</td>
						<td>{{ s.id }}</td>
						<td>
							<template v-if="s.emp">
								{{ s.emp.nin+' - '+s.emp.name }}
							</template>
						</td>
						<td>{{ s.day }}</td>
						<td>{{ s.created_at }}</td>
						<td>{{ s.status }}</td>
						<td>{{ s.enter }}</td>
						<td>{{ s.break }}</td>
						<td>{{ s.end_break }}</td>
						<td>{{ s.out }}</td>
						<td>{{ s.work_total }}</td>
						<td>
							<edit-btn v-if="activeUser.auth.attendance_edit == 1" @click.prevent.native="edit(s.id +'?date='+s.created_at+'&employee='+s.employee)"></edit-btn>
							<hapus-btn v-if="activeUser.auth.attendance_delete == 1" @click.prevent.native="hapus(s.id)"></hapus-btn>
						</td>
					</tr>
				</tbody>
			</my-dt>
			<my-table v-else>
				<thead>
					<tr>
						<th width="10px">#</th>
						<th>Attendance ID</th>
						<th>Employee</th>
						<th>Day</th>
						<th>Date</th>
						<th>Status</th>
						<th>Enter At</th>
						<th>Break</th>
						<th>End Break</th>
						<th>Out At</th>
						<th>Work Total</th>
						<th width="100px">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(s, index) in attendances" :class="[s.is_holiday ? 'liburan' : s.status == 'Absent' ? 'absent' : '']">
						<td>{{ ++index }}</td>
						<td>{{ s.id }}</td>
						<td>
							<template v-if="s.emp">
								{{ s.emp.nin+' - '+s.emp.name }}
							</template>
						</td>
						<td>{{ s.day }}</td>
						<td>{{ s.created_at }}</td>
						<td>{{ s.status }}</td>
						<td>{{ s.enter }}</td>
						<td>{{ s.break }}</td>
						<td>{{ s.end_break }}</td>
						<td>{{ s.out }}</td>
						<td>{{ s.work_total }}</td>
						<td>
							<edit-btn v-if="activeUser.auth.attendance_edit == 1" @click.prevent.native="edit(s.id +'?date='+s.created_at+'&employee='+s.employee)"></edit-btn>
							<hapus-btn v-if="activeUser.auth.attendance_delete == 1" @click.prevent.native="hapus(s.id)"></hapus-btn>
						</td>
					</tr>
				</tbody>
			</my-table>
		</v-card>
	</div>
</template>
<script>
	import status from './status'
	import formEdit from './form-edit'
	import { mapGetters, mapActions } from 'vuex'
	import empSelect from './../employees/select'
	export default {
		data(){
			return {
				editable : false,
				att : {
					emp : {}
				},
				saving : false,
				url : '',
				activeID : null,
			}
		},
		computed : {
			...mapGetters([
				'activeUser'
				])
		},
		props : ['attendances', 'msg', 'byEmployee'],
		methods : {
			...mapActions([
				'hapusAttendance'
				]),
			edit(url){
				this.editable = true
				this.url = url
				document.getElementsByClassName('mac-content')[0].scrollTo(0,0)
				myaxios('attendances/'+url).then(res=>{
					this.att = res.data
				})
			},
			simpan(){
				if(!this.saving){
					this.saving = true
					resetAllError()
					let data = new FormData(document.getElementById('edit-form'))
					data.append('_method', 'PUT')
					myaxios.post('attendances/'+this.att.id+'?created_at='+this.att.created_at+'&employee='+this.att.employee, data).then(res=>{
						this.saving = false
						this.$emit('refresh')
						successMsg(res.data)
					}).catch(err=>{
						handleError(err, '#edit-form')
						this.saving = false
					})
				}
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
			editForm(){
				myaxios('attendances?created_at='+this.att.created_at+'&employee='+this.att.employee).then(res=>{
					this.att = res.data
				}).catch(err=>{
					handleError(err)
				})
			},
			refresh(){
				this.$emit('refresh')
			},
			setEditable(){
				this.editable = false
			}
		},
		components : {
			empSelect, status, formEdit
		},
		watch : {
		},
		mounted(){
		}
	}
</script>
<style>
	.liburan {
		background-color: #dc3545 !important;
		font-weight: bold;
		color: white;
	}
	.liburan > td {
		border-color: #dc3545 !important;
	}
	.absent {
		font-weight: bold;
		color: red;
	}

</style>