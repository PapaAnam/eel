<template>
	<div class="mac">
		<mac-header title="Detail Account" icon="fa fa-user-circle-o mif-ani-float"></mac-header>
		<div class="mac-content">
			<router-link to="/accounts">
				<batal-btn></batal-btn>
			</router-link>
			<div class="row">
				<div class="col-md-8">
					<my-card title="Authority">
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered table-striped">
									<tbody>
										<tr>
											<td><strong>Department</strong></td>
											<td>{{ accessed(account ? account.auth.department : '') }}</td>
											<td><strong>Leave Period</strong></td>
											<td>{{ accessed(account ? account.auth.leave_period : '') }}</td>
											<!-- <td><strong>Sub Department</strong></td> -->
											<!-- <td>{{ accessed(account ? account.auth.sub_department : '') }}</td> -->
										</tr>
										<tr>
											<td><strong>Job Title</strong></td>
											<td>{{ accessed(account ? account.auth.job_title : '') }}</td>
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
											<td><strong>Salary Group</strong></td>
											<td>{{ accessed(account ? account.auth.salary_group : '') }}</td>
											<td><strong>Cash Withdrawal</strong></td>
											<td>{{ accessed(account ? account.auth.cash_withdrawal : '') }}</td>
										</tr>
										<tr>
											<td><strong>Always Presence</strong></td>
											<td>{{ accessed(account ? account.auth.always_presence : '') }}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</my-card>
				</div>
				<div class="col-sm-4">
					<my-card title="Account">
						<my-table>
							<tbody>
								<tr>
									<td>Username</td>
									<td>{{ account.username }}</td>
								</tr>
								<tr>
									<td>Level</td>
									<td>{{ account.level_name }}</td>
								</tr>
								<!-- <tr>
									<td>Staff</td>
									<td>{{ account.emp ? (account.emp.nin  + ' - ' + account.emp.name) : '' }}</td>
								</tr> -->
							</tbody>
						</my-table>
					</my-card>
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
		$('.hint2').hide()
	}
}
</script>