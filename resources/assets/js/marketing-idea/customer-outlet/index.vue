<template>
	<window :setting="$store.getters.modul.customerOutlet">
		<b-card no-body>
			<b-tabs pills card v-model="tabAktif">
				<b-tab title="Data" active>
					<my-dt class="mt-2" :data="outlets" :delay="500">
						<thead>
							<tr>
								<th width="10px">#</th>
								<th>Outlet Code</th>
								<th>Outlet Name</th>
								<th>Address</th>
								<th>District</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(s, index) in outlets">
								<td>{{ ++index }}</td>
								<td>{{ s.outlet_code }}</td>
								<td>{{ s.outlet_name }}</td>
								<td>{{ s.address }}</td>
								<td>{{ s.district }}</td>
								<td>
									<tombol-ubah @click="onUbah(s.id)"></tombol-ubah>
									<tombol-detail @click="onDetail(s.id)"></tombol-detail>
								</td>
							</tr>
						</tbody>
					</my-dt>
				</b-tab>
				<b-tab title="New">
					<new-outlet @refresh="getData"></new-outlet>
				</b-tab>
				<b-tab title="Edit">
					<new-outlet @refresh="getData" :ubah="true" :data-ubah="dataUbah"></new-outlet>
				</b-tab>
				<b-tab title="Detail">
					<detail-outlet :ready="mapReady" @ubah="onUbah" :data-detail="dataUbah"></detail-outlet>
				</b-tab>
			</b-tabs>
		</b-card>
	</window>
</template>
<script>
	import { mapGetters, mapActions } from 'vuex'
	import newOutlet from './new'
	import detailOutlet from './detail'
	export default {
		data(){
			return {
				outlets : [],
				dataUbah : {},
				isEdit : false,
				tabAktif : 0,
				mapReady : false,
			}
		},
		computed : {

		},
		methods : {
			getData(){
				myaxios('marketing-idea/customer-outlet').then(res=>{
					this.outlets = res.data
				}).catch(err=>{
					handleError(err)
				})
			},
			onUbah(id){
				myaxios('marketing-idea/customer-outlet/'+id).then(res=>{
					this.dataUbah = res.data
				}).catch(err=>{
					handleError(err)
				})
				this.isEdit = true
				this.tabAktif = 2
			},
			onDetail(id){
				myaxios('marketing-idea/customer-outlet/'+id).then(res=>{
					this.dataUbah = res.data
				}).catch(err=>{
					handleError(err)
				})
				this.tabAktif = 3
				this.mapReady = true
			}
		},
		created(){
			this.getData()
		},
		mounted(){
			this.$store.dispatch('showView')
		},
		components : {
			newOutlet,
			detailOutlet
		}
	}
</script>