<template>
	<window :setting="$store.getters.modul.catalog">
		<b-tabs>
			<b-tab title="Categories" active>
				<my-dt class="mt-2" :data="categories">
					<thead>
						<tr>
							<th width="10px">#</th>
							<th>Name</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(s, index) in categories">
							<td>{{ ++index }}</td>
							<td>{{ s.kategori }}</td>
						</tr>
					</tbody>
				</my-dt>
			</b-tab>
			<b-tab title="Products">
				<my-dt class="mt-2" :data="products">
					<thead>
						<tr>
							<th width="10px">#</th>
							<th>kode</th>
							<th>ManufactureCode</th>
							<th>keterangan</th>
							<th>kategori</th>
							<th>jenis</th>
							<th>merek</th>
							<th>BrgDivisi</th>
							<th>Posting</th>
							<th>Sizes</th>
							<th>aktif</th>
							<th>namagrup</th>
							<th>namasubgrup</th>
							<th>AliasKode</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(s, index) in products">
							<td>{{ ++index }}</td>
							<td>{{ s.Kode }}</td>
							<td>{{ s.ManufactureCode }}</td>
							<td>{{ s.Keterangan }}</td>
							<td>{{ s.Kategori }}</td>
							<td>{{ s.Jenis }}</td>
							<td>{{ s.Merk }}</td>
							<td>{{ s.BrgDivisi }}</td>
							<td>{{ s.Posting }}</td>
							<td>{{ s.Sizes }}</td>
							<td>{{ s.Aktif }}</td>
							<td>{{ s.Grup }}</td>
							<td>{{ s.SubGrup }}</td>
							<td>{{ s.AliasKode }}</td>
						</tr>
					</tbody>
				</my-dt>
			</b-tab>
		</b-tabs>
	</window>
</template>
<script>
	import { mapGetters, mapActions } from 'vuex'
	export default {
		data(){
			return {
				categories : [],
				products : [],
			}
		},
		computed : {

		},
		methods : {
			getCategories(){
				myaxios('categories').then(res=>{
					this.categories = res.data
				}).catch(err=>{
					handleError(err)
				})
			},
			getProducts(){
				myaxios('products').then(res=>{
					this.products = res.data
				}).catch(err=>{
					handleError(err)
				})
			},
			baruBanget(){
				if($(window).width() <= 768){
					$('.mac-content').scrollTop(99999)
				}
			}
		},
		created(){
			this.getCategories()
			this.getProducts()
		},
		mounted(){
			this.$store.dispatch('showView')
		}
	}
</script>