	<style>
	body {
		font-family: sans-serif;
	}
	* {
		font-size: 11px;
	}
	table {
		width: 100%;
	}
	td {
		padding: 1px 5px;
	}
	.mi {
		width: 45%; 
		display: inline-block; 
	}
	.mi:nth-child(4n-3){
		margin-bottom: 100px; 
	}
	.mi:nth-child(4n-2){
		margin-bottom: 100px; 
	}
	.mi:nth-child(odd){
		margin-right: 50px;
	}
</style>
@include('hris.salaries.slip', ['s'=>$s])
<script>
	window.print();
</script>