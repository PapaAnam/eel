<template>
	<my-select id="job_title" label="Job Title">
		<option v-for="d in $store.getters.positions" :value="d.id">{{ d.name }}</option>
	</my-select>
</template>
<script>
export default {
	data(){
		return {
		}
	},
	props : [],
	watch : {
	},
	computed : {

	},
	methods : {
		
	},
	created(){
		this.$store.dispatch('getPositions')
	},
	mounted(){
	}
}
</script>