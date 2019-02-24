<template>
	<div class="row mt-2">
		<div class="col-md-12">
			<export-btn :url="exportUrl"></export-btn>
			<b-button size="sm" variant="primary" @click="get">Refresh</b-button>
		</div>
		<div class="col-md-12">
			<my-table>
				<thead>
					<tr>
						<th>NIN</th>
						<th>Name</th>
						<th>Non Active At</th>
						<th>Reason</th>
						<th width="200px">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(s, index) in employees">
						<td>{{ s.nin }}</td>
						<td>{{ s.name }}</td>
						<td>{{ s.non_act_date }}</td>
						<td>{{ s.non_act }}</td>
						<td>
							<hapus-btn @click.prevent.native="hapusEmployee(s.id)"></hapus-btn>
							<router-link :to="'/employees/detail/'+s.id">
								<detail-btn></detail-btn>
							</router-link>
							<a data-role="hint" data-hint-background="bg-white" data-hint-color="fg-black" data-hint-mode="2" data-hint="Activate" data-hint-position="top" @click.prevent="activate(s.id)" class="button fg-black bg-white cycle-button" href="#"><span class="mif-power"></span></a>
							<print-btn text="Print Identity" :href="identityUrl+'/print/'+s.id"></print-btn>
							<pdf-btn text="PDF Identity" :href="identityUrl+'/pdf/'+s.id"></pdf-btn>
							<excel-btn text="Excel Identity" :href="identityUrl+'/excel/'+s.id"></excel-btn>
						</td>
					</tr>
				</tbody>
			</my-table>
		</div>
	</div>
</template>
<script>
	import { mapGetters, mapActions } from 'vuex'
	export default {
		data(){
			return {
				exportUrl : base_url('/employees'),
				identityUrl : base_url('/employees/identity'),
				employees : [],
			}
		},
		computed : {
			...mapGetters([
				'employeeEditable'
				])
		},
		watch : {
			
		},
		methods : {
			get(){
				myaxios('employees/non-active').then(res=>{
					this.employees = res.data
				}).catch(err=>{
					handleError(err)
				})
			},
			...mapActions([
				'getNonActiveEmployees', 'hapusEmployee', 'activate'
				]),
			edit(id){
				this.$store.state.employeeEditable = {
					status : true,
					id
				}
			},
			nonActivate(id){
				this.$store.state.employeeEditable = {
					status : true,
					id
				}
			}
		},
		created(){
			this.get()
		}
	}
</script>