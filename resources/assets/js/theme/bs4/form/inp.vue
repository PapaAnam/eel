<template>
	<div class="form-group">
		<label :for="id" class="text-capitalize">{{ label ? label : id.replace('_',' ') }}</label>
		<input :readonly="readonly" class="form-control" :name="id" :min="min" :max="max" :step="step" :value="value" :type="TYPE" :id="id" @input="updateValue($event.target.value)" :data-inputmask="type == 'date' ? dateMask : false" :data-mask="type == 'date'" :accept="accept">
		<div class="invalid-feedback"></div>
	</div>
</template>
<script>
export default {
	props : {
		icon : {

		},
		id : {

		}, 
		value : {

		}, 
		label : {
			
		}, 
		type : {

		},
		readonly : {
			default : false,
		},
		min : {
			type : Number
		},
		max : {
			type : Number
		},
		step : {
			type : Number
		}
	},
	data(){
		return {
			inputVal : this.value,
			image : false,
			accept : false,
			dateMask : "'alias': 'yyyy-mm-dd'"
		}
	},
	computed : {
		TYPE(){
			let type = this.type
			if(type === 'image'){
				type = 'file'
				this.accept = 'image/jpeg,image/png'
			}
			if(type === 'favicon'){
				type = 'file'
				this.accept = 'image/x-icon'
			}
			if(this.type == 'date')
				type = 'text'
			if(this.type == 'name')
				type = 'text'
			return type === undefined || type === null ? 'text' : type
		}
	},
	methods : {
		updateValue(value)
		{
			this.$emit('input', Number(value))
		}
	},
	watch : {
		inputVal(newVal){
			this.$emit('input', newVal)
		}
	},
	mounted(){
		if(this.type == 'date'){
			$(this.$el).find('#'+this.id).inputmask();
		}
		let regexp_number 		= new RegExp('[0-9]')
		if(this.type == 'name'){
			$(this.$el).find('input').on('keydown', (e)=>{
				let event = e.originalEvent
				let only = 'abcsdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ '
				only = only.split('')
				for(let o of ['Backspace', 'ArrowLeft', 'ArrowRight', 'Delete', 'Tab'])
					only.push(o)
				if(only.indexOf(event.key) === -1)
					e.preventDefault()
			})
			let regexp_symbol 		= new RegExp('[^0-9a-z A-Z]')
			$(this.$el).find('input').on('blur', function(e){
				let val = $(this).val()
				let event = e.originalEvent
				if(regexp_number.test(val))
					$(this).val('')
				if(regexp_symbol.test(val)){
					$(this).val('')
				}
			})
		}
		if(this.type == 'number'){
			$(this.$el).find('input').on('keydown', (e)=>{
				let event = e.originalEvent
				let only = 'abcsdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ '
				only = only.split('')
				if(only.indexOf(event.key) > -1)
					e.preventDefault()
			})
			let vm = this
			$(this.$el).find('input').on('blur', function(e){
				let val = $(this).val()
				let event = e.originalEvent
				if(!regexp_number.test(val))
					$(this).val('')
				if(vm.min){
					if(val < vm.min){
						$(this).val(vm.min)
						vm.$emit('input', Number(vm.min))
					}
				}
				if(vm.max){
					if(val > vm.max){
						$(this).val(vm.max)
						vm.$emit('input', Number(vm.max))
					}else{
						if(vm.step){
							if(!(val / vm.step % 1 === 0 )){
								let temp = Math.ceil(val / vm.step) * vm.step
								$(this).val(temp)
								vm.$emit('input', Number(temp))
							}
						}
					}
				}
			})
		}
	}
}
</script>