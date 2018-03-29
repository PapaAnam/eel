<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use App\Models\Hris\Salary;
use App\Models\Hris\Attendance;
use Auth;

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
				$sheet->cell('A4', 'NIN :');
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
				$sheet->cell('B15', $s->clear_salary);
				$sheet->cell('A17', 'Potongan');
				$sheet->cell('A17', function($cell){
					$cell->setFontWeight('bold');
				});
				$sheet->cell('A18', 'Pajak (Seguranca Social 4%)');
				$sheet->cell('A19', 'Kas Bon');
				$sheet->cell('A20', function($cell){
					$cell->setFontWeight('bold');
					$cell->setAlignment('center');
				});
				$sheet->cell('A20', 'Sub Total');
				$sheet->cell('A22', 'Total');
				$sheet->cell('A24', 'Dili '.date('F, Y-d'));
				$sheet->cell('A25', 'HRD Lisun');
				$sheet->cell('C25', 'Penerima');
				$sheet->cell('A27', Auth::user()->username);
				$sheet->cell('C27', $s->emp->name);
			});
		})->download('xlsx');
	}
}
