export default {

	setApiToken(c, apiToken){
		c.commit('SET_API_TOKEN', apiToken)
	},

	setActiveWindow(c, param){
		param[1].bg = $(param[0]).find('[data-role="tile"]').css('backgroundColor')
		c.state.activeWindow = param[1]
		// c.commit('SET_ACTIVE_WINDOW', param[1])
	},

	setBgTiles(c){
		let colors = window.colors.slice(0)
		colors = colors.shuffle()
		let bgTiles = {
			department : 'bg-'+colors.pop()+' fg-white',
			employee : 'bg-'+colors.pop()+' fg-white',
			position : 'bg-'+colors.pop()+' fg-white',
			jobTitle : 'bg-'+colors.pop()+' fg-white',
			attendance : 'bg-'+colors.pop()+' fg-white',
			cash : 'bg-'+colors.pop()+' fg-white',
			mutation : 'bg-'+colors.pop()+' fg-white',
			payroll : 'bg-'+colors.pop()+' fg-white',
			specialDay : 'bg-'+colors.pop()+' fg-white',
			account : 'bg-'+colors.pop()+' fg-white',
			officialTravel : 'bg-'+colors.pop()+' fg-white',
			leavePeriod : 'bg-'+colors.pop()+' fg-white',
			salaryRules : 'bg-'+colors.pop()+' fg-white',
			salaryRule : 'bg-'+colors.pop()+' fg-white',
			salaryGroup : 'bg-'+colors.pop()+' fg-white',
			alwaysPresence : 'bg-'+colors.pop()+' fg-white',
		}
		c.commit('SET_BG_TILES', bgTiles)
	},

	// metode ambil semua data
	getData(c, param){
		axios(param[0]).then(res=>{
			c.commit(param[1], res.data)
		}).catch(err=>{
			c.dispatch('getData', param)
		})
	},

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


	// DEPARTMENTS MODUL
	getDepartments(c){
		axios('departments/data').then(res=>{
			c.commit('SET_DEPARTMENTS', res.data)
		}).catch(err=>{
			c.dispatch('getDepartments')
		})
	},
	getAllDepartments(c){
		axios('departments/data/all').then(res=>{
			c.commit('SET_DEPARTMENTS', res.data)
		}).catch(err=>{
			c.dispatch('getAllDepartments')
		})
	},
	getDept(c, id){
		axios('departments/data/'+id).then(res=>{
			c.commit('SET_DEPARTMENT', res.data)
		}).catch(err=>{
			c.dispatch('getDepartment', id)
		})
	},
	saveDept(c, data){
		c.dispatch('save', ['departments/store', data, 'refreshDept'])
	},
	updateDept(c, data){
		c.dispatch('update', ['departments/update/'+c.getters.departmentEditable.id, data, 'refreshDept'])
	},
	refreshDept(c){
		c.dispatch('getDepartments')
		c.dispatch('newDept')
	},
	hapusDept(c, id){
		c.dispatch('delete', ['departments/delete/'+id, 'refreshDept'])
	},
	newDept({commit}){
		$('#name').select2('destroy')
		commit('SET_DEPARTMENT_BARU', {
			id : null, name : ""
		})
		setTimeout(()=>{
			$('#name').select2({
				tags : true
			})
		}, 1000)
	},

	// POSITIONS
	getPositions(c){
		axios('positions/data').then(res=>{
			c.commit('SET_POSITIONS', res.data)
		}).catch(err=>{
			c.dispatch('getPositions')
		})
	},
	getPosition(c, id){
		axios('positions/data/'+id).then(res=>{
			c.commit('SET_POSITION', res.data)
		}).catch(err=>{
			c.dispatch('getPosition', id)
		})
	},
	refreshPosition(c){
		c.dispatch('refresh', ['getPositions'])
	},
	hapusPosition(c, id){
		c.dispatch('hapus', ['positions/delete/'+id, 'refreshPosition'])
	},
	updatePosition(c, data){
		axios.put('positions/update/'+c.state.positionEditable.id, data).then(res=>{
			successMsg(res.data)
			c.dispatch('refreshPosition')
		}).catch(err=>{
			handleError(err, '#edit-form')
		})
	},
	savePosition(c, data){
		let dt;
		let obj = typeof data == 'object'
		$('#datatable').DataTable().destroy()
		if(obj)
			dt = data[0]
		else
			dt = datadata()
		resetAllError()
		axios.post('positions/store', dt).then(res=>{
			successMsg(res.data)
			c.dispatch('refreshPosition')
			if(obj)
				resetForm(data[1])
		}).catch(err=>{
			handleError(err, '#add-form')
		})
	},

	// EMPLOYEES
	getEmployees(c){
		c.dispatch('getData', ['employees/data', 'SET_EMPLOYEES'])
	},
	getNonActiveEmployees(c){
		c.dispatch('getData', ['employees/non-active/data', 'SET_EMPLOYEES'])
	},
	getEmployee(c, id){
		c.dispatch('getData', ['employees/data/'+id, 'SET_EMPLOYEE'])
	},
	refreshEmployee(c){
		c.dispatch('refresh', ['getEmployees'])
	},
	hapusEmployee(c, id){
		c.dispatch('hapus', ['employees/delete/'+id, 'refreshEmployee'])
	},
	updateEmployee(c, data){
		data.append('old_nin', c.state.employee.nin)
		c.dispatch('update', ['employees/update/'+c.state.employeeEditable.id, data, 'refreshEmployee'])
	},
	saveEmployee(c, data){
		let dt;
		let obj = typeof data == 'object'
		$('#datatable').DataTable().destroy()
		if(obj)
			dt = data[0]
		else
			dt = data
		resetAllError()
		axios.post('employees/store', dt).then(res=>{
			successMsg(res.data)
			c.dispatch('refreshEmployee')
			if(obj)
				resetForm(data[1])
		}).catch(err=>{
			handleError(err, '#add-form')
		})
	},
	nonActivate(c, data){
		axios.put('employees/non-activate/'+c.state.employeeEditable.id, data).then(res => {
			successMsg(res.data)
			c.dispatch('refreshEmployee')
		}).catch(err => {
			handleError(err)
		})
	},
	activate(c, id){
		let con = confirm('Are you sure to activate again?')
		if(!con)
			return
		axios.put('employees/activate/'+id).then(res => {
			successMsg(res.data)
			c.dispatch('getNonActiveEmployees')
		}).catch(err => {
			handleError(err)
		})
	},

	// ACCOUNTS
	getAccounts(c){
		c.dispatch('getData', ['accounts/data', 'SET_ACCOUNTS'])
	},
	getAccount(c, id){
		c.dispatch('getData', ['accounts/data/'+id, 'SET_ACCOUNT'])
	},
	refreshAccount(c){
		c.dispatch('refresh', ['getAccounts'])
	},
	hapusAccount(c, id){
		c.dispatch('hapus', ['accounts/delete/'+id, 'refreshAccount'])
	},
	updateAccount(c, data){
		data.append('old_username', c.getters.account.username)
		c.dispatch('update', ['accounts/update/'+c.state.accountsEditable.id, data, 'refreshAccount'])
	},
	saveAccount(c, data){
		c.dispatch('save', ['accounts/store', data, 'refreshAccount'])
	},

	// ATTENDANCES
	getAttendances(c, param = null){
		if(param)
			c.dispatch('getData', ['attendances/data/filter-date/'+param, 'SET_ATTENDANCES'])
		else
			c.dispatch('getData', ['attendances/data', 'SET_ATTENDANCES'])
	},
	getAttendance(c, id){
		c.dispatch('getData', ['attendances/data/'+id, 'SET_ATTENDANCE'])
	},
	refreshAttendance(c){
		c.dispatch('refresh', ['getAttendances'])
	},
	hapusAttendance(c, id){
		c.dispatch('hapus', ['attendances/delete/'+id, 'refreshAttendance'])
	},
	updateAttendance(c, data){
		data.append('old_username', c.getters.attendance.username)
		c.dispatch('update', ['attendances/update/'+c.state.attendanceEditable.id, data, 'refreshAttendance'])
	},
	saveAttendance(c, data){
		c.dispatch('save', ['attendances/store', data, 'refreshAttendance'])
	},
	getX100C(c) {
		c.dispatch('getData', ['attendances/x100c', 'SET_ATTENDANCES'])
	},

	// SPECIAL DAY
	getEvents(c){
		c.dispatch('getData', ['special-day/data', 'SET_EVENTS'])
	},
	getEvent(c){
		let data = _.find(c.getters.events, (o) =>{
			return c.getters.eventEditable.id == o.id
		})
		c.commit('SET_EVENT', data)
	},
	refreshEvent(c){
		c.dispatch('refresh', ['getEvents'])
	},
	saveEvent(c, data){
		c.dispatch('save', ['special-day/store', data, 'refreshEvent'])
	},
	updateEvent(c, data){
		c.dispatch('update', ['special-day/update/'+c.getters.eventEditable.id, data, 'refreshEvent'])
	},

	// SALARY RULES
	getSalaryRule(c, employee){
		c.commit('SET_SALARY_RULES', 'processing')
		c.dispatch('getData', ['salary-rules/data/'+employee, 'SET_SALARY_RULES'])
	},
	saveSalaryRule(c, data){
		c.dispatch('save', ['salary-rules/store', data])
	},

	// OFFICIAL TRAVEL
	getOfficialTravels(c){
		c.dispatch('getData', ['official-travel/data', 'SET_OFFICIAL_TRAVELS'])
	},
	getOfficialTravel(c){
		c.dispatch('getData', ['official-travel/data/'+c.getters.officialTravelEditable.id, 'SET_OFFICIAL_TRAVEL'])
	},
	saveOfficialTravel(c, data){
		c.dispatch('save', ['official-travel/store', data])
	},
	updateOfficialTravel(c, data){
		c.dispatch('update', ['official-travel/update/'+c.getters.officialTravelEditable.id, data])
	},
	hapusOfficialTravel(c, id){
		c.dispatch('hapus', ['official-travel/delete/'+id, 'getOfficialTravels'])
	},


	showView(c){
		$('.mac-view').find('.mac').fadeIn('slow')
	},
	setDt(c, selector){
		if(typeof selector == 'object' ){
			if(timing)
				setTimeout(()=>{
					$(selector).DataTable()
				}, 2000)
			else
				$(selector).DataTable()
		}else{
			setTimeout(()=>{
				$(selector).DataTable()
			}, 2000)
		}

	},

	// DEPRECATED

	//SUB DEPARTMENTS
	getSubDepts(c, deptId){
		if(deptId)
			c.dispatch('getData', ['sub-departments/data/dept/'+deptId, 'SET_SUB_DEPARTMENTS'])
		else
			c.dispatch('getData', ['sub-departments/data', 'SET_SUB_DEPARTMENTS'])
	},
	getSubDept(c, id){
		console.log(getById(c.getters.subDepts, id))
		c.commit('SET_SUB_DEPARTMENT', getById(c.getters.subDepts, id))
	},
	refreshSubDept(c){
		c.dispatch('getSubDepts').then(()=>{
			setTimeout(()=>{
				$('#datatable').DataTable()
			},2000)
		})
	},
	hapusSubDept(c, id){
		c.dispatch('hapus', ['sub-departments/delete/'+id, 'refreshSubDept'])
	},
	updateSubDept(c, data){
		axios.put('sub-departments/update/'+c.state.subDeptEditable.id, data).then(res=>{
			successMsg(res.data)
			c.dispatch('refreshSubDept')
		}).catch(err=>{
			handleError(err, '#edit-form')
		})
	},
	saveSubDept(c, data){
		let dt;
		let obj = typeof data == 'object'
		$('#datatable').DataTable().destroy()
		if(obj)
			dt = data[0]
		else
			dt = datadata()
		resetAllError()
		axios.post('sub-departments/store', dt).then(res=>{
			successMsg(res.data)
			c.dispatch('refreshSubDept')
			if(obj)
				resetForm(data[1])
		}).catch(err=>{
			handleError(err, '#add-form')
		})
	},
}