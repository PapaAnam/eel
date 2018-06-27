<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Hris\Salary              as S;
use App\Models\Hris\Department          as D;
use App\Models\Hris\Employee            as E;
use App\Models\Hris\Work                as W;
use App\Models\Hris\SalaryRule;
use App\Models\Hris\Attendance;
use Excel;

class PayrollController extends Controller
{

    public function payAll(Request $r)
    {
        $emp = E::with(['dep', 'pos'])->get();
        $sr_not_set = [];
        $total_success = 0;
        foreach ($emp as $e) {
            if(SalaryRule::where('employee', $e->id)->where('status', '1')->exists()){
                $sr = SalaryRule::where('employee', $e->id)->where('status', '1')->first();
                $over_time = 0;
                $attendances = Attendance::where('employee', $e->id)
                ->whereMonth('created_at', $r->month)
                ->whereYear('created_at', $r->year)
                ->get();

                // menghitung ot holiday
                $oth = Attendance::overTimeSundayInMonth($r->year, $r->month, $e->id);
                $ot_holiday_money = $sr->basic_salary/22/8*2*$oth['in_reg'];
                $ot_holiday_hours = $oth['in_hours'];

                // menghitung ot holiday
                $oteh = Attendance::overTimeEventInMonth($r->year, $r->month, $e->id);
                if($e->id == 8){
                    return $oth;
                }
                $ot_event_holiday_money = $sr->basic_salary/22/8*$oteh['in_reg'];
                $ot_event_holiday_hours = $oteh['in_hours'];

                // menghitung ot regular
                $otr = Attendance::overTimeRegularInMonth($r->year, $r->month, $e->id);
                $ot_regular = $sr->basic_salary/22/8*1.5*$otr['in_reg'];

                // menghitung absent
                $absent = Attendance::absent($r->year, $r->month, $e->id);
                $absent_punishment = $absent * ($sr->basic_salary / 22);

                // menghitung tax_insurance
                $gross_salary = ($sr->basic_salary + $sr->allowance + $ot_holiday_money + $ot_regular + $sr->incentive + $sr->eat_cost + $sr->ritation + $sr->rent_motorcycle);
                $tax_insurance = $gross_salary > 500 ? ($gross_salary - 500) * 0.1 : 0;

                $present_total = Attendance::presentTotalInMonth($e->id, $r->year, $r->month);
                
                S::updateOrCreate([
                    'employee'      => $e->id,
                    'month'         => $r->month,
                    'year'          => $r->year,
                ], [
                    'salary_rule'           => $sr->id,
                    'department'            => $e->dep->id,
                    'position'              => $e->pos->id,
                    'ot_regular'            => round($ot_regular, env('ROUND', 2)),
                    'ot_holiday'            => round($ot_holiday_money + $ot_event_holiday_money, env('ROUND', 2)),
                    'ot_regular_in_hours'   => $otr['in_hours'],
                    'ot_holiday_in_hours'   => $ot_holiday_hours,
                    'absent'                => $absent,
                    'absent_punishment'     => round($absent_punishment, env('ROUND', 2)),
                    'tax_insurance'         => $tax_insurance,
                    'salary_group'          => $e->salary_group,
                    'present_total'         => $present_total,
                ]);
                $total_success++;
            }else{
                $sr_not_set[] = [
                    'nin'       => $e->nin,
                    'name'      => $e->name,
                ];
            }
        }
        if(count($sr_not_set) > 0){
            if($total_success > 0){
                return response([
                    'msg'           => 'Some employees success paid but there are '.count($sr_not_set).' employees not yet set salary rule', 
                    'employee'      => $sr_not_set,
                ],
                422);
            }
            return response([
                'msg'           => 'All employee not yet set salary rule', 
            ], 422);
        }
        return 'All employee success paid';
    }

    public function index(Request $r)
    {
        return S::with(['emp', 'sr' => function($q){
            $q->where('status', '1');
        }])->where('month', $r->month)->where('year', $r->year)->latest()->get();
    }

