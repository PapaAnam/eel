<template>
	<div class="ddd" style="padding: 0 10px 10px 0;">
		<label :for="id">{{ label }}</label>
		<div class="input-group" data-role="datepicker" :data-format="format ? format : 'yyyy-mm-dd'">
			<div class="input-group-prepend">
				<div class="input-group-text">
					<span class="mif-calendar"></span>
				</div>
			</div>
			<input style="border-bottom-right-radius: 10; border-top-right-radius: 10;" :value="val" @change="updateVal($event.target.value)" type="text" class="form-control" :id="id" :name="id">
			<span class="invalid-feedback"></span>
		</div>
	</div>
</template>
<script>
	export default {
		data(){
			return {
				val : '',
			}
		},
		props : ['id', 'label', 'value', 'readonly', 'format'],
		methods : {
			resErr(selector){
				resetError(selector, this.$el)
			},
			// updateVal(val){
			// 	alert('djsk')
			// 	this.$emit('input', val)
			// }
		},
		computed : {
			lbl(){
				return this.label ? this.label : _.capitalize(_.replace(this.id, '_', ' '))
			}
		},
		watch : {
			value(val){
				this.val = val
			}
		},
		mounted(){
			this.val = this.value
			let vm = this
			$(this.$el).find('input').on('change', function(){
				vm.$emit('input', $(this).val())
				vm.$emit('change', $(this).val())
			})
		}
	}
</script>