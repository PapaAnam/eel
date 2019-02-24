<template>
	<metro>
		<layout>
			<judul>Fleet Management</judul>
			<my-navbar></my-navbar>
			<my-fleet-tiles></my-fleet-tiles>
		</layout>
		<skin></skin>
		<my-window></my-window>
	</metro>
</template>
<script>
export default {
	mounted(){
		if(this.$route.path != '/')
			$('#my-window').fadeIn()
	}
}
</script>
<style>
	.p-5 {
		padding: 5px;
	}
	.p-10 {
		padding: 10px;
	}
	.pb-20 {
		padding-bottom: 20px;
	}
	body {
		overflow: hidden;
	}
</style>