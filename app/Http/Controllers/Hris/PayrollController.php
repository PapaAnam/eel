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

    private $sr_not_set = false;
    private $total_success = 0;

    private function payThat($emp, $year, $month){
        foreach ($emp as $e) {
            if(SalaryRule::where('employee', $e->id)->where('status', '1')->exists()){
                $sr = SalaryRule::where('employee', $e->id)->where('status', '1')->first();
                $over_time = 0;
                $attendances = Attendance::where('employee', $e->id)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->get();
                foreach ($attendances as $a) {
                    if($a->is_holiday && $a->status == 'Absent'){
                        Attendance::find($a->id)->update([
                            'status'    => null,
                        ]);
                    }
                    // memflatkan pekerja standart yg <= 17:25
                    // if(strtotime($a->created_at.' '.$a->out) <= strtotime($a->created_at.' 17:25:00') && $sr->salary_type == 'standart'){
                    //     Attendance::find($a->id)->update([
                    //         'out'    => '17:00:00',
                    //     ]);
                    // }
                }

                // menghitung ot holiday
                $oth = Attendance::overTimeSundayInMonth($year, $month, $e->id);
                $ot_holiday_money = $sr->basic_salary/22/8*2*$oth['in_reg'];
                $ot_holiday_hours = $oth['in_hours'];

                // menghitung ot holiday
                $oteh = Attendance::overTimeEventInMonth($year, $month, $e->id);
                // if($e->id == 8){
                //     return $oth;
                // }
                $ot_event_holiday_money = $sr->basic_salary/22/8*$oteh['in_reg'];
                $ot_event_holiday_hours = $oteh['in_hours'];

                // menghitung ot regular
                $otr = Attendance::overTimeRegularInMonth($year, $month, $e->id);
                $ot_regular = $sr->basic_salary/22/8*1.5*$otr['in_reg'];

                // menghitung absent
                $absent = Attendance::absent($year, $month, $e->id);
                $absent_punishment = $absent * ($sr->basic_salary / 22);

                // menghitung tax_insurance
                $gross_salary = ($sr->basic_salary + $sr->allowance + $ot_holiday_money + $ot_event_holiday_money + $ot_regular + $sr->incentive + $sr->eat_cost + $sr->ritation + $sr->rent_motorcycle);
                $tax_insurance = $gross_salary > 500 ? ($gross_salary - 500) * 10 / 100 : 0;

                $present_total = Attendance::presentTotalInMonth($e->id, $year, $month);
                
                S::updateOrCreate([
                    'employee'      => $e->id,
                    'month'         => $month,
                    'year'          => $year,
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
                    'seguranca_id'          => $e->seguranca_social,
                ]);
                $this->total_success++;
            }else{
                $this->sr_not_set = true;
                $sr_not_set[] = [
                    'nin'       => $e->nin,
                    'name'      => $e->name,
                ];
            }
        }
    }

    public function pay(Request $r)
    {
        $year       = $r->year;
        $month      = $r->month;
        $employee   = $r->employee;
        $emp = E::where('id', $employee)->get();
        if($month == 'all'){
            foreach (range(1,12) as $m) {
                $this->payThat($emp, $year, $m);
            }
        }else{
            $this->payThat($emp, $year, $month);
        }
        if($this->sr_not_set){
            return response('Salary Rule not set yet', 419);
        }
        return 'Pay success';
    }

    public function payAll(Request $r)
    {
        $emp = E::with(['dep', 'pos'])->get();
        $sr_not_set = [];
        $this->payThat($emp, $r->year, $r->month);
        if(count($sr_not_set) > 0){
            if($this->total_success > 0){
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
        $s = [];
        if($r->query('employee')){
            if($r->query('month') == 'all'){
                S::where('month', '0')->orWhere('month', 0)->delete();
                $s = S::with(['emp', 'sr', 'sg'])->where('year', $r->year)->where('employee', $r->query('employee'))->orderBy('month')->get();
            }else{
                $s = S::with(['emp', 'sr', 'sg'])->where('month', $r->month)->where('year', $r->year)->where('employee', $r->query('employee'))->orderBy('month')->get();
            }
        }else{
            $s = S::with(['emp', 'sr', 'sg'])->where('month', $r->month)->where('year', $r->year)->latest()->get();
        }
        return $s;
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

