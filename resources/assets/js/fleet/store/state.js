export default {
	DRIVERS : [],
	SALES : [],
	SALES_ORDER : [],
	SALES_ORDER_RESULT : [],
	PROCESSING : false,
	activeWindow : {
		icon : null,
		bg : null
	},
	bgTiles : {
		salesOrder : null,
		drivers : null,
	},
	MY_WINDOW : {
		icon : 'fa fa-cube',
		caption : "dalam pengembangan",
		bg : 'bg-dark'
	},
	moduls : [
	{
		id : 1,
		content : {
			salesOrder : {
				caption : 'Sales Order',
				icon : 'fa fa-clone mif-ani-flash mif-ani-slow',
				bg : null,
				url : '/sales-order',
				size : 'tile-wide',
			},
			drivers : {
				caption : 'Drivers',
				icon : 'fa fa-users mif-ani-heartbeat',
				bg : null,
				url : '/drivers',
				size : 'tile',
			},
			refilFuel : {
				caption : 'Isi BBM',
				icon : 'fa fa-car mif-ani-heartbeat',
				bg : null,
				url : '/refil-fuel',
				size : 'tile',
				info : true,
			},
			changeSpareparts : {
				caption : 'Penggantian Spareparts',
				icon : 'fa fa-gears mif-ani-heartbeat',
				bg : null,
				url : '/change-spareparts',
				size : 'tile-wide',
				info : true,
			},
		}
	},
	{
		id : 2,
		content : {
			services : {
				caption : 'Services',
				icon : 'fa fa-random mif-ani-flash mif-ani-slow',
				bg : null,
				url : '/services',
				size : 'tile',
				info : true,
			},
			sales : {
				caption : 'Daftar Sales',
				icon : 'fa fa-users mif-ani-flash mif-ani-slow',
				bg : null,
				url : '/sales',
				size : 'tile',
			},
		}
	}
	]
}