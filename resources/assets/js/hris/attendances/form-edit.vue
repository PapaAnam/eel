<template>
	<b-col md="12" sm="12" style="margin-bottom: 20px;">
		<form id="edit-form">
			<my-card title="Edit Employee To Attendance (One By One)">
				<b-row>
					<div class="col-lg-3 col-sm-6">
						<b-form-group label="Attendance ID">
							<b-form-input readonly id="id" v-model="attendance.id" name="id"></b-form-input>
						</b-form-group>
					</div>
					<div class="col-lg-3 col-sm-6">
						<b-form-group label="Employee">
							<b-form-input readonly id="emp" v-model="attendance.emp.name" name="emp"></b-form-input>
						</b-form-group>
					</div>
					<div class="col-lg-3 col-sm-6">
						<datepicker label="Attendance Date" @change="editForm" v-model="attendance.created_at" readonly id="created_at" name="created_at"></datepicker>
					</div>
					<div class="col-lg-3 col-sm-6">
						<timemask :value="attendance.enter" id="enter" label="Enter"></timemask>
					</div>
					<div class="col-lg-3 col-sm-6">
						<timemask :value="attendance.break ? attendance.break : '12:00:00'" id="break" label="Break"></timemask>
					</div>
					<div class="col-lg-3 col-sm-6">
						<timemask :value="attendance.end_break ? attendance.end_break : '13:00:00'" id="end_break" label="End Break"></timemask>
					</div>
					<div class="col-lg-3 col-sm-6">
						<timemask :value="attendance.out" id="out" label="Out At"></timemask>
					</div>
					<div class="col-lg-3 col-sm-6">
						<status :status="attendance.status"></status>
						<br>
					</div>
					<b-col lg="12">
						<simpan-btn @simpan="simpan" :saving="saving"></simpan-btn>
						<batal-btn @click.prevent.native="setEditable"></batal-btn>
					</b-col>
				</b-row>
			</my-card>
		</form>
	</b-col>
</template>
<script>
	import status from './status'
	import { mapGetters, mapActions } from 'vuex'
	export default {
		data(){
			return {
				saving : false,
				attendance : {
					emp : {
						
					}
				}
			}
		},
		computed : {
		},
		props : ['att'],
		methods : {
			...mapActions([
				]),
			simpan(){
				if(!this.saving){
					this.saving = true
					resetAllError()
					let data = new FormData(document.getElementById('edit-form'))
					data.append('_method', 'PUT')
					myaxios.post('attendances/'+this.attendance.id+'?created_at='+this.attendance.created_at+'&employee='+this.attendance.employee+'&user_id='+this.$store.getters.activeUser.id, data).then(res=>{
						this.saving = false
						this.$emit('refresh')
						successMsg(res.data)
					}).catch(err=>{
						handleError(err, '#edit-form')
						this.saving = false
					})
				}
			},
			editForm(){
				myaxios('attendances?created_at='+this.attendance.created_at+'&employee='+this.attendance.employee).then(res=>{
					this.attendance = res.data
				}).catch(err=>{
					handleError(err)
				})
			},
			setEditable(){
				this.$emit('setEditable')
			}
		},
		watch : {
			att(val){
				this.attendance = val
			}
		},
		components : {
			status
		},
		mounted(){
			this.attendance = this.att
		}
	}
</script>