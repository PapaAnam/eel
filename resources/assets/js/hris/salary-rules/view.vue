<template>
	<div class="row">
		<div class="col-md-12">
			<export-btn :url="exportUrl"></export-btn>
		</div>
		<div class="col-md-12">
			<div class="alert alert-info" v-if="processing">
				Processing
			</div>
			<div v-else>
				<!-- showing salary rule for {{ salaryRules.employee.name }} -->
				{{ title }}
				<div class="table-responsive">
					<table class="table bordered border striped salary_rules" id="datatable">
						<thead>
							<tr>
								<th width="10px">#</th>
								<th>Name</th>
								<th>Department</th>
								<th>Job Title</th>
								<th>Basic Salary</th>
								<th>Allowance</th>
								<th>Incentive</th>
								<th>Food Allowance</th>
								<th>Retention</th>
								<th>Etc</th>
								<th>THR</th>
								<th v-if="segurancaManual">Seguranca Social</th>
								<th>Cash Witdrawal</th>
								<th>Rent Motorcycle</th>
								<th>Out At Rule</th>
								<th>Salary Group</th>
								<th>Salary Type</th>
								<th>Month</th>
								<th>Created</th>
								<th>Status</th>
								<th>User</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(s, index) in data">
								<td>{{ ++index }}</td>
								<td>{{ s.emp ? s.emp.name : '' }}</td>
								<td>{{ s.emp ? s.emp.dep.name : '' }}</td>
								<td>{{ s.emp ? s.emp.pos.name : '' }}</td>
								<td>{{ s.basic_salary }}</td>
								<td>{{ s.allowance }}</td>
								<td>{{ s.incentive }}</td>
								<td>{{ s.eat_cost }}</td>
								<td>{{ s.ritation }}</td>
								<td>{{ s.etc }}</td>
								<td>{{ s.thr }}</td>
								<td v-if="segurancaManual">{{ s.seguranca }}</td>
								<td>{{ s.cash_receipt }}</td>
								<td>{{ s.rent_motorcycle }}</td>
								<td>{{ s.out_at_rule }}</td>
								<td>{{ s.salary_group ? s.salary_group.name : '' }}</td>
								<td>{{ s.salary_type }}</td>
								<td>{{ s.month_name }}</td>
								<td>{{ s.created_at }}</td>
								<td v-if="s.status == 1" style="color: green;">Active</td>
								<td v-else style="color: orange;">Last updated</td>
								<td>{{ s.user ? s.user.username : '' }}</td>
								<td width="150px">
									<a class="btn btn-sm btn-danger" data-role="hint" data-hint-background="bg-danger" data-hint-color="fg-white" href="#" data-hint-mode="2" data-hint="Edit Salary" data-hint-position="top" size="sm" variant="danger" @click.prevent="$emit('edit', 2)"><i class="fa fa-pencil"></i></a>
									<a data-role="hint" data-hint-background="bg-primary" data-hint-color="fg-white" href="#" data-hint-mode="2" data-hint="Edit Component Salary" data-hint-position="top" class="btn btn-sm btn-primary" @click.prevent="$emit('edit', 1)"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</template>
<script>
	import { mapGetters, mapActions } from 'vuex'
	export default {
		data(){
			return {
				exportUrl : base_url('/salary-rules')
			}
		},
		props : ['data', 'title', 'segurancaManual', 'processing'],
		computed : {
			...mapGetters([
				'salaryRules'
				])
		},
		methods : {
			...mapActions([
				'getPositions', 'hapusPosition'
				]),
			edit(id){
				this.$store.state.positionEditable = {
					status : true,
					id
				}
			}
		},
		watch : {
			data(val){
				if(val.length > 1){
					setTimeout(()=>{
						$('#datatable').DataTable()
					}, 1000)
				}
			}
		},
		created(){
		},
		mounted(){
		}
	}
</script>