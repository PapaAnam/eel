<template>
	<div :class="['app-bar', THEME]" :data-role="FLEXIBLE">
		<slot></slot>
	</div>
</template>
<script>
	export default {
		props : ['flexible', 'theme'],
		computed : {
			THEME(){
				return this.theme ? this.theme : ''
			},
			FLEXIBLE(){
				return this.flexible !== undefined ? 'appbar' : ""
			}
		}
	}
</script>