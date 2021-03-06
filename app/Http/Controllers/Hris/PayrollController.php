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
use App\Models\Hris\Overtime as O;

class PayrollController extends Controller
{

    private $sr_not_set = false;
    private $total_success = 0;

    private function payThat($emp, $year, $month){
        foreach ($emp as $e) {
            if(SalaryRule::where('employee', $e->id)->where('status', '1')->exists()){
                $sr = SalaryRule::with('salaryGroup')->where('employee', $e->id)->where('status', '1')->first();
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
                }

                $sg = $sr->salaryGroup;

                $ot_holiday_money = 0;
                $ot_holiday_hours = 0;
                $ot_event_holiday_money = 0;
                $ot_event_holiday_hours = 0;
                $ot_regular_money = 0;
                $ot_regular_in_hours = 0;
                $total_ot_holiday = 0;
                if($sg){
                    $o = O::where('employee_id', $e->id)
                    ->where('year', $year)
                    ->where('month', $month)
                    ->first();
                    $hariPembagi = 22;
                    if($sr->salary_type == 'daily'){
                        $hariPembagi = 1;
                    }
                    // dd($hariPembagi);
                    if($sg->ot_holiday == 1){
                        if(!is_null($o)){
                            $ot_holiday_money = $sr->basic_salary/$hariPembagi/8*2*$o->ot_holiday_in_hours;
                            $total_ot_holiday = $ot_holiday_money;
                            $ot_holiday_hours = $o->ot_holiday_in_hours;
                            // return $month;
                        }else{
                            // menghitung ot holiday
                            $oth = Attendance::overTimeSundayInMonth($year, $month, $e->id);
                            $ot_holiday_money = $sr->basic_salary/$hariPembagi/8*2*$oth['in_reg'];
                            $ot_holiday_hours = $oth['in_hours'];
                            // menghitung ot event holiday
                            $oteh = Attendance::overTimeEventInMonth($year, $month, $e->id);
                            $ot_event_holiday_money = $sr->basic_salary/$hariPembagi/8*$oteh['in_reg'];
                            $ot_event_holiday_hours = $oteh['in_hours'];
                            $total_ot_holiday = $ot_holiday_money + $ot_event_holiday_money;
                        }
                    }
                    if($sg->ot_regular == 1){
                        if(!is_null($o)){
                            $ot_regular_money = $sr->basic_salary/$hariPembagi/8*1.5*$o->ot_regular_in_hours;
                            $ot_regular_in_hours = $o->ot_regular_in_hours;
                        }else{
                            // menghitung ot regular
                            $otr = Attendance::overTimeRegularInMonth($year, $month, $e->id);
                            $ot_regular_money = $sr->basic_salary/$hariPembagi/8*1.5*$otr['in_reg'];
                            $ot_regular_in_hours = $otr['in_hours'];
                        }
                    }
                }

                $absent = 0;
                $absent_punishment = 0;

                // menghitung absent
                if($sr->salary_type != 'daily'){
                    $absent = Attendance::absent($year, $month, $e->id);
                    $absent_punishment = $absent * ($sr->basic_salary / 22);
                }

                $present_total = Attendance::presentTotalInMonth($e->id, $year, $month);
                
                S::updateOrCreate([
                    'employee'      => $e->id,
                    'month'         => $month,
                    'year'          => $year,
                ], [
                    'salary_rule'           => $sr->id,
                    'department'            => $e->dep->id,
                    'position'              => $e->pos->id,
                    'ot_regular'            => round($ot_regular_money, env('ROUND', 2)),
                    'ot_holiday'            => round($total_ot_holiday, env('ROUND', 2)),
                    'ot_regular_in_hours'   => $ot_regular_in_hours,
                    'ot_holiday_in_hours'   => $ot_holiday_hours,
                    'absent'                => $absent,
                    'absent_punishment'     => round($absent_punishment, env('ROUND', 2)),
                    'present_total'         => $present_total,
                    'seguranca_id'          => $e->seguranca_social,
                ]);
                $this->total_success++;
            }else{
                $this->sr_not_set[] = [
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
        $emp = E::with(['dep', 'pos'])->whereNull('non_active')->get();
        $this->payThat($emp, $r->year, $r->month);
        if(count($this->sr_not_set) > 0){
            if($this->total_success > 0){
                return response([
                    'msg'           => 'Some employees success paid but there are '.count($this->sr_not_set).' employees not yet set salary rule', 
                    'employee'      => $this->sr_not_set,
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
                $s = S::with(['emp', 'sr.salaryGroup'])->where('year', $r->year)->where('employee', $r->query('employee'))->orderBy('month')->get();
            }else{
                $s = S::with(['emp', 'sr.salaryGroup'])->where('month', $r->month)->where('year', $r->year)->where('employee', $r->query('employee'))->orderBy('month')->get();
            }
        }else{
            $s = S::with(['emp'=>function($q){
                $q->whereNull('non_active');
            }, 'sr.salaryGroup'])->where('month', $r->month)->where('year', $r->year)->latest()->get()->whereNotIn('emp', [null])->values();
        }
        return $s;
    }

    public function globalReport(Request $r)
    {
        $month_name = english_month_name($r->query("month"));
        $month = $r->query("month");
        $year = $r->query('year');
        $salaries = S::with(['emp'=>function($q){
            $q->with('dep', 'pos')->whereNull('non_active');
        }, 'sr'])->where('month', $month)->where('year', $year)->get();
        $title = 'Global report period '.$month_name.' '.$year;
        // dd($salaries[0]);
        Excel::create($title, function($excel) use ($year, $month, $salaries){
            $excel->setTitle('Lisun HRIS Global Report');
            $excel->setCreator('Lisun')->setCompany('Lisun');
            $excel->setDescription('Lisun HRIS Global Report');
            $excel->sheet('data', function($sheet) use ($year, $month, $salaries){
                $arr = [];
                foreach ($salaries as $a) {
                    if(!is_null($a->emp)){
                        $total_hari_kerja = Attendance::totalHariKerja($year, $month, $a->emp->id);
                        $work_total = Attendance::workTotalInMonth($year, $month, $a->emp->id);
                        $arr[]         = [
                            /* A */'NIN'                                               => $a->emp->nin,
                            /* B */'Seguranca ID'                                      => $a->emp->seguranca_social,
                            /* C */'BRI Account'                                       => $a->emp->bri_account,
                            /* D */'Employee Name'                                     => $a->emp->name,
                            /* E */'Group'                                             => config('app.group', 'mix'),
                            /* F */'Department'                                        => $a->emp->dep->name,
                            /* G */'Job Title'                                         => $a->emp->pos->name,
                            /* H */'Basic Salary'                                      => $a->sr->basic_salary,
                            /* I */'Allowance'                                         => $a->sr->allowance,
                            /* J */'Days Work Total'                                   => $total_hari_kerja,
                            /* K */'Cuti Taken'                                        => '',
                            /* L */'Sick Leave take'                                   => '',
                            /* M */'Days Absent Total'                                 => $a->absent,
                            /* N */'Total Working Hours'                               => convertHour($work_total),
                            /* O */'Overtime Hours (x1.5)'                             => $a->ot_regular_in_hours,
                            /* P */'Overtime Hours (x2)'                               => $a->ot_holiday_in_hours,
                            /* Q */'Total Overtime Amount (x1.5)'                      => $a->ot_regular,
                            /* R */'Total Overtime Hours (x2)'                         => $a->ot_holiday,
                            /* S */'Food Allowance'                                    => $a->sr->eat_cost,
                            /* T */'Retention Number'                                  => '',
                            /* U */'Retention Amount'                                  => $a->sr->ritation,
                            /* V */'Incentive Amount'                                  => $a->sr->incentive,
                            /* W */'THR'                                               => $a->sr->thr,
                            /* X */'ETC'                                               => $a->sr->etc,
                            /* Y */'Total'                                             => $a->gross_salary,
                            /* Z */'Registered 4% Seguranca Social (Behalf of Staff)'  => $a->seguranca,
                            /* AA */'Deduct Company Tax 10%'                            => round($a->tax_insurance, 2),
                            /* AB */'Cash Withdrawal'                                   => $a->sr->cash_receipt,
                            /* AC */'Deduct Absent $'                                   => $a->absent_punishment,
                            /* AD */'Total To Pay $'                                    => $a->clear_salary,
                            /* AE */'Seguransa Social 4% (Behalf of Company)'           => $a->seguranca,
                            /* AF */'Declared Basic Salary Less Absence'                => '',

                        ];
                    }
                }
                $sheet->with($arr);
                $kolom = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB', 'AC','AD','AE','AF'];
                
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
                $ijo = ['H','P','Q','S','T','U', 'V','W','X'];
                foreach ($ijo as $k) {
                    $sheet->cell($k.'1', function($cell){
                        $cell->setBackground('#44bb33');
                    });
                }
                $kuning = ['Y','Z','AA','AB'];
                foreach ($kuning as $k) {
                    $sheet->cell($k.'1', function($cell){
                        $cell->setBackground('#ffff33');
                    });
                }
                $sheet->cell('AC1', function($cell){
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
                $sheet->mergeCells('AC1:AD1');
                $sheet->cell('AC1', 'Apply to form');
                $sheet->cell('AC1', function($cell){
                    $cell->setAlignment('center')->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->prependRow(1, ['GLOBAL REPORT']);
                $sheet->mergeCells('A1:C1');
            });
})->export('xlsx');
}
}

