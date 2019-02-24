export default {

	SET_ACTIVE_USER(s, ACTIVE_USER){
		s.ACTIVE_USER = ACTIVE_USER
	},

	SET_APP_TITLE(s, APP_TITLE){
		s.APP_TITLE = APP_TITLE
	},

	SET_ANIMATION(s, animation){
		if(animation == 1){
		}
	},

	SET_ACTIVE_WINDOW(s, activeWindow){
		s.activeWindow = activeWindow
	},
	SET_BG_TILES(s, bgTiles){
		s.bgTiles = bgTiles
		s.modul.catalog.bgTile = bgTiles.catalog
		s.modul.maps.bgTile = bgTiles.maps
		s.modul.customerOutlet.bgTile = bgTiles.customerOutlet
	},

}