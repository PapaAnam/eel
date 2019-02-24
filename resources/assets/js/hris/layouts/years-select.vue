<template>
	<my-select :id="id ? id : 'year'" :label="label ? label : 'Select Year'">
		<option v-for="m in years" :value="m">{{ m }}</option>
	</my-select>
</template>
<script>
	export default {
		data(){
			return {
				years : [],
			}
		},
		props : ['value','id','label','withNext'],
		watch : {
			value(v){
				// console.log(v)
				$(this.$el).find('select').val(v)
			}		
		},
		computed : {

		},
		methods : {

		},
		created(){
			if(this.withNext != undefined){
				let date = new Date()
				for(let year = 2017; year <= (date.getFullYear()+1); year++)
					this.years.push(year)
			}else{
				this.years = this.$store.getters.years
			}
		},
		mounted(){
			let vm = this
			$('select#year').on('change', function(e){
				vm.$emit('input', $(this).val())
			})
			if(this.value){
				setTimeout(()=>{
					$(this.$el).find('select').val(this.value)
				}, 2000)
			}
		}
	}
</script>