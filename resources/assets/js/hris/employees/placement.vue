<template>
	<div class="row">
		<div class="col-sm-6">
			<select2 id="department">
				<option v-for="(d, index) in $store.getters.departments" :selected="$store.getters.employee.department_id == d.id" :value="d.id">{{ (++index)+' '+d.name }}</option>
			</select2>
		</div>
		<div class="col-sm-6">
			<select2 id="position">
				<option v-for="d in $store.getters.positions" :selected="$store.getters.employee.position == d.id" :value="d.id">{{ d.name }}</option>
			</select2>
		</div>
		<div class="col-sm-6">
			<select2 id="type">
				<option value="1" :selected="$store.getters.employee.type == '1' ">Free Employee</option>
				<option value="2" :selected="$store.getters.employee.type == '2' ">Permanent Employee</option>
			</select2>
		</div>
		<div class="col-sm-6">
			<select2 id="from">
				<option value="Local" :selected="'Local' == $store.getters.employee.e_from">Local</option>
				<option value="International" :selected="'International' == $store.getters.employee.e_from">International</option>
			</select2>
		</div>
		<div class="col-sm-6">
			<input-text id="bri_account" :value="$store.getters.employee.bri_account"></input-text>
		</div>
		<div class="col-sm-6">
			<my-inp v-model="$store.getters.employee.seguranca_social" label="Seguranca Social" id="seguranca_social"></my-inp>
		</div>
		
	</div>
</template>
<script>
	export default {
		created(){
			this.$store.dispatch('getAllDepartments')
			this.$store.dispatch('getPositions')
		},
		mounted(){
			let vm = this
			setTimeout(() => {
				$('#department').val(vm.$store.getters.employeeEditable.status ? this.$store.getters.employee.department_id : _.first(this.$store.getters.departments).id).select2()
				$('#position').val(vm.$store.getters.employeeEditable.status ? this.$store.getters.employee.position : _.first(this.$store.getters.positions).id).select2()
				$('#type').val(vm.$store.getters.employeeEditable.status ? this.$store.getters.employee.type : 1).select2()
				$('#from').val(vm.$store.getters.employeeEditable.status ? this.$store.getters.employee.e_from : 'Local').select2()
			}, 1500)
		}
	}
</script>