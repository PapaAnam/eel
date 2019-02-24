export default {
	bgTiles(s){
		return s.bgTiles
	},
	icons(s){
		return s.icons
	},
	drivers(s){
		return s.DRIVERS
	},
	sales(s){
		return s.SALES
	},
	salesOrder(s){
		return s.SALES_ORDER
	},
	salesOrderResult(s){
		return s.SALES_ORDER_RESULT
	},
	salesOrderInProcess(s){
		return _.filter(s.SALES_ORDER_RESULT, (item) => {
			return item.Status == 'Proses Kirim'
		})
	},
	processing(s){
		return s.PROCESSING
	},
	myWindow(s){
		return s.MY_WINDOW
	},
	moduls(s){
		return s.moduls
	}
}