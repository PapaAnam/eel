<template>
	<hris-mac :setting="$store.getters.modul.cashWithdrawal">
		<b-tabs>
			<b-tab title="Data" active>
				<my-dt class="mt-2" :data="cashWithdrawals">
					<thead>
						<tr>
							<th width="10px">#</th>
							<th>NIN</th>
							<th>Applicant</th>
							<th>Total</th>
							<th>Installment</th>
							<th>Created At</th>
							<th>Manager</th>
							<th width="150px">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(s, index) in cashWithdrawals">
							<td>{{ ++index }}</td>
							<td>{{ s.applicant.nin }}</td>
							<td>{{ s.applicant.name }}</td>
							<td>{{ s.total }}</td>
							<td>{{ s.installment }}</td>
							<td>{{ s.created_at }}</td>
							<td>{{ s.manager.name }}</td>
							<td>
								<edit-btn @click.native="edit(s.id)"></edit-btn>
								<hapus-btn @click.native="hapus(s.id)"></hapus-btn>
								<!-- <print-btn no-label :link="printLink(s.id)"></print-btn> -->
							</td>
						</tr>
					</tbody>
				</my-dt>
			</b-tab>
			<b-tab title="New" >
				<niu class="mt-2" @refresh="get"></niu>
			</b-tab>
		</b-tabs>
	</hris-mac>
</template>
<script>
	import { mapGetters, mapActions } from 'vuex'
	import niu from './new'
	export default {
		data(){
			return {
				cashWithdrawals : [],
				exportUrl : base_url('/cash-withdrawal'),
				isNew : false,
				sg : {},
				editable : false,
			}
		},
		methods : {
			get(){
				myaxios('cash-withdrawal').then(res=>{
					this.cashWithdrawals = res.data
				}).catch(err=>{
					handleError(err)
				})
			},
			edit(id){
				this.sg = this.cashWithdrawals.find((item)=>{
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
					myaxios.post('cash-withdrawal/'+id, {
						_method : 'DELETE'
					}).then(res=>{
						successMsg(res.data)
						this.get()
					}).catch(err=>{
						handleError(err)
					})	
				}
			},
			printLink(id){
				return base_url('/cash-withdrawal/print-form/'+id)
			}
		},
		watch : {
			cashWithdrawals(val){
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