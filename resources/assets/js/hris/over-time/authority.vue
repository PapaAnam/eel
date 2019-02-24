<template>
	<div class="panel panel-default">
		<div class="panel-heading">
			Authority
		</div>
		<div class="panel-body">      
			<div class="row">
				<div class="col-sm-6">
					<iradio id="check-all" label="Check All"></iradio>
				</div>
				<div class="col-sm-6">
					<iradio id="check-all" label="Uncheck All"></iradio>
				</div>
			</div>
			<hr>
			<div class="row" id="check-menu">
				<div class="col-sm-6 col-md-3">
					<icheck id="department" :checked="account.auth ? account.auth.department == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
				</div>
				<div class="col-sm-6 col-md-3">
					<icheck id="sub_department" :checked="account.auth ? account.auth.sub_department == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
				</div>
				<div class="col-sm-6 col-md-3">
					<icheck id="position" :checked="account.auth ? account.auth.position == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
				</div>
				<div class="col-sm-6 col-md-3">
					<icheck id="employee_menu" :checked="account.auth ? account.auth.employee == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
				</div>
				<div class="col-sm-6 col-md-3">
					<icheck id="salary_rule" :checked="account.auth ? account.auth.salary_rule == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
				</div>
				<div class="col-sm-6 col-md-3">
					<icheck id="special_day" :checked="account.auth ? account.auth.special_day == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
				</div>
				<div class="col-sm-6 col-md-3">
					<icheck id="attendance" :checked="account.auth ? account.auth.attendance == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
				</div>
				<div class="col-sm-6 col-md-3">
					<icheck id="over_time" :checked="account.auth ? account.auth.over_time == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
				</div>
				<div class="col-sm-6 col-md-3">
					<icheck id="official_travel" :checked="account.auth ? account.auth.official_travel == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
				</div>
				<div class="col-sm-6 col-md-3">
					<icheck id="mutation" :checked="account.auth ? account.auth.mutation == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
				</div>
				<div class="col-sm-6 col-md-3">
					<icheck id="payroll" :checked="account.auth ? account.auth.payroll == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
				</div>
				<div class="col-sm-6 col-md-3">
					<icheck id="account" :checked="account.auth ? account.auth.account == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
				</div>
				<div class="col-sm-6 col-md-3">
					<icheck id="leave_period" :checked="account.auth ? account.auth.leave_period == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
				</div>
				<div class="col-sm-6 col-md-3">
					<icheck id="announcement" :checked="account.auth ? account.auth.announcement == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
	computed : {
		...mapGetters([
			'account'
			])
	}
}
</script>