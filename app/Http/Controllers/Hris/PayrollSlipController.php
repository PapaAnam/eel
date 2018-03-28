<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use App\Models\Hris\Salary;
use App\Models\Hris\Attendance;

class PayrollSlipController extends Controller
{
	public function excelExport($id)
	{
		$s = Salary::with(['emp', 'sr'=>function($q){
			$q->where('status', '1');
		}])->where('id', $id)->first();
		Excel::create('slip ('.$s->emp->nin.') '.$s->emp->name.' ['.now().']', function($excel) use ($s){
			$excel->sheet('slip', function($sheet) use ($s){
				$sheet->cell('A1', 'Lisun Salary Slip');
				$sheet->cell('A3', 'Name :');
				$sheet->cell('B3', $s->emp->name);
				$sheet->cell('A3', 'NIN :');
				$sheet->cell('B4', $s->emp->nin);
				$sheet->cell('A6', 'Basic Salary');
				$sheet->cell('B6', $s->sr[0]->basic_salary);
				$sheet->cell('A7', 'Tunjangan Jabatan');
				$sheet->cell('B7', $s->sr[0]->allowance);
				$sheet->cell('A8', 'Total Hari Kerja');
				$total_hari_kerja = Attendance::where('employee', $s->emp->id)
				->whereMonth('created_at', $s->month)
				->whereYear('created_at', $s->year)
				->where('status', 'Present')
				->count();
				$sheet->cell('B8', $total_hari_kerja);
				$sheet->cell('A9', 'Total Over Time Biasa');
				$att = Attendance::with(['emp' => function($q){
					$q->with(['sr'=>function($k){
						$k->where('status', '1');
					}]);
				}])->where('employee', $s->employee)
				->whereMonth('created_at', $s->month)
				->whereYear('created_at', $s->year)
				->latest()
				->get();
				$biasa = $att->where('is_holiday', false);
				$total_biasa = 0;
				foreach($biasa as $item){
					$total_biasa += $item['over_time_in_money'];
				}
				$sheet->cell('B9', (int) round($total_biasa, -4));
				$sheet->cell('A10', 'Total Over Time Holiday');
				$holiday = $att->where('is_holiday', true);
				$total_holiday = 0;
				foreach($holiday as $item){
					$total_holiday += $item['over_time_in_money'];
				}
				$sheet->cell('B10', round($total_holiday, -4));
				$sheet->cell('A11', 'Incentive Sales');
				$sheet->cell('B11', $s->sr[0]->incentive);
				$sheet->cell('A12', 'Ritation');
				$sheet->cell('B12', $s->sr[0]->ritation);
				$sheet->cell('A12', 'Sub Total');
				$sheet->cell('B12', $s->clear_salary);
			});
		})->download('xlsx');
	}
}
