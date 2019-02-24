<template>
	<div class="mac">
		<mac-header title="Edit Attendance" icon="fa fa-bell-o mif-ani-ring mif-ani-slow"></mac-header>
		<div class="mac-content">
			<router-link :to="back">
				<i class="fa fa-arrow-left"></i> Back
			</router-link>
			<b-row>
				<b-col md="12" sm="12">
					<form id="edit-form">
						<my-card title="Employee To Attendance (One By One)">
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
		</div>
		<div class="mac-footer"></div>
	</div>
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
		props : ['back'],
		methods : {
			...mapActions([
				]),
			simpan(){
				if(!this.saving){
					this.saving = true
					resetAllError()
					let data = new FormData(document.getElementById('edit-form'))
					data.append('_method', 'PUT')
					myaxios.post('attendances/'+this.$route.params.id+window.location.search, data).then(res=>{
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
			myaxios('attendances/'+this.$route.params.id+window.location.search).then(res=>{
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