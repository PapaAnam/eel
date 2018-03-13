<!DOCTYPE html>
<html>
<head>
	<title>Print</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/report.css') }}">
	@stack('css')
	<style>
		html{
			font-family: sans-serif;
		}
		table{
			border-collapse: collapse;
			border-spacing: 0;
			width: 100%;
		}
		.table{
			border: 1px solid #eeeeee;
			width: 100%;
		}
		.table td, .table th{
			border: 1px solid #dddddd;
		}
		td, th{
			padding: 5px 7px;
		}
		.table-striped tr:nth-child(even){
			background-color: #f2f2f2
		}
		.text-center{
			text-align: center;
		}
		.modul{
			position: fixed;
			left: 50%;
			top: 2px;
		}
	</style>
	@stack('css')
</head>
<body>
	{{-- <div class="container-fluid"> --}}
		@yield('content')
	{{-- </div> --}}
	<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
	<script type="text/javascript">
		window.print();
		$(document).ready(function(){
			// $('.table').attr('class', '').addClass('w3-table w3-bordered w3-striped w3-border');
			// $('.row').attr('class', '').addClass('tr').find('.col-xs-6').attr('class', '').addClass('td');
			@stack('ready-function');
		});
		// $('.logo').css('width', 'calc(50% - '+$('h3').width()+'px)');
		console.log($('h3').width());
	</script>
</body>
</html>