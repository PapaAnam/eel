<div class="row">
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading">Salary Rules</div>
			<div class="panel-body">
				{{ export_btn('employee.salary_rules') }}
				<table class="table table-bordered table-striped" id="salary-rules">
					<thead>
						<th>NIN</th>
						<th>Employee</th>
						<th>Department</th>
						<th>Position</th>
						<th>Basic Salary</th>
						<th>Eat Cost</th>
						<th>Allowance</th>
						<th>Incentive</th>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading">New Salary Rules</div>
			<div class="panel-body">
				<form onsubmit="save(this, event)" action="{{ route('employee.salary_rules.create') }}" id="salary-rule-add-form" method="post">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-12">
							@php
							$E = App\Models\Hris\Employee::orderBy('nin', 'asc')->get();
							$em = [];
							foreach ($E as $e) {
								$em = array_add($em, $e->id, '('.$e->nin.') '.$e->name);
							}
							@endphp
							{{ select('employee', '', $em, 'onchange="checkSalaryRule(this)"') }}
						</div>
						<div class="salary-area">
							<div class="col-md-12">
								{{ input_text('basic_salary', 'Basic Salary ($)', '', 'required') }}
							</div>
							<div class="col-md-12">
								{{ input_text('eat_cost', 'Eat Cost ($)', '', 'required') }}
							</div>
							<div class="col-md-12">
								{{ input_text('allowance', 'Allowance ($)', '', 'required') }}
							</div>
							<div class="col-md-12">
								{{ input_text('incentive', 'Incentive ($)', '', 'required') }}
							</div>
						</div>
						<div class="col-md-12">
							{{ save_button() }}
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$('#salary-rule-add-form').find('.select2').select2();
	function checkSalaryRule(el) {
		var sel = $(el);
		var salary_form = $('#salary-rule-add-form');
		var employee = sel.val();
		$.ajax({
			url : '{{ route('employee.salary_rules.check') }}',
			type : 'POST',
			data : {
				_token : csrf_token,
				employee : employee
			},
			beforeSend : function(){
				salary_form.find('.salary-area').html('Please Wait');
			},
			success : function(response){
				salary_form.find('.salary-area').html(response);
			}
		})
	}
	checkSalaryRule(document.getElementById('employee'));
</script>