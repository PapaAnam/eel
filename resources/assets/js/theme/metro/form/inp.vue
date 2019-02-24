<template>
	<div class="input-control text full-size">
		<label :for="id"><strong>{{ label }}</strong></label>
		<span v-if="icon" :class="['prepend-icon', icon]"></span>
		<input :readonly="readonly" :name="id" :value="value" :type="TYPE" :id="id" :data-inputmask="type == 'date' ? dateMask : ''" :data-mask="type == 'date'" :accept="accept">
		<span class="help-block fg-red"></span>
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
		}
	},
	data(){
		return {
			inputVal : this.value,
			image : false,
			accept : '*',
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
			return type === undefined || type === null ? 'text' : type
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
	}
}
</script>