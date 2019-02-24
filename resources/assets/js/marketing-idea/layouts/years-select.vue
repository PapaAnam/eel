<template>
	<my-select :id="id ? id : 'year'" :label="label ? label : 'Select Year'">
		<option v-for="m in $store.getters.years" :value="m">{{ m }}</option>
	</my-select>
</template>
<script>
	export default {
		data(){
			return {

			}
		},
		props : ['value','id','label'],
		watch : {
			value(v){
				$(this.$el).find('select').val(v)
			}		
		},
		computed : {

		},
		methods : {

		},
		created(){

		},
		mounted(){
			let vm = this
			$('select#year').on('change', function(e){
				vm.$emit('input', $(this).val())
			})
			if(this.value){
				$(this.$el).find('select').val(this.value)
			}
		}
	}
</script>