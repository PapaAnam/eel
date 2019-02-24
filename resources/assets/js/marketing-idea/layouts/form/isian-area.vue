<template>
	<b-form-group :id="id+'Group'" :label="label" :label-for="id" :description="description">
		<textarea v-model="isi" :id="id" :rows="rows" wrap="soft" :class="['form-control', errorMsg ? 'is-invalid' : '']"></textarea> 
		<b-form-invalid-feedback :id="id+'InvalidFeedback'">{{errorMsg}}</b-form-invalid-feedback>
	</b-form-group>
</template>
<script>
	export default {
		data(){
			return {
				status : null,
				isi : null,
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
			rows : {
				type : Number,
				required : false,
				default : 3,
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