<template>
	<div class="row">
		<div class="col-sm-6">
			<input-text id="nin" :value="$store.state.employee.nin" label="NIN"></input-text>
		</div>
		<div class="col-sm-6">
			<input-text id="name" :value="$store.state.employee.name" label="Name"></input-text>
		</div>
		<div class="col-sm-6">
			<select2 id="gender">
				<option value="Male" :selected="'Male' == $store.state.employee.gender">Male</option>
				<option value="Female" :selected="'Female' == $store.state.employee.gender">Female</option>
			</select2>
		</div>
		<div class="col-sm-6">
			<input-text id="born_in" :value="$store.state.employee.born_in" label="Born In"></input-text>
		</div>
		<div class="col-sm-6">
			<input-date id="birthdate" :value="$store.state.employee.birthdate" label="Birth Date"></input-date>
		</div>
		<div class="col-sm-6">
			<select2 id="marital_status">
				<option v-for="i in 2" :value="i" :selected="i == $store.state.employee.marital_status">{{ i == 1 ? 'Maried' : 'No Maried' }}</option>
			</select2>
		</div>
		<div class="col-sm-6">
			<input-text id="handphone" :value="$store.state.employee.handphone"></input-text>
		</div>
		<div class="col-sm-6">
			<input-date id="joining_date" :value="$store.state.employee.joining_date"></input-date>
		</div>
		<div class="col-sm-6">
			<input-file id="photo"></input-file>
		</div>
		<div class="col-sm-12">
			<textar id="present_address" label="Present Address" :value="$store.state.employee.present_address"></textar>
		</div>
		<div class="col-md-12">
			<div class="alert alert-info">
				1. Dimension of photo must 300 x 400 <br>
				2. Support jpeg, jpg and png
			</div>
		</div>
	</div>
</template>
<script>
export default {
	mounted(){
		setTimeout(()=>{
			$('#gender,#marital_status').select2()
		},1500)
	}
}
</script>