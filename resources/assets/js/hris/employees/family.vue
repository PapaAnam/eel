<template>
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-6">
				<input-text id="father" :value="$store.state.employee.father"></input-text>
			</div>
			<div class="col-sm-6">
				<input-text id="mother" :value="$store.state.employee.mother"></input-text>
			</div>
			<div class="col-sm-6">
				<input-text id="husband" :value="$store.state.employee.husband"></input-text>
			</div>
			<div class="col-sm-6">
				<input-text id="wife" :value="$store.state.employee.wife"></input-text>
			</div>
			<div class="col-sm-6">
				<input-text id="son" :value="$store.state.employee.son"></input-text>
			</div>
			<div class="col-sm-6">
				<input-text id="daughter" :value="$store.state.employee.daughter"></input-text>
			</div>
		</div>
	</div>
</template>