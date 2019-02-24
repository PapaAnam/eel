<template>
	<div>
		<label :for="id">{{ label }}</label>
		<div class="input-group" data-role="datepicker" :data-format="format ? format : 'yyyy-mm-dd'">
			<div class="input-group-prepend">
				<div class="input-group-text">
					<span class="mif-calendar"></span>
				</div>
			</div>
			<input style="border-bottom-right-radius: 10; border-top-right-radius: 10;" @change="updateVal($event.target.value)" type="text" class="form-control" :id="id" :name="id">
			<span class="invalid-feedback"></span>
		</div>
	</div>
</template>
<script>
export default {
	data(){
		return {
			mod : this.value
		}
	},
	props : ['id', 'label', 'value', 'format'],
	watch : {
		value(value){
			$(this.$el).find('input').val(value)
		}
	},
	computed : {

	},
	methods : {
		
	},
	created(){

	},
	mounted(){
		console.log(this.format)
	}
}
</script>