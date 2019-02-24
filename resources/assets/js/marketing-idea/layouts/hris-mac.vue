<template>
	<div class="mac">
		<mac-header :title="title ? title : setting.title" :icon="icon ? icon : setting.icon"></mac-header>
		<div class="mac-content">
			<slot></slot>
		</div>
		<div class="mac-footer"></div>
	</div>
</template>
<script>
export default {
	data(){
		return {
			
		}
	},
	props : ['icon', 'title', 'setting'],
	watch : {
		
	},
	computed : {

	},
	methods : {

	},
	created(){

	},
	mounted(){

	}
}
</script>
<style>
	
</style>