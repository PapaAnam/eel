<template>
	<div :class="['tile-group', type]">
		<span v-if="title" class="tile-group-title">{{ title }}</span>
		<div class="tile-container">
			<slot></slot>
		</div>
	</div>
</template>
<script>
	export default {
		props : ['double', 'title'],
		computed : {
			type(){
				return this.double == undefined ? 'one' : 'double'
			}
		}
	}
</script>