<template>
	<b-form-group :label="label">
		<textarea :name="id" :id="id" class="form-control" :rows="row" :placeholder="label"></textarea>
		<b-form-invalid-feedback :id="id"></b-form-invalid-feedback>
	</b-form-group>
</template>
<script>
export default {
	data(){
		return {
			row : 3,
		}
	},
	props : ['id', 'label', 'rows'],
	watch : {
		
	},
	computed : {

	},
	methods : {

	},
	created(){

	},
	mounted(){
		if(this.rows){
			this.row = this.rows
		}
	}
}
</script>