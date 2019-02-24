<template>
	<b-form-group :id="id+'Group'" :label="label" :label-for="id" :description="description">
		<b-form-input v-model="isi" :state="status" :id="id" type="text"></b-form-input>
		<b-form-invalid-feedback :id="id+'InvalidFeedback'">{{errorMsg}}</b-form-invalid-feedback>
	</b-form-group>
</template>
<script>
	export default {
		data(){
			return {
				status : null,
				isi : '',
			}
		},
		props : {
			id : {
				type : String,
				required : true,
			},
			label : {
				type : String,
				required : true,
				default : 'Label',
			},
			description : {
				default : '',
				type : String,
				required : false,
			},
			errorMsg : {
				type : String,
				required : false,
				default : ''
			},
			value : {
				
			}
		},
		methods : {
			
		},
		computed : {
			
		},
		watch : {
			errorMsg(newValue){
				if(newValue){
					this.status = false
				}else{
					this.status = null
				}
			},
			isi(newValue){
				this.$emit('input',newValue)
			},
			value(newValue){
				this.isi = newValue
			}
		},
		created(){
			
		},
		mounted(){
			
		}
	}
</script>