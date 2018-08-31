<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hris\SalaryRule;
use App\Models\Hris\Employee;
use PDF;
use Excel;

class SalaryRuleController extends Controller
{

	public function index(Request $r)
	{
		$sr = SalaryRule::with('emp.pos','emp.dep','salaryGroup');
		if($r->query('out_at_rule')){
			if($r->query('out_at_rule') == 'all'){
				return $sr->where('status', '1')->get();
			}
			return $sr->where('out_at_rule', $r->query('out_at_rule'))->where('status', '1')->get();
		}
		if($r->query('group')){
			if($r->query('group') == 'all'){
				return $sr->where('status', '1')->get();
			}
			return $sr->where('salary_group_id', $r->query('group'))->where('status', '1')->get();
		}
		if($r->query('array')){
			return $sr->where('employee', $r->query('employee'))->take(2)->latest()->get();
		}
		return $sr->where('employee', $r->query('employee'))->where('status', '1')->first();
	}

	public function getData($employee)
	{
		$emp = Employee::find($employee);
		$data = [
			'data' => SalaryRule::whereEmployee($employee)
			->where('status', '1')
			->orderBy('status', 'desc')
			->get()
			->toArray(),
			'employee' => [
				'id' => $emp->id,
				'name' => $emp->name,
				'department' => $emp->dep()->first()->name,
				'position' => $emp->pos()->first()->name
			]
		];
		return $data;
	}

	public function store(Request $r)
	{
		if(!$r->name)
			return response([
				'errors' => [
					'name' => ['Name is required']
				]
			], 422);
		$r->validate([
			'basic_salary' 		=> 'numeric|min:0|max:999999999',
			'allowance' 		=> 'numeric|min:0|max:999999999',
			'incentive' 		=> 'numeric|min:0|max:999999999',
			'eat_cost' 			=> 'numeric|min:0|max:999999999',
			'etc' 				=> 'numeric|min:0|max:999999999',
			'seguranca' 		=> 'numeric|min:0|max:999999999',
			'cash_receipt'		=> 'numeric|min:0|max:999999999',
			'rent_motorcycle'	=> 'numeric|min:0|max:999999999',
		]);
		$data = $r->except(['name', 'tipe', 'salary_group']);
		$sr = SalaryRule::whereEmployee($r->query('employee'))->where('status', '1')->first();
		$sr = collect($sr);
		if($r->tipe == 1){
			if($sr){
				$data['salary_group_id'] = $r->salary_group;
				$data = $data + $sr->except('id', 'basic_salary', 'allowance', 'status', 'salary_type', 'salary_group_id')->toArray();
			}
		}else{
			if($sr){
				$data = $data + $sr->only('basic_salary', 'allowance', 'status', 'salary_type', 'salary_group_id')->toArray();
			}
		}
		$data = $data + ['status'=>'1'];
		SalaryRule::whereEmployee($r->query('employee'))->update(['status' => 0]);
		SalaryRule::create($data);
		return 'Salary Rule success';
	}

	public function toPrint()
	{
		$salaryRules = Employee::with(['dep', 'pos', 'sr'=>function($q){
			$q->where('status', '!=', '0');
		}])->where('non_active', null)->get();
		return view('hris.salary_rules.print', [
			'kk' => $salaryRules,
			'index' => 0
		]);
	}

	public function pdf()
	{
		$salaryRules = Employee::with(['dep', 'pos', 'sr'=>function($q){
			$q->where('status', '!=', '0');
		}])->where('non_active', null)->get();
		$oper  = [
			'kk' => $salaryRules,
			'index' => 0
		];
		$pdf = PDF::loadView('hris.salary_rules.print', $oper);
		$pdf->setPaper('a4', 'landscape');
		return $pdf->download('salary-rules-of-employees ['.now().'].pdf');
	}

	public function excel(Request $r)
	{
		$data = [];
		$data = SalaryRule::excel($r->query('out_at_rule'));
		$fn = 'lisun hris salary rules '.$r->query('out_at_rule');
		Excel::create($fn, function($excel) use ($data){
			$excel->setTitle('Lisun HRIS Salary Rules');
			$excel->setCreator('Lisun')->setCompany('Lisun');
			$excel->setDescription('Lisun HRIS Salary Rules');
			$excel->sheet('data', function($sheet) use ($data){
				$sheet->fromArray($data);
				$sheet->row(1, function($row){
					$row->setFontWeight('bold');
				});
				$sheet->prependRow(['Salary Rules']);
				$sheet->mergeCells('A1:N1');
				$sheet->cell('A1', function($cell){
					$cell->setFontSize(16);
					$cell->setAlignment('center');
				});
			});
		})->export('xlsx');
	}
}
