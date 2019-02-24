<template>
	<window :setting="$store.getters.modul.maps">
		<div id="map" style="width:100%;height:100%;"></div>
	</window>
</template>
<script>
	import { mapGetters, mapActions } from 'vuex'
	export default {
		data(){
			return {
				outletLocations : [],
			}
		},
		computed : {

		},
		methods : {
			
		},
		watch : {
			outletLocations(){
				function initialize() {

					let mapOptions = {   
						zoom: 8,
						center: new google.maps.LatLng(-7.9812985, 112.6319264), 
						disableDefaultUI: true
					};

					let mapElement = document.getElementById('map');

					let map = new google.maps.Map(mapElement, mapOptions);

					setMarkers(map, outletLocations);

				}

				let outletLocations = this.outletLocations

				function setMarkers(map, locations)
				{
					let globalPin = 'storage/customer-outlet/05vr9UD8LgSJKeeFuKMkQ8ZpcRf5xXsQ8j6yWLAL.jpeg';

					for (let i = 0; i < locations.length; i++) {

						let outlet = locations[i];
						let myLatLng = new google.maps.LatLng(outlet.latitude, outlet.longitude);
						let infowindow = new google.maps.InfoWindow({content: contentString});

						let contentString = 
						'<div id="content">'+
						'<div id="siteNotice">'+
						'</div>'+
						'<h5 id="firstHeading" class="firstHeading">'+ outlet.outlet_name + '</h5>'+
						'<div id="bodyContent">'+ 
						'<p>'+outlet.address+'</p>'+
						'Outlet Code : '+outlet.outlet_code+
						'</div>'+
						'</div>';

						let marker = new google.maps.Marker({
							position: myLatLng,
							map: map,
							title: outlet[1],
							icon:outlet.icon
						});

						google.maps.event.addListener(marker, 'click', getInfoCallback(map, contentString));
					}
				}

				function getInfoCallback(map, content) {
					let infowindow = new google.maps.InfoWindow({content: content});
					return function() {
						infowindow.setContent(content); 
						infowindow.open(map, this);
					};
				}

				initialize();
			}
		},
		created(){
			myaxios('marketing-idea/customer-outlet').then(res=>{
				this.outletLocations = res.data
			})
		},
		mounted(){
			this.$store.dispatch('showView')
			
		}
	}
</script>