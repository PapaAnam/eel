<template>
	<div class="row">
		<div class="col-sm-6">
			<input-text id="elementary" :value="$store.state.employee.elementary"></input-text>
		</div>
		<div class="col-sm-6">
			<input-text id="el_year" :value="$store.state.employee.el_year"></input-text>
		</div>
		<div class="col-sm-6">
			<input-text id="junior" :value="$store.state.employee.junior"></input-text>
		</div>
		<div class="col-sm-6">
			<input-text id="jun_year" :value="$store.state.employee.jun_year"></input-text>
		</div>
		<div class="col-sm-6">
			<input-text id="senior" :value="$store.state.employee.senior"></input-text>
		</div>
		<div class="col-sm-6">
			<input-text id="sen_year" :value="$store.state.employee.sen_year"></input-text>
		</div>
		<div class="col-sm-6">
			<input-text id="university" :value="$store.state.employee.university"></input-text>
		</div>
		<div class="col-sm-6">
			<input-text id="u_year" :value="$store.state.employee.u_year"></input-text>
		</div>
	</div>
</template>