<template>
	<hris-mac :setting="$store.getters.modul.alwaysPresence">
		<b-tabs>
			<b-tab title="Data" active>
				<a v-b-modal.modal1 href="#" class="btn btn-primary mt-2 float-right mb-2 text-white">Add Location</a>
				<my-dt class="mt-2" :data="locations">
					<thead>
						<tr>
							<th width="10px">#</th>
							<th>Name</th>
							<th>Lat</th>
							<th>Long</th>
							<th width="150px">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(s, index) in locations">
							<td>{{ ++index }}</td>
							<td>{{ s.name }}</td>
							<td>{{ s.latitude }}</td>
							<td>{{ s.longitude }}</td>
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
		<b-modal hide-footer size="lg" id="modal1" title="Add Location">
			<div style="height: 400px; width: 100%;" id="map"></div>
			<center>
				<button class="btn btn-primary mt-2" @click.prevent="loadMap">Reload Map</button>
			</center>
			<form action="" @submit.prevent="save">
				<div class="form-group">
					<label for="name">Location Name</label>
					<input type="text" class="form-control" placeholder="Location Name" id="name" v-model="location.name">
					<input type="hidden" id="north">
					<input type="hidden" id="east">
					<input type="hidden" id="south">
					<input type="hidden" id="west">
				</div>
				<input type="text" id="selatanBarat">
				<button type="submit">{{ saving ? 'Saving' : 'Save' }}</button>
			</form>
		</b-modal>
	</hris-mac>
</template>
<script>
	import { mapGetters, mapActions } from 'vuex'
	import niu from './new'
	export default {
		data(){
			return {
				locations : [],
				exportUrl : base_url('/cash-withdrawal'),
				isNew : false,
				sg : {},
				editable : false,
				location : {
					name : null,
				},
				saving : false,
				showLoadMap : false,
			}
		},
		methods : {
			loadMap(){
				this.showLoadMap = false
				this.initMap()
			},
			save(){
				if(!this.saving){
					this.saving = true
					this.location.north = document.getElementById('north').value
					this.location.east = document.getElementById('east').value
					this.location.south = document.getElementById('south').value
					this.location.west = document.getElementById('west').value
					myaxios.post('hris/always-presence/location',this.location).then(res=>{
						this.saving = false
						console.log(res.data)
					}).catch(err=>{
						this.saving = false
						handleError(err)
					})
				}
			},
			get(){
				myaxios('hris/always-presence/location').then(res=>{
					this.locations = res.data
				}).catch(err=>{
					handleError(err)
				})
			},
			edit(id){
				this.sg = this.locations.find((item)=>{
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
			},
			initMap(){
				if(window.google.maps === undefined)
					this.showLoadMap = true
				else{
					let map = new window.google.maps.Map(document.getElementById('map'), {
						zoom: 15,
						center: {lat: -8.165456, lng: 113.717203},
						mapTypeId: 'terrain'
					});

					let rectangle = new window.google.maps.Rectangle({
						strokeColor: '#005555',
						strokeOpacity: 0.8,
						editable : true,
						draggable : true,
						strokeWeight: 2,
						fillColor: '#005555',
						fillOpacity: 0.20,
						map: map,
						bounds: {
							north: -8.157509,
							east: 113.722543,
							south: -8.169758,
							west: 113.711601,
						}
					});
					let vm = this
					window.google.maps.event.addListener (rectangle, "bounds_changed", function() {
						let ne = rectangle.getBounds().getNorthEast()
						let sw = rectangle.getBounds().getSouthWest()
						document.getElementById('north').value = ne.lat();
						document.getElementById('east').value = ne.lng();
						document.getElementById('south').value = sw.lat();
						document.getElementById('west').value = sw.lng();
					})
					let ne2 = rectangle.getBounds().getNorthEast()
					let sw2 = rectangle.getBounds().getSouthWest()
					document.getElementById('north').value 	= ne2.lat();
					document.getElementById('east').value 	= ne2.lng();
					document.getElementById('south').value 	= sw2.lat();
					document.getElementById('west').value 	= sw2.lng();
				}
			}
		},
		watch : {
			locations(val){
				setDatatable()
			}
		},
		created(){
			this.get()
		},
		mounted(){
			this.$store.dispatch('showView')
			this.initMap()
		},
		computed : {
		},
		components : {
			niu
		}
	}
</script>

<style>
#map {
	height: 80%;
}
/*.modal-body {
	height: 600px;
	}*/
</style>