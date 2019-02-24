<template>
	<div class="mac">
		<mac-header title="Detail Account" icon="fa fa-user-circle-o mif-ani-float"></mac-header>
		<div class="mac-content">
			<router-link to="/accounts">
				<batal-btn></batal-btn>
			</router-link>
			<div class="row">
				<div class="col-md-8">
					<div class="panel panel-default">
						<div class="panel-heading">
							Authority
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered table-striped">
										<tbody>
											<tr>
												<td><strong>Department</strong></td>
												<td>{{ accessed(account ? account.auth.department : '') }}</td>
												<td><strong>Sub Department</strong></td>
												<td>{{ accessed(account ? account.auth.sub_department : '') }}</td>
											</tr>
											<tr>
												<td><strong>Positions</strong></td>
												<td>{{ accessed(account ? account.auth.position : '') }}</td>
												<td><strong>Employees</strong></td>
												<td>{{ accessed(account ? account.auth.employee : '') }}</td>
											</tr>
											<tr>
												<td><strong>Salary Rule</strong></td>
												<td>{{ accessed(account ? account.auth.salary_rule : '') }}</td>
												<td><strong>Special Day</strong></td>
												<td>{{ accessed(account ? account.auth.special_day : '') }}</td>
											</tr>
											<tr>
												<td><strong>Manage Attendance</strong></td>
												<td>{{ accessed(account ? account.auth.attendance : '') }}</td>
												<td><strong>Over Time</strong></td>
												<td>{{ accessed(account ? account.auth.over_time : '') }}</td>
											</tr>
											<tr>
												<td><strong>Oficial Travel</strong></td>
												<td>{{ accessed(account ? account.auth.official_travel : '') }}</td>
												<td><strong>Mutations</strong></td>
												<td>{{ accessed(account ? account.auth.mutation : '') }}</td>
											</tr>
											<tr>
												<td><strong>Payroll</strong></td>
												<td>{{ accessed(account ? account.auth.payroll : '') }}</td>
												<td><strong>Accounts</strong></td>
												<td>{{ accessed(account ? account.auth.account : '') }}</td>
											</tr>
											<tr>
												<td><strong>Leave Period</strong></td>
												<td>{{ accessed(account ? account.auth.leave_period : '') }}</td>
												<td><strong>Announcements</strong></td>
												<td>{{ accessed(account ? account.auth.announcement : '') }}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="panel panel-default">
						<div class="panel-heading">Account</div>
						<div class="panel-body">
							<ul>
								<li>Username : {{ account.username }}</li>
								<li>Level : {{ account.level_name }}</li>
								<li>Staff : {{ account.emp ? (account.emp.nin  + ' - ' + account.emp.name) : '' }}</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="mac-footer"></div>
	</div>
</template>

<script>
import { mapGetters } from 'vuex'
export default{
	methods : {
		accessed(val){
			return val == 1 ? 'authorized' : 'not authorized'
		}
	},
	computed : {
		...mapGetters([
			'account'
			])
	},
	created(){
		this.$store.dispatch('getAccount', this.$route.params.id)
	},
	mounted(){
		this.$store.dispatch('showView')
	}
}
</script>