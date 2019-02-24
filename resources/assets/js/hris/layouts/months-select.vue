<template>
	<my-select :id="id ? id : 'month'" :label="label ? label : 'Select Month'">
		<option v-for="m in months" :value="m.value">{{ m.title }}</option>
	</my-select>
</template>
<script>
	export default {
		data(){
			return {
				months : this.$store.getters.months,
			}
		},
		props : ['value', 'appends','id','label'],
		watch : {
			value(v){
				setTimeout(()=>{
					$(this.$el).find('select').val(v)
				}, 2000)
			},
			'$store.getters.months'(val){
				this.months = val
				this.months.push(this.appends)
			}
		},
		computed : {
		},
		methods : {

		},
		created(){
			if(this.appends){
				this.months.push(this.appends)
			}
		},
		mounted(){
			let vm = this
			$('select#month').on('change', function(e){
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