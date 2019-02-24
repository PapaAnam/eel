<template>
	<span :class="['badge', T]">
		<slot></slot>
	</span>
</template>
<script>
export default {
	props : ['type'],
	computed : {
		T()
		{
			if(this.type == 'alert')
				return 'badge-danger'
			return 'badge-'+this.type
		}
	}
}
</script>