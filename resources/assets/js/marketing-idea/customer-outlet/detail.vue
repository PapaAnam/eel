<template>
	<div>
		<my-table>
			<tbody>
				<tr>
					<td>Outlet Code</td>
					<td>{{ data.outlet_code }}</td>
					<td>Outlet Name</td>
					<td>{{ data.outlet_name }}</td>
				</tr>
				<tr>
					<td>Address</td>
					<td>{{ data.address }}</td>
					<td>District</td>
					<td>{{ data.district }}</td>
				</tr>
				<tr>
					<td>Phone Number</td>
					<td>{{ data.phone_number }}</td>
					<td>Contact Person</td>
					<td>{{ data.contact_person }}</td>
				</tr>
				<tr>
					<td>Segment</td>
					<td>{{ data.segment }}</td>
					<td>Salesman</td>
					<td>{{ data.salesman }}</td>
				</tr>
				<tr>
					<td>Division</td>
					<td>{{ data.division }}</td>
					<td>Latitude</td>
					<td>{{ data.latitude }}</td>
				</tr>
				<tr>
					<td>Longitude</td>
					<td>{{ data.longitude }}</td>
					<td>Icon</td>
					<td><img :src="data.icon" :alt="data.outlet_name"></td>
				</tr>
				<tr>
					<td>Action</td>
					<td>
						<tombol-ubah @click="ubah(data.id)"></tombol-ubah>
					</td>
				</tr>
			</tbody>
		</my-table>
		<div id="map" style="width:100%;height:400px;"></div>
	</div>
</template>

<script>
	import { mapActions } from 'vuex'
	export default{
		data(){
			return {
				data : {
					outlet_code:'',
					outlet_name:'',
					address:'',
					district:'',
					phone_number:'',
					contact_person:'',
					segment:'',
					salesman:'',
					division:'',
					latitude:'',
					longitude:'',
				},
			}
		},
		props : {
			dataDetail : {
				type : Object
			},
			ready : {
				default : false,
			}
		},
		mounted(){
		},
		methods : {
			ubah(id){
				if(id){
					this.$emit('ubah',this.data.id)
				}else{
					alert('choose data first')
				}
			}
		},
		watch : {
			dataDetail(newValue){
				this.ready = true
				this.data = newValue
				if(this.ready){
					let myLatlng = new google.maps.LatLng(this.data.latitude,this.data.longitude);
					let mapOptions = {
						zoom: 15,
						center: myLatlng,
						disableDefaultUI: true
					};

					let map = new google.maps.Map(document.getElementById('map'), mapOptions);

					let contentString = '<div id="content">'+
					'<div id="siteNotice"></div>'+
					'<h1 id="firstHeading" class="firstHeading">'+this.data.outlet_name+'</h1>'+
					'<div id="bodyContent">'+
					'<p>'+this.data.address+'</p>'+
					'<p>Outlet Code : '+this.data.outlet_code+'</p>'+
					'</div>'+
					'</div>';

					let infowindow = new google.maps.InfoWindow({
						content: contentString
					});

					let marker = new google.maps.Marker({
						position: myLatlng,
						map: map,
						title: 'Maps Info',
						icon:this.data.icon
					});
					google.maps.event.addListener(marker, 'click', function() {
						infowindow.open(map,marker);
					})
				}
			}
		},
		created(){
		}
	}
</script>