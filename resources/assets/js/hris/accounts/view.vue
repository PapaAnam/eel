<template>
	<div class="row">
		<div class="col-md-12">
			<export-btn :url="exportUrl"></export-btn>
		</div>
		<div class="col-md-12">
			<table class="table bordered border striped sub_departments" id="datatable">
				<thead>
					<tr>
						<th width="10px">#</th>
						<th>Username</th>
						<th>Level</th>
						<th width="150px">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(s, index) in accounts">
						<td>{{ ++index }}</td>
						<td>{{ s.username }}</td>
						<td>{{ s.level_name }}</td>
						<td>
							<edit-btn @click.native="edit(s.id)"></edit-btn>
							<hapus-btn @click.prevent.native="hapusAccount(s.id)"></hapus-btn>
							<router-link @click.prevent.native="detail(s.id)" :to="'/accounts/detail/' + s.id">
								<detail-btn></detail-btn>
							</router-link>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>
<script>
	import { mapGetters, mapActions } from 'vuex'
	export default {
		data(){
			return {
				exportUrl : base_url('/accounts')
			}
		},
		computed : {
			...mapGetters([
				'accounts'
				])
		},
		methods : {
			...mapActions([
				'getAccounts', 'hapusAccount'
				]),
			edit(id){
				this.$router.push('accounts/edit/'+id)
			},
			detail(id){
				this.$store.state.accountEditable = {
					status : true,
					id
				}
			}
		},
		watch : {
			accounts(val){
				setDatatable()
				setTimeout(() => {
					$('.mac-preloader').fadeOut('slow')
				}, 1500)
				fadeOutPreloader()
			// console.log(val)
		}
	},
	created(){
		this.getAccounts() 
		this.$store.state.accountEditable = {
			status : false,
			id : null
		}
	}
}
</script>