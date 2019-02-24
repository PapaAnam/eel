<template>
	<b-form-group :id="id+'Group'" :label="label" :label-for="id" :description="description">
		<b-form-file :state="status" v-model="myValue" :id="id" accept=".jpg, .png"></b-form-file>
		<b-form-invalid-feedback :id="id+'InvalidFeedback'">{{errorMsg}}</b-form-invalid-feedback>
	</b-form-group>
</template>
<script>
	export default {
		data(){
			return {
				myValue : '',
				status : null
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
				required : false,
			}
		},
		methods : {
			
		},
		computed : {
			
		},
		watch : {
			myValue(newValue){
				this.$emit('input',newValue)
			},
			errorMsg(newValue){
				if(newValue){
					this.status = false
				}else{
					this.status = null
				}
			}
		},
		created(){
			
		},
		mounted(){
			
		}
	}
</script>