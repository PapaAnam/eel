<template>
	<button :class="['btn btn-primary btn-sm', processing ? 'disabled' : '']" @click="click">
		{{ text }}
	</button>
</template>
<script>
	export default {
		methods : {
			click(){
				this.$emit('click')
			}
		},
		props : ['text', 'processing']
	}
</script>