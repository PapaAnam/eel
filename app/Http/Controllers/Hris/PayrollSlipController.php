<?php

namespace App\Http\Controllers\Hris;

use PDF;
use Auth;
use Excel;
use App\Models\Hris\Salary;
use Illuminate\Http\Request;
use App\Models\Hris\Attendance;
use App\Http\Controllers\Controller;
use App\Models\Hris\Employee;
use App\Models\Hris\SalaryGroup;

class PayrollSlipController extends Controller
{

// 
	private $total_hari_kerja, $s, $file_name, $total_over_time_money, $total_over_time_hours, $total_over_time_holiday_in_money, $total_over_time_holiday_in_hours, $seguranca_social;

	public function getData($id)
	{
		$s = $this->s = Salary::slip()->where('id', $id)->first();
		$this->total_hari_kerja = Attendance::totalHariKerja($s->year, $s->month, $s->emp->id);
		$this->file_name = 'slip ('.$s->emp->nin.') '.$s->emp->name.' ['.now().']';
	}

	public function generate($id, $type)
	{
		$this->getData($id);
		$s = $this->s;
		Excel::create($this->file_name, function($excel) use ($s){
			$excel->sheet('slip', function($sheet) use ($s){
				$sheet->cell('A1', 'Lisun Salary Slip');
				$sheet->cell('A3', 'Name :');
				$sheet->cell('B3', $s->emp->name);
				$sheet->cell('A4', 'NIN :');
				$sheet->cell('B4', $s->emp->nin);
				$sheet->cell('A6', 'Basic Salary');
				$sheet->cell('B6', $s->sr->basic_salary);
				$sheet->cell('A7', 'Allowance');
				$sheet->cell('B7', $s->sr->allowance);
				$sheet->cell('A8', 'Total Work Day');
				$sheet->cell('B8', $this->total_hari_kerja);
				$sheet->cell('A9', 'Over Time Regular ('.$s->ot_regular_in_hours.')');
				$sheet->cell('B9', $s->ot_regular);
				// $sheet->cell('C9', $this->total_over_time_hours);
				$sheet->cell('A10', 'Over Time Holiday ('.$s->ot_holiday_in_hours.')');
				$sheet->cell('B10', $s->ot_holiday);
				// $sheet->cell('C10', $this->total_over_time_holiday_in_hours);
				$sheet->cell('A11', 'Incentive Sales');
				$sheet->cell('B11', $s->sr->incentive);
				$sheet->cell('A12', 'Eat Cost');
				$sheet->cell('B12', $s->sr->eat_cost);
				// $sheet->cell('A13', 'ETC');
				// $sheet->cell('B13', $s->sr->etc);
				$sheet->cell('A13', 'Ritation');
				$sheet->cell('B13', $s->sr->ritation);
				$sheet->cell('A14', function($cell){
					$cell->setFontWeight('bold');
					$cell->setAlignment('center');
				});
				$sheet->cell('A14', 'Sub Total');
				$sheet->cell('B14', $s->gross_salary);
				$sheet->cell('A16', 'Potongan');
				$sheet->cell('A16', function($cell){
					$cell->setFontWeight('bold');
				});
				$sheet->cell('A17', 'Pajak (Seguranca Social 4%)');
				// $seguranca_social = $this->seguranca_social;
				$sheet->cell('B17', $s->seguranca);
				$sheet->cell('A18', 'Kas Bon');
				$sheet->cell('B18', $s->sr->cash_receipt);
				$sheet->cell('A19', 'Absent ('.$s->absent.' days)');
				$sheet->cell('B19', $s->absent_punishment);
				$sheet->cell('A20', function($cell){
					$cell->setFontWeight('bold');
					$cell->setAlignment('center');
				});
				$sheet->cell('A20', 'Sub Total');
				$sheet->cell('B20', $s->total_potongan);
				$sheet->cell('A22', 'Total');
				$sheet->cell('B22', $s->clear_salary);
				$sheet->cell('A24', 'Dili '.date('F, Y-d'));
				$sheet->cell('A25', 'HRD Lisun');
				$sheet->cell('C25', 'Penerima');
				$sheet->cell('A27', Auth::user()->username);
				$sheet->cell('C27', $s->emp->name);
			});
		})->download($type);
	}

