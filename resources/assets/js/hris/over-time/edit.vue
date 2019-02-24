<template>
	<div class="mac">
		<mac-header title="Edit Attendance" icon="fa fa-bell-o mif-ani-ring mif-ani-slow"></mac-header>
		<div class="mac-content">
			<router-link to="/attendances">
				<i class="fa fa-arrow-left"></i> Back
			</router-link>
			<b-row>
				<b-col md="4" sm="6">
					<form id="edit-form">
						<my-card title="Employee To Attendance (One By One)">
							<b-row>
								<b-col lg="12">
									<b-form-group label="Employee">
										<b-form-input readonly id="emp" v-model="att.emp.name" name="emp"></b-form-input>
									</b-form-group>
								</b-col>
								<b-col lg="12">
									<b-form-group label="Attendance Date">
										<b-form-input v-model="att.created_at" readonly id="created_at" name="created_at"></b-form-input>
									</b-form-group>
								</b-col>
								<b-col lg="12">
									<timemask :value="att.break" id="break" label="Break"></timemask>
								</b-col>
								<b-col lg="12">
									<timemask :value="att.end_break" id="end_break" label="End Break"></timemask>
								</b-col>
								<b-col lg="12">
									<timemask :value="att.out" id="out" label="Out At"></timemask>
								</b-col>
								<b-col lg="12">
									<status></status>
								</b-col>
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
	methods : {
		...mapActions([
			]),
		simpan(){
			if(!this.saving){
				this.saving = true
				resetAllError()
				let data = new FormData(document.getElementById('edit-form'))
				data.append('_method', 'PUT')
				myaxios.post('attendances/'+this.$route.params.id, data).then(res=>{
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
		myaxios('attendances/'+this.$route.params.id).then(res=>{
			this.att = res.data
		})
	},
	mounted(){
		this.$store.dispatch('showView')
	},
	components : {
		empSelect, status,
	}
}
</script>