    public function globalReport(Request $r)
    {
        $month_name = english_month_name($r->query("month"));
        $month = $r->query("month");
        $year = $r->query('year');
        $salaries = S::with('emp.pos', 'emp.dep')->where('month', $month)->where('year', $year)->get();
        $title = 'Global report period '.$month_name.' '.$year;
        Excel::create($title, function($excel) use ($year, $month, $salaries){
            $excel->setTitle('Lisun HRIS Global Report');
            $excel->setCreator('Lisun')->setCompany('Lisun');
            $excel->setDescription('Lisun HRIS Global Report');
            $excel->sheet('data', function($sheet) use ($year, $month, $salaries){
                $arr = [];
                foreach ($salaries as $a) {
                    $total_hari_kerja = Attendance::totalHariKerja($year, $month, $a->emp->id);
                    $work_total = Attendance::workTotalInMonth($year, $month, $a->emp->id);
                    $arr[]         = [
                        'NIN'                                               => $a->emp->nin,
                        'Seguranca ID'                                      => $a->emp->seguranca_social,
                        'Employee Name'                                     => $a->emp->name,
                        'Group'                                             => config('app.group', 'mix'),
                        'Department'                                        => $a->emp->dep->name,
                        'Job Title'                                         => $a->emp->pos->name,
                        'Basic Salary'                                      => $a->sr->basic_salary,
                        'Allowance'                                         => $a->sr->allowance,
                        'Days Work Total'                                   => $total_hari_kerja,
                        'Cuti Taken'                                        => '',
                        'Sick Leave take'                                   => '',
                        'Days Absent Total'                                 => $a->absent,
                        'Total Working Hours'                               => convertHour($work_total),
                        'Overtime Hours (x1.5)'                             => $a->ot_regular_in_hours,
                        'Overtime Hours (x2)'                               => $a->ot_holiday_in_hours,
                        'Total Overtime Amount (x1.5)'                      => $a->ot_regular,
                        'Total Overtime Hours (x2)'                         => $a->ot_holiday,
                        'Retention Number'                                  => '',
                        'Retention Amount'                                  => $a->sr->ritation,
                        'Incentive Amount'                                  => $a->sr->incentive,
                        'Total'                                             => $a->gross_salary,
                        'Registered 4% Seguranca Social (Behalf of Staff)'  => $a->seguranca,
                        'Deduct Company Tax 10%'                            => round($a->tax_insurance, 2),
                        'Cash Withdrawal'                                   => $a->sr->cash_reecipt,
                        'Deduct Absent $'                                   => $a->absent_punishment,
                        'Total To Pay $'                                    => $a->clear_salary,
                        'Seguransa Social 4% (Behalf of Company)'           => $a->seguranca,
                        'Declared Basic Salary Less Absence'                => '',

                    ];
                }
                $sheet->with($arr);
                $kolom = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB'];
                // set border to all active cell
                foreach ($kolom as $k) {
                    foreach (range(1, count($arr)+1) as $b) {
                        $sheet->cell($k.$b, function($cell){
                            $cell->setBorder('thin', 'thin', 'thin', 'thin');
                        });   
                    }
                }
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                });
                $ijo = ['G','H','P','Q','S','T','U'];
                foreach ($ijo as $k) {
                    $sheet->cell($k.'1', function($cell){
                        $cell->setBackground('#44bb33');
                    });
                }
                $kuning = ['V','W','X','Y'];
                foreach ($kuning as $k) {
                    $sheet->cell($k.'1', function($cell){
                        $cell->setBackground('#ffff33');
                    });
                }
                $sheet->cell('Z1', function($cell){
                    $cell->setBackground('#0044ff');
                });
                $sheet->prependRow(1, []);
                foreach ($ijo as $k) {
                    $sheet->cell($k.'1', '+');
                    $sheet->cell($k.'1', function($cell){
                        $cell->setBackground('#44bb33')->setBorder('thin', 'thin', 'thin', 'thin');
                    });
                }
                foreach ($kuning as $k) {
                    $sheet->cell($k.'1', '-');
                    $sheet->cell($k.'1', function($cell){
                        $cell->setBackground('#ffff33')->setBorder('thin', 'thin', 'thin', 'thin');
                    });
                }
                $sheet->mergeCells('AA1:AB1');
                $sheet->cell('AA1', 'Apply to form');
                $sheet->cell('AA1', function($cell){
                    $cell->setAlignment('center')->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->prependRow(1, ['GLOBAL REPORT']);
                $sheet->mergeCells('A1:C1');
            });
})->export('xlsx');
}
}

