<template>
	<div class="mac">
		<mac-header :title="$store.getters.modul.salaryGroup.title" :icon="$store.getters.modul.salaryGroup.icon"></mac-header>
		<div class="mac-content">
			<div class="row">
				<div class="col-md-12">
					<btn-primary text="New" v-if="!isNew" @click="isNew = true"></btn-primary>
					<batal-btn v-else @click="cancel"></batal-btn>
					<!-- <export-btn :url="exportUrl"></export-btn> -->
				</div>
				<div class="col-md-12" v-if="isNew">
					<niu @refresh="get" :editable="editable" :data="sg"></niu>
				</div>
				<div class="col-md-12">
					<!-- <my-dt :data="salaryGroups"> -->
						<my-table>
							<thead>
								<tr>
									<th width="10px">#</th>
									<th>Name</th>
									<th>Basic Salary</th>
									<th>Allowance</th>
									<th>OT Reg</th>
									<th>OT Hol</th>
									<th>Inc</th>
									<th>Food Al</th>
									<th>Rent Mot</th>
									<th>Retention</th>
									<th>Tax Ins</th>
									<th>Seguranca</th>
									<th>Cash W</th>
									<th>Absent</th>
									<th>THR</th>
									<th>ETC</th>
									<th width="150px">Action</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(s, index) in salaryGroups">
									<td>{{ ++index }}</td>
									<td>{{ s.name }}</td>
									<td v-if="s.basic_salary == 1" style="color: green;">V</td>
									<td v-else style="color: red;">X</td>
									<td v-if="s.allowance == 1" style="color: green;">V</td>
									<td v-else style="color: red;">X</td>
									<td v-if="s.ot_regular == 1" style="color: green;">V</td>
									<td v-else style="color: red;">X</td>
									<td v-if="s.ot_holiday == 1" style="color: green;">V</td>
									<td v-else style="color: red;">X</td>
									<td v-if="s.incentive == 1" style="color: green;">V</td>
									<td v-else style="color: red;">X</td>
									<td v-if="s.food_allowance == 1" style="color: green;">V</td>
									<td v-else style="color: red;">X</td>
									<td v-if="s.rent_motorcycle == 1" style="color: green;">V</td>
									<td v-else style="color: red;">X</td>
									<td v-if="s.retention == 1" style="color: green;">V</td>
									<td v-else style="color: red;">X</td>
									<td v-if="s.tax_insurance == 1" style="color: green;">V</td>
									<td v-else style="color: red;">X</td>
									<td v-if="s.seguranca_social == 1" style="color: green;">V</td>
									<td v-else style="color: red;">X</td>
									<td v-if="s.cash_withdrawal == 1" style="color: green;">V</td>
									<td v-else style="color: red;">X</td>
									<td v-if="s.absent == 1" style="color: green;">V</td>
									<td v-else style="color: red;">X</td>
									<td v-if="s.thr == 1" style="color: green;">V</td>
									<td v-else style="color: red;">X</td>
									<td v-if="s.etc == 1" style="color: green;">V</td>
									<td v-else style="color: red;">X</td>
									<td>
										<edit-btn @click.native="edit(s.id)"></edit-btn>
										<hapus-btn @click.native="hapus(s.id)"></hapus-btn>
									</td>
								</tr>
							</tbody>
							<!-- </my-dt> -->
						</my-table>
					</div>
				</div>
			</div>
			<div class="mac-footer"></div>
		</div>
	</template>
	<script>
		import { mapGetters, mapActions } from 'vuex'
		import niu from './new'
		export default {
			data(){
				return {
					salaryGroups : [],
					exportUrl : base_url('/salary-group'),
					isNew : false,
					sg : {},
					editable : false,
				}
			},
			methods : {
				get(){
					myaxios('salary-group').then(res=>{
						this.salaryGroups = res.data
					}).catch(err=>{
						handleError(err)
					})
				},
				edit(id){
					this.sg = this.salaryGroups.find((item)=>{
						return item.id == id
					})
					document.getElementsByClassName('mac-content')[0].scrollTo(0,0)
					this.editable = true
					this.isNew = true
				},
				cancel(){
					this.isNew = false
					this.editable = false
				},
				hapus(id){
					if(confirm('Are you sure?')){
						myaxios.post('salary-group/'+id, {
							_method : 'DELETE'
						}).then(res=>{
							successMsg(res.data)
							this.get()
						}).catch(err=>{
							handleError(err)
						})	
					}
				}
			},
			watch : {
				salaryGroups(val){
					setDatatable()
				}
			},
			created(){
				this.get()
			},
			mounted(){
				this.$store.dispatch('showView')
			},
			computed : {
			},
			components : {
				niu
			}
		}
	</script>