<template>
	<div data-role="charm" :id="id" :data-position="pos">
		<h1 class="text-light">{{ title }}</h1>
		<hr class="thin"/>
		<br />
		<slot></slot>
	</div>
</template>
<script>
export default {
	props : ['position', 'id', 'title'],
	computed : {
		pos(){
			return this.position === undefined ? 'top' : this.position
		}
	}
}
</script>