export default {
	
	save(c, param){
		resetAllError()
		axios.post(param[0], param[1]).then(res=>{
			successMsg(res.data)
			resetForm('#add-form')
			if(param[2])
				c.dispatch(param[2])
		}).catch(err=>{
			handleError(err, '#add-form')
		})
	},

	// metode hapus
	hapus(c, param){
		let con = confirm('Are you sure?')
		if(con){
			axios.delete(param[0]).then((res) => {
				successMsg(res.data)
				c.dispatch(param[1])
			}).catch((err) => {
				handleError(err)
			})
		}
	},
	delete(c, param){
		let con = confirm('Are you sure?')
		let fd = new FormData()
		fd.append('_method', 'DELETE')
		if(con){
			axios.post(param[0], fd).then((res) => {
				successMsg(res.data)
				if(param[1])
					c.dispatch(param[1])
			}).catch((err) => {
				handleError(err)
			})
		}
	},
	// metode refresh
	refresh(c, param){
		c.dispatch(param[0]).then(()=>{
			$('#datatable').DataTable().destroy()
			setTimeout(()=>{
				$('#datatable').DataTable()
			},2000)
		})
	},
	update(c, param){
		const config = { headers: { 'Content-Type': 'multipart/form-data' }}
		param[1].append('_method', 'put')
		axios.post(param[0], param[1], config).then(res=>{
			successMsg(res.data)
			if(param[2])
				c.dispatch(param[2])
		}).catch(err=>{
			handleError(err, '#edit-form')
		})
	},

	// metode ambil semua data
	getData(c, param){
		c.commit('SET_PROCESSING', true)
		c.commit(param.mutation, param.default ? param.default : [])
		axios(param.url).then(res=>{
			c.commit('SET_PROCESSING', false)
			c.commit(param.mutation, res.data)
		}).catch(err=>{
			c.commit('SET_PROCESSING', false)
			handleError(err)
			// c.dispatch('getData', param)
		})
	},

	getDrivers(c){
		c.dispatch('getData', {
			url : 'drivers',
			mutation : 'SET_DRIVERS',
		})
	},
	getAllSales(c){
		c.dispatch('getData', {
			url : 'sales',
			mutation : 'SET_SALES',
		})
	},
	getAllDrivers(c){
		c.dispatch('getData', {
			url : 'all-drivers',
			mutation : 'SET_DRIVERS',
		})
	},
	getSalesOrder(c, driver){
		c.dispatch('getData', {
			url : 'sales-order/'+driver,
			mutation : 'SET_SALES_ORDER',
		})
	},
	getSoResult(c){
		c.dispatch('getData', {
			url : 'sales-order/result',
			mutation : 'SET_SALES_ORDER_RESULT',
		})
	}
}