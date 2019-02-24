export default {

	API_TOKEN : '',

	departments : [],
	department : '',
	departmentEditable : {
		status : false,
		id : null
	},
	subDepts : [],
	subDept : '',
	subDeptEditable : {
		status : false,
		id : null
	},
	positions : [],
	position : '',
	positionEditable : {
		status : false,
		id : null
	},
	employees : [],
	employee : '',
	employeeEditable : {
		status : false,
		id : null
	},
	accounts : [],
	account : '',
	accountEditable : {
		status : false,
		id : null
	},
	attendances : [],
	attendance : '',
	attendanceEditable : {
		status : false,
		id : null
	},
	events : [],
	event : '',
	eventEditable : {
		status : false,
		id : null
	},
	officialTravels : [],
	officialTravel : '',
	officialTravelEditable : {
		status : false,
		id : null
	},
	activeWindow : {
		icon : null,
		bg : null
	},
	bgTiles : {
		department : null,
		subDepartment : null,
		employee : null,
		position : null,
		attendance : null,
		overTime : null,
		mutation : null,
		payroll : null,
		specialDay : null,
		account : null,
		officialTravel : null,
		leavePeriod : null,
		salaryRules : null,
		salaryGroup : null
	},
	icons : {
		specialDay : 'fa fa-calendar-check-o mif-ani-flash',
		salaryRules : 'fa fa-cc-paypal mif-ani-horizontal mif-ani-slow',
	},
	modul : {
		department : {
			title : 'Department',
			icon : 'fa fa-university'
		},
		jobTitle : {
			title : 'Job Title',
			icon : 'fa fa-group',
		},
		employee : {
			title : 'Employees',
			icon : ' fa fa-address-book-o',
		},
		attendance : {
			title : 'Attendances',
			icon : 'fa fa-bell-o'
		},
		overTime : {
			title : 'Over Time',
			icon : 'fa fa-gavel'
		},
		payroll : {
			title : 'Payroll',
			icon : 'fa fa-money'
		},
		mutation : {
			title : 'Mutation',
			icon : 'fa fa-handshake-o'
		},
		account : {
			title : 'Accounts',
			icon : 'fa fa-user-circle-o'
		},
		specialDay : {
			title : 'Special Day',
			icon : 'fa fa-calendar-check-o',
		},
		leavePeriod : {
			title : 'Leave Period',
			icon : 'fa fa-calendar-check-o'
		},
		officialTravel : {
			title : 'Official Travel',
			icon : 'fa fa-space-shuttle'
		},
		salaryRule : {
			title : 'Salary Rules',
			icon : 'fa fa-cc-paypal'
		},
		salaryGroup : {
			title : 'Salary Group',
			icon : 'mif mif-coins'
		},
		cashWithdrawal : {
			title : 'Cash Withdrawal',
			icon : 'fa fa-paypal',
			bgTile : null
		},
		alwaysPresence : {
			title : 'Always Presence',
			icon : 'fa fa-eyedropper',
			bgTile : null
		}
	},
	departmentBaru : {
		id : null,
		name : ""
	},
	salaryRules : {
		employee : {
			name : ''
		}
	},
	salaryRuleSelected : null,
	APP_TITLE : 'HRIS',
	ACTIVE_USER : {
		username : ''
	},
}