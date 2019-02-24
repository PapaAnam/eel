<template>
	<b-form-group :label="label">
		<b-form-select @change="hh" :name="id" :id="id" v-model="mod">
			<slot></slot>
		</b-form-select>
		<span class="invalid-feedback"></span>
	</b-form-group>
</template>
<script>
	export default {
		data(){
			return {
				mod : this.value
			}
		},
		props : ['id', 'label', 'value'],
		watch : {
			mod(v)
			{
				this.$emit('input', v)
			}
		},
		computed : {

		},
		methods : {
			hh(){
				this.$emit('change', this.mod)
			}
		},
		created(){

		},
		mounted(){
			console.log(!this.mod)
			if(!this.mod){
				setTimeout(()=>{
					let a = document.getElementById(this.id)
					a.selectedIndex = 0
				}, 1000)
			}
		}
	}
</script>