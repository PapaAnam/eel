export default {
	activeUser(s){
		return s.ACTIVE_USER
	},

	appTitle(s){
		return s.APP_TITLE
	},
	years(s){
		let d = new Date()
		let years = []
		for (let i = 2018; i <= d.getFullYear(); i++) {
			years.push(i)
		}
		return years
	},
	months(s){
		return [
		{ value : '1', title : 'January' },
		{ value : '2', title : 'February' },
		{ value : '3', title : 'March' },
		{ value : '4', title : 'April' },
		{ value : '5', title : 'May' },
		{ value : '6', title : 'June' },
		{ value : '7', title : 'July' },
		{ value : '8', title : 'August' },
		{ value : '9', title : 'September' },
		{ value : '10', title : 'October' },
		{ value : '11', title : 'November' },
		{ value : '12', title : 'December' },
		]
	},
	absenceStatus(s){
		return [
		{ value : 'Present', text : 'Present' }, 
		{ value : 'Over Time', text : 'Over Time' }, 
		{ value : 'Sick', text : 'Sick' }, 
		{ value : 'Absent', text : 'Absent' }, 
		{ value : 'Official Travel', text : 'Official Travel' }, 
		{ value : 'Father Leave', text : 'Father Leave' }, 
		{ value : 'Holiday', text : 'Holiday' }, 
		{ value : 'Special Permit', text : 'Special Permit' }, 
		{ value : 'Pregnancy', text : 'Pregnancy' }
		]
	},
	modul(s){
		return s.modul
	},
	bgTiles(s){
		return s.bgTiles
	},
	icons(s){
		return s.icons
	},
	departments(s){
		return s.departments
	},
	department(s){
		return s.department
	},
	deptDt(s){
		let data = []
		let dept = s.departments
		for (let i of dept) {
			i.action = '<button> Hapus </button>'
			data.push(i)
		}
		return data
	},
	departmentEditable(s){
		return s.departmentEditable
	},
	subDepts(s){
		return s.subDepts
	},
	subDept(s){
		return s.subDept
	},
	positions(s){
		return s.positions
	},
	position(s){
		return s.position
	},
	employees(s){
		return s.employees
	},
	employee(s){
		return s.employee
	},
	employeeEditable(s){
		return s.employeeEditable
	},
	accounts(s){
		return s.accounts
	},
	account(s){
		return s.account
	},
	attendances(s){
		return s.attendances
	},
	attendance(s){
		return s.attendance
	},
	attendanceEditable(s){
		return s.attendanceEditable
	},
	events(s){
		return s.events
	},
	event(s){
		return s.event
	},
	eventEditable(s){
		return s.eventEditable
	},
	departmentBaru(s){
		return s.departmentBaru
	},
	salaryRuleSelected(s){
		return s.salaryRuleSelected
	},
	salaryRules(s){
		return s.salaryRules
	},
	officialTravels(s){
		return s.officialTravels
	},
	officialTravel(s){
		return s.officialTravel
	},
	officialTravelEditable(s){
		return s.officialTravelEditable
	}
}