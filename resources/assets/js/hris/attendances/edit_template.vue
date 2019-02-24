<template>
	<b-row>
		<b-col md="12" sm="12">
			<form id="edit-form">
				<my-card title="Edit Employee To Attendance (One By One)">
					<b-row>
						<div class="col-lg-3 col-sm-6">
							<b-form-group label="Employee">
								<b-form-input readonly id="emp" v-model="att.emp.name" name="emp"></b-form-input>
							</b-form-group>
						</div>
						<div class="col-lg-3 col-sm-6">
							<b-form-group label="Attendance Date">
								<b-form-input v-model="att.created_at" readonly id="created_at" name="created_at"></b-form-input>
							</b-form-group>
						</div>
						<div class="col-lg-3 col-sm-6">
							<timemask :value="att.enter" id="enter" label="Enter"></timemask>
						</div>
						<div class="col-lg-3 col-sm-6">
							<timemask :value="att.break ? att.break : '12:00:00'" id="break" label="Break"></timemask>
						</div>
						<div class="col-lg-3 col-sm-6">
							<timemask :value="att.end_break ? att.end_break : '13:00:00'" id="end_break" label="End Break"></timemask>
						</div>
						<div class="col-lg-3 col-sm-6">
							<timemask :value="att.out" id="out" label="Out At"></timemask>
						</div>
						<div class="col-lg-3 col-sm-6">
							<status :status="att.status"></status>
							<br>
						</div>
						<b-col lg="12">
							<simpan-btn @simpan="simpan" :saving="saving"></simpan-btn>
						</b-col>
					</b-row>
				</my-card>
			</form>
		</b-col>
	</b-row>
</template>
<script>
	import status from './status'
	import empSelect from './../employees/select'
	import { mapActions } from 'vuex'
	export default{
		data(){
			return {
				saving : false,
				att : {
					emp : {

					}
				},
			}
		},
		props : ['back', 'id', 'query'],
		methods : {
			...mapActions([
				]),
			simpan(){
				if(!this.saving){
					this.saving = true
					resetAllError()
					let data = new FormData(document.getElementById('edit-form'))
					data.append('_method', 'PUT')
					myaxios.post('attendances/'+this.id+this.query, data).then(res=>{
						this.saving = false
						successMsg(res.data)
					}).catch(err=>{
						handleError(err, '#edit-form')
						this.saving = false
					})
				}
			}
		},
		created(){
			myaxios('attendances/'+this.id+this.query).then(res=>{
				this.att = res.data
			})
		},
		mounted(){
			this.$store.dispatch('showView')
		},
		components : {
			empSelect, status
		}
	}
</script>