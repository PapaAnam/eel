<template>
	<my-card title="Authority">
		<div class="row">
			<div class="col-sm-6">
				<icheck id="check-all" label="Check All"></icheck>
				<!-- <iradio @check="checkAll" id="check-all" label="Check All"></iradio> -->
			</div>
			<!-- <div class="col-sm-6">
				<iradio @uncheck="uncheckAll" id="uncheck-all" label="Uncheck All"></iradio>
			</div> -->
		</div>
		<hr>
		<div class="row" id="check-menu">
			<div class="col-sm-6 col-md-3">
				<icheck id="department" :checked="account.auth ? account.auth.department == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
			</div>
			<!-- <div class="col-sm-6 col-md-3">
				<icheck id="sub_department" :checked="account.auth ? account.auth.sub_department == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
			</div> -->
			<div class="col-sm-6 col-md-3">
				<icheck label="Job Title" id="job_title" :checked="account.auth ? account.auth.job_title == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
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
				<icheck id="attendance_edit" :checked="account.auth ? account.auth.attendance_edit == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
			</div>
			<div class="col-sm-6 col-md-3">
				<icheck id="attendance_delete" :checked="account.auth ? account.auth.attendance_delete == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
			</div>
			<div class="col-sm-6 col-md-3">
				<icheck id="cash_withdrawal" :checked="account.auth ? account.auth.cash_withdrawal == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
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
				<icheck id="salary_group" :checked="account.auth ? account.auth.salary_group == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
			</div>
			<div class="col-sm-6 col-md-3">
				<icheck id="always_presence" :checked="account.auth ? account.auth.always_presence == 1 : false" :delay="account.auth ? 1000 : 0" value="1"></icheck>
			</div>
		</div>
	</my-card>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
	methods : {
		// uncheckAll(){
		// 	$('#check-menu').find('[type="checkbox"]').iCheck('uncheck')
		// 	$('#check-all').iCheck('uncheck')
		// },
		// checkAll(){
		// 	$('#check-menu').find('[type="checkbox"]').iCheck('check')
		// 	$('#uncheck-all').iCheck('uncheck')
		// }
	},
	computed : {
		...mapGetters([
			'account'
			])
	},
	watch : {
		account(val){
			// console.log(val)
		}
	},
	mounted(){
		setTimeout(() => {
			$(this.$el).find('#check-all').on('ifChecked', function(event){
				$('#check-menu').find('[type="checkbox"]').iCheck('check');
			});
			$(this.$el).find('#check-all').on('ifUnchecked', function(event){
				$('#check-menu').find('[type="checkbox"]').iCheck('uncheck');
			});
		}, 2000)
	}
}
</script>