	public function excelExport($id)
	{
		$this->generate($id, 'xlsx');
	}

	public function pdfExport($id)
	{
		$this->getData($id);
		return PDF::loadView('hris.payroll.slip.pdf', [
			's'									=> $this->s,
			'total_hari_kerja'					=> $this->total_hari_kerja,
		])->setPaper('A4')
		->download($this->file_name.'.pdf');
	}

	private function multipleSlipData($r)
	{
		$employees = explode(',', $r->query('employees'));
		$salaries = [];
		$total_hari_kerja					= [];
		$total_over_time_money				= [];
		$total_over_time_hours				= [];
		$total_over_time_holiday_in_money	= [];
		$total_over_time_holiday_in_hours	= [];
		$seguranca_social					= [];
		foreach ($employees as $e) {
			$salary = Salary::where('employee', $e)
			->where('month', $r->query('month'))
			->where('year', $r->query('year'))
			->first();
			$salaries[] 						= Salary::slip()->where('id', $salary->id)->first();
		}
		return [
			'salaries'							=> $salaries,
		];
	}

	public function multipleSlip(Request $r)
	{
		return view('hris/salaries/multiple-slip', $this->multipleSlipData($r));
	}

	public function multipleSlipPdf(Request $r)
	{
		return PDF::loadView('hris/salaries/multiple-slip-pdf', $this->multipleSlipData($r))
		->setPaper('A4')
		->download('multiple slip period '.$r->query('year').'-'.$r->query('month').'.pdf');
	}

	public function all(Request $r)
	{
		$employees = Employee::active()->pluck('id');
		$salaries = [];
		$total_hari_kerja					= [];
		$total_over_time_money				= [];
		$total_over_time_hours				= [];
		$total_over_time_holiday_in_money	= [];
		$total_over_time_holiday_in_hours	= [];
		$seguranca_social					= [];
		foreach ($employees as $e) {
			$salary = Salary::where('employee', $e)
			->where('month', $r->query('month'))
			->where('year', $r->query('year'))
			->first();
			if(!is_null($salary)){
				$this->getData($salary->id);
				$salaries[] 						= $this->s;
				$total_hari_kerja[]					= $this->total_hari_kerja;
				$seguranca_social[]					= $this->seguranca_social;
			}
		}
		$oper = [
			'salaries'							=> $salaries,
			'total_hari_kerja'					=> $total_hari_kerja,
			'seguranca_social'					=> $seguranca_social,
		];
		return view('hris/salaries/multiple-slip', $oper);
	}


	public function print($id)
	{
		$s = Salary::slip()->where('id', $id)->first();
		if(is_null($s)){
			return 'not available';
		}
		return view('hris.salaries.print', [
			's'	=> $s
		]);
	}

	public function slip(Request $r)
	{
		$salaries = [];
		if($r->query('month') == 'all'){
			$salaries = Salary::slip()
			->where('year', $r->query('year'))
			->where('employee', $r->query('employee'))
			->get();
		}else{
			$salaries = Salary::slip()
			->where('month', $r->query('month'))
			->where('year', $r->query('year'))
			->where('employee', $r->query('employee'))
			->get();
		}
		if(count($salaries) <= 0){
			return 'not available';
		}
		return view('hris.salaries.multiple-slip', [
			'salaries'	=> $salaries
		]);
	}

	public function byGroup(Request $r, $id)
	{
		$salaries = Salary::slip()
		->where('month', $r->query('month'))
		->where('year', $r->query('year'))
		// ->where('salary_group', $id)
		->get()
		->transform(function($item)use($id){
			if(!is_null($item->sg)){
				if($item->sg->id == $id)
					return $item;
			}
		})->filter()->values()
			;
		// return $salaries;
		if(count($salaries) <= 0){
			return 'not available';
		}
		return view('hris.salaries.multiple-slip', [
			'salaries'	=> $salaries
		]);
	}

	public function byGroupPdf($id)
	{
		$salaries = Salary::slip()->where('salary_group', $id)->get();
		return PDF::loadView('hris.salaries.multiple-slip', [
			'salaries'	=> $salaries
		])->download('slip for '.$salaries[0]->sg->name.' group.pdf');
	}

}
