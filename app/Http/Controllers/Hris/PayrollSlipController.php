<?php

namespace App\Http\Controllers\Hris;

use PDF;
use Auth;
use Excel;
use App\Models\Hris\Salary;
use Illuminate\Http\Request;
use App\Models\Hris\Attendance;
use App\Http\Controllers\Controller;

class PayrollSlipController extends Controller
{

	private $total_hari_kerja, $s, $file_name, $total_over_time_money, $total_over_time_hours, $total_over_time_holiday_in_money, $total_over_time_holiday_in_hours, $seguranca_social;

	public function getData($id)
	{
		$s = $this->s = Salary::with(['emp', 'sr'=>function($q){
			$q->where('status', '1');
		}])->where('id', $id)->first();
		$this->total_hari_kerja = Attendance::where('employee', $s->emp->id)
		->whereMonth('created_at', $s->month)
		->whereYear('created_at', $s->year)
		->where('status', 'Present')
		->count();
		$this->file_name = 'slip ('.$s->emp->nin.') '.$s->emp->name.' ['.now().']';
		$att = Attendance::with(['emp' => function($q){
			$q->with(['sr'=>function($k){
				$k->where('status', '1');
			}]);
		}])->where('employee', $s->employee)
		->whereMonth('created_at', $s->month)
		->whereYear('created_at', $s->year)
		->latest()
		->get();
		$biasa = $att->where('is_holiday', false)->values();
		$this->total_over_time_money = 0;
		foreach($biasa as $item){
			$this->total_over_time_money += $item['over_time_in_money'];
		}
		$this->total_over_time_money = round($this->total_over_time_money, env('ROUND', 2));
		$this->total_over_time_hours = 0;
		foreach($biasa as $item){
			$this->total_over_time_hours += $item['over_time_in_hours'];
		}
		$this->total_over_time_hours = convertHour($this->total_over_time_hours);

		// total over time pada hari libur (duit)
		$holiday = $att->where('is_holiday', true)->values();
		$this->total_over_time_holiday_in_money = 0;
		foreach($holiday as $item){
			$this->total_over_time_holiday_in_money += $item['over_time_in_money'];
		}

		$this->total_over_time_holiday_in_money = round($this->total_over_time_holiday_in_money, env('ROUND', 2));

		// total over time pada hari libur (jam)
		$this->total_over_time_holiday_in_hours = 0;
		foreach($holiday as $item){
			$this->total_over_time_holiday_in_hours += $item['over_time_in_hours'];
		}
		$this->total_over_time_holiday_in_hours = convertHour($this->total_over_time_holiday_in_hours);

		// menghitung seguranca social
		$this->seguranca_social = $this->s->sr[0]->basic_salary*4/100;
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
				$sheet->cell('B6', $s->sr[0]->basic_salary);
				$sheet->cell('A7', 'Tunjangan Jabatan');
				$sheet->cell('B7', $s->sr[0]->allowance);
				$sheet->cell('A8', 'Total Hari Kerja');
				$sheet->cell('B8', $this->total_hari_kerja);
				$sheet->cell('A9', 'Total Over Time Biasa');
				$sheet->cell('B9', $this->total_over_time_money);
				$sheet->cell('C9', $this->total_over_time_hours);
				$sheet->cell('A10', 'Total Over Time Holiday');
				$sheet->cell('B10', $this->total_over_time_holiday_in_money);
				$sheet->cell('C10', $this->total_over_time_holiday_in_hours);
				$sheet->cell('A11', 'Incentive Sales');
				$sheet->cell('B11', $s->sr[0]->incentive);
				$sheet->cell('A12', 'Eat Cost');
				$sheet->cell('B12', $s->sr[0]->eat_cost);
				$sheet->cell('A13', 'ETC');
				$sheet->cell('B13', $s->sr[0]->etc);
				$sheet->cell('A14', 'Ritation');
				$sheet->cell('B14', $s->sr[0]->ritation);
				$sheet->cell('A15', function($cell){
					$cell->setFontWeight('bold');
					$cell->setAlignment('center');
				});
				$sheet->cell('A15', 'Sub Total');
				$sheet->cell('B15', $s->gross_salary);
				$sheet->cell('A17', 'Potongan');
				$sheet->cell('A17', function($cell){
					$cell->setFontWeight('bold');
				});
				$sheet->cell('A18', 'Pajak (Seguranca Social 4%)');
				$seguranca_social = $this->seguranca_social;
				$sheet->cell('B18', $seguranca_social);
				$sheet->cell('A19', 'Kas Bon');
				$sheet->cell('B19', $s->sr[0]->cash_receipt);
				$sheet->cell('A20', function($cell){
					$cell->setFontWeight('bold');
					$cell->setAlignment('center');
				});
				$sheet->cell('A20', 'Sub Total');
				$sheet->cell('B20', $seguranca_social+$s->sr[0]->cash_receipt);
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
			'total_over_time_money'				=> $this->total_over_time_money, 
			'total_over_time_hours'				=> $this->total_over_time_hours, 
			'total_over_time_holiday_in_money'	=> $this->total_over_time_holiday_in_money, 
			'total_over_time_holiday_in_hours'	=> $this->total_over_time_holiday_in_hours,
			'seguranca_social'					=> $this->seguranca_social,
		])->setPaper('A4')
		// ->stream();
		->download($this->file_name.'.pdf');
	}
}
