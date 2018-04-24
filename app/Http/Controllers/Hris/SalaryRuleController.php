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
	public function getData($employee)
	{
		$emp = Employee::find($employee);
		$data = [
			'data' => SalaryRule::whereEmployee($employee)->get()->toArray(),
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
		]);
		SalaryRule::whereEmployee($r->employee)->update(['status' => 0]);
		SalaryRule::create($r->except(['name'])+['status'=>1]);
		return 'salary rule success created';
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

	public function excel()
	{
		Excel::create('lisun-hris-salary-rules ['.now().']', function($excel){
			$excel->setTitle('Lisun HRIS Salary Rules');
			$excel->setCreator('Lisun')->setCompany('Lisun');
			$excel->setDescription('Lisun HRIS Salary Rules');
			$excel->sheet('data', function($sheet){
				$sheet->fromArray(SalaryRule::excel());
				$sheet->row(1, function($row){
					$row->setFontWeight('bold');
				});
				$sheet->prependRow(['Salary Rules']);
				$sheet->mergeCells('A1:I1');
				$sheet->cell('A1', function($cell){
					$cell->setFontSize(16);
					$cell->setAlignment('center');
				});
			});
		})->export('xlsx');
	}
}
