<template>
	<b-form id="myForm" @submit.prevent="onSubmit">
		<b-row>
			<b-col md="6" lg="4">
				<isian :error-msg="errorMsg.outlet_code" v-model="data.outlet_code" id="outlet_code" label="Outlet Code"></isian>
			</b-col>
			<b-col md="6" lg="4">
				<isian :error-msg="errorMsg.outlet_name" v-model="data.outlet_name" id="outlet_name" label="Outlet Name"></isian>
			</b-col>
			<b-col md="6" lg="4">
				<isian-area :error-msg="errorMsg.address" v-model="data.address" id="address" label="Address"></isian-area>
			</b-col>
			<b-col md="6" lg="4">
				<isian :error-msg="errorMsg.district" v-model="data.district" id="district" label="District"></isian>
			</b-col>
			<b-col md="6" lg="4">
				<isian :error-msg="errorMsg.phone_number" v-model="data.phone_number" id="phone_number" label="Phone Number"></isian>
			</b-col>
			<b-col md="6" lg="4">
				<isian :error-msg="errorMsg.contact_person" v-model="data.contact_person" id="contact_person" label="Contact Person"></isian>
			</b-col>
			<b-col md="6" lg="4">
				<isian :error-msg="errorMsg.segment" v-model="data.segment" id="segment" label="Segment"></isian>
			</b-col>
			<b-col md="6" lg="4">
				<isian :error-msg="errorMsg.salesman" v-model="data.salesman" id="salesman" label="Salesman"></isian>
			</b-col>
			<b-col md="6" lg="4">
				<isian :error-msg="errorMsg.division" v-model="data.division" id="division" label="Division"></isian>
			</b-col>
			<b-col md="6" lg="4">
				<isian :error-msg="errorMsg.latitude" v-model="data.latitude" id="latitude" label="Latitude"></isian>
			</b-col>
			<b-col md="6" lg="4">
				<isian :error-msg="errorMsg.longitude" v-model="data.longitude" id="longitude" label="Longitude"></isian>
			</b-col>
			<b-col md="6" lg="4">
				<isian-gambar v-model="icon" :error-msg="errorMsg.icon" id="icon" label="Icon"></isian-gambar>
			</b-col>
			<b-col md="12" v-if="ubah" class="mb-2">
				<img :src="data.icon" :alt="data.outlet_name">
			</b-col>
			<b-col md="12">
				<tombol-simpan :menyimpan="saving"></tombol-simpan>
			</b-col>
		</b-row>
	</b-form>
</template>

<script>
	import { mapActions } from 'vuex'
	export default{
		data(){
			return {
				saving : false,
				icon : '',
				errorMsg : null,
				data : {
					outlet_code:'',
					outlet_name:'',
					address:'',
					district:'',
					phone_number:'',
					contact_person:'',
					segment:'',
					salesman:'',
					division:'',
					latitude:'',
					longitude:'',
				},
				saving : false,
			}
		},
		props : {
			ubah : {
				default : false,
			},
			dataUbah : {
				type : Object
			}
		},
		mounted(){
		},
		methods : {
			setDefaultErrorMsg(){
				this.errorMsg = {
					outlet_code:null,
					outlet_name:null,
					address:null,
					district:null,
					phone_number:null,
					contact_person:null,
					segment:null,
					salesman:null,
					division:null,
					latitude:null,
					longitude:null,
					icon : null
				}
			},
			onSubmit(){
				if(!this.saving){
					this.saving = true
					this.setDefaultErrorMsg()
					let data = new FormData(document.getElementById('myForm'))
					data.append('icon',this.icon)
					for(let any in this.data){
						if(any != 'icon')
							data.append(any, this.data[any])
					}
					let link = 'marketing-idea/customer-outlet/store'
					if(this.ubah){
						link = 'marketing-idea/customer-outlet/update/'+this.dataUbah.id
						data.append('_method','PUT')
					}
					myaxios.post(link,data).then(res=>{
						successMsg(res.data.message)
						this.saving = false
						this.$emit('refresh')
					}).catch(err=>{
						for(let key in err.response.data.errors){
							this.errorMsg[key] = err.response.data.errors[key][0]
						}
						this.saving = false
					})
				}
			}
		},
		watch : {
			dataUbah(newValue){
				this.data = newValue
			}
		},
		created(){
			this.setDefaultErrorMsg()
		}
	}
</script>