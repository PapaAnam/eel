export default {

	SET_ACTIVE_WINDOW(s, activeWindow){
		s.activeWindow = activeWindow
	},
	SET_BG_TILES(s){
		let forbidden = ['bg-white', 'bg-grayLighter']
		_.forEach(s.moduls, (item, key) => {
			_.forEach(item.content, (it, k) => {
				let b = () => {
					let bg = colors.getBgRandom()
					if(forbidden.indexOf(bg) > -1)
						return b()
					return bg
				}
				it.bg = b()
			})
		})
	},

	// DRIVER MODUL
	SET_DRIVERS(s, DRIVERS){
		s.DRIVERS = DRIVERS
	},
	SET_SALES(s, SALES){
		s.SALES = SALES
	},
	SET_SALES_ORDER(s, SALES_ORDER){
		s.SALES_ORDER = SALES_ORDER
	},
	SET_SALES_ORDER_RESULT(s, SALES_ORDER_RESULT){
		s.SALES_ORDER_RESULT = SALES_ORDER_RESULT
	},
	SET_PROCESSING(s, PROCESSING){
		s.PROCESSING = PROCESSING
	},
	SET_MY_WINDOW(s, modul){
		if(typeof modul == 'string'){
			_.forEach(s.moduls, (item, key) => {
				_.forEach(item.content, (it, k) => {
					if(k == modul){
						s.MY_WINDOW = it
					}
				})
			})	
		}else{
			s.MY_WINDOW = modul
		}
	}
}