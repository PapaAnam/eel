export default {

	SET_API_TOKEN(s, API_TOKEN){
		s.API_TOKEN = API_TOKEN
	},

	SET_ACTIVE_USER(s, ACTIVE_USER){
		s.ACTIVE_USER = ACTIVE_USER
	},

	SET_APP_TITLE(s, APP_TITLE){
		s.APP_TITLE = APP_TITLE
	},

	SET_ANIMATION(s, animation){
		if(animation == 1){
			s.modul.department.icon = 'fa fa-university mif-ani-flash mif-ani-slow'
			s.modul.jobTitle.icon = 'fa fa-group mif-ani-heartbeat',
			s.modul.employee.icon = ' fa fa-address-book-o mif-ani-shuttle',
			s.modul.attendance.icon = 'fa fa-bell-o mif-ani-ring mif-ani-slow'
			s.modul.overTime.icon = 'fa fa-gavel mif-ani-spanner'
			s.modul.payroll.icon = 'fa fa-money mif-ani-heartbeat'
			s.modul.mutation.icon = 'fa fa-handshake-o mif-ani-bounce'
			s.modul.account.icon = 'fa fa-user-circle-o mif-ani-float'
			s.modul.specialDay.icon = 'fa fa-calendar-check-o mif-ani-flash',
			s.modul.leavePeriod.icon = 'fa fa-calendar-check-o mif-ani-flash'
			s.modul.officialTravel.icon = 'fa fa-space-shuttle mif-ani-pass'
			s.modul.salaryRule.icon = 'fa fa-cc-paypal mif-ani-horizontal mif-ani-slow'
		}
	},

	SET_ACTIVE_WINDOW(s, activeWindow){
		s.activeWindow = activeWindow
	},
	SET_BG_TILES(s, bgTiles){
		s.bgTiles = bgTiles
		s.modul.cashWithdrawal.bgTile = bgTiles.cash
		s.modul.department.bgTile = bgTiles.department
		s.modul.jobTitle.bgTile = bgTiles.jobTitle
		s.modul.employee.bgTile = bgTiles.employee
		s.modul.attendance.bgTile = bgTiles.attendance
		s.modul.payroll.bgTile = bgTiles.payroll
		s.modul.mutation.bgTile = bgTiles.mutation
		s.modul.account.bgTile = bgTiles.account
		s.modul.specialDay.bgTile = bgTiles.specialDay
		s.modul.leavePeriod.bgTile = bgTiles.leavePeriod
		s.modul.officialTravel.bgTile = bgTiles.officialTravel
		s.modul.salaryRule.bgTile = bgTiles.salaryRule
		s.modul.salaryGroup.bgTile = bgTiles.salaryGroup
		s.modul.alwaysPresence.bgTile = bgTiles.alwaysPresence
	},

	// DEPARTMENT MODUL
	SET_DEPARTMENTS(s, departments){
		s.departments = departments
	},
	SET_DEPARTMENT(s, department){
		s.department = department
	},
	SET_DEPARTMENT_EDITABLE(s, departmentEditable){
		s.departmentEditable = departmentEditable
	},
	SET_DEPARTMENT_BARU(s, departmentBaru){
		s.departmentBaru = departmentBaru
	},

	// POSITION MODUL
	SET_POSITIONS(s, positions){
		s.positions = positions
	},
	SET_POSITION(s, position){
		s.position = position
	},

	// EMPLOYEE MODUL
	SET_EMPLOYEES(s, employees){
		s.employees = employees
	},
	SET_EMPLOYEE(s, employee){
		s.employee = employee
	},

	// ACCOUNT MODUL
	SET_ACCOUNTS(s, accounts){
		s.accounts = accounts
	},
	SET_ACCOUNT(s, account){
		s.account = account
	},

	// ATTENDANCE MODUL
	SET_ATTENDANCES(s, ATTENDANCES){
		s.attendances = ATTENDANCES
	},
	SET_ATTENDANCE(s, ATTENDANCE){
		s.attendance = ATTENDANCE
	},

	// EVENT MODUL
	SET_EVENTS(s, EVENTS){
		s.events = EVENTS
	},
	SET_EVENT(s, EVENT){
		s.event = EVENT
	},

	// SALARY RULES
	SET_SALARY_RULES(s, salaryRules){
		s.salaryRules = salaryRules
	},
	SET_SALARY_RULE_SELECTED(s, salaryRuleSelected){
		s.salaryRuleSelected = salaryRuleSelected
	},

	// OFFICIAL TRAVEL MODUL
	SET_OFFICIAL_TRAVELS(s, OFFICIAL_TRAVELS){
		s.officialTravels = OFFICIAL_TRAVELS
	},
	SET_OFFICIAL_TRAVEL(s, OFFICIAL_TRAVEL){
		s.officialTravel = OFFICIAL_TRAVEL
	},
	SET_OFFICIAL_TRAVEL_EDITABLE(s, OFFICIAL_TRAVEL_EDITABLE){
		s.officialTravelEditable = OFFICIAL_TRAVEL_EDITABLE
	},

}