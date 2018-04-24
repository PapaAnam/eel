<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Hris\Position            as P;
use App\Models\Hris\Absence             as A;
use App\Models\Hris\SubDepartment       as SD;
use App\Models\Hris\Salary              as S;
use App\Models\Hris\Department          as D;
use App\Models\Hris\Employee            as E;
use App\Models\Hris\Work                as W;
use App\Models\Hris\SalaryRule;
use App\Models\Hris\Attendance;

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

                // menghitung work total
                $work_total = $attendances->sum(function($item){
                    if($item['work_total_in_hours'] !== '-'){
                        return $item['work_total_in_hours'];
                    }
                });

                // // menghitung ot holiday
                $oth = Attendance::overTimeHolidayInMonth($r->year, $r->month, $e->id);
                $ot_holiday_money = $sr->basic_salary/22/8*2*$oth['in_reg'];
                $ot_holiday_hours = $oth['in_hours'];
                // foreach ($attendances as $a) {
                //     if($a->is_holiday){
                //         $ot_holiday_money += $a->over_time_in_money;
                //         $ot_holiday_hours += $a->over_time_in_hours;
                //     }
                // }

                // menghitung ot regular
                $otr = Attendance::overTimeRegularInMonth($r->year, $r->month, $e->id);
                $ot_regular = $sr->basic_salary/22/8*1.5*$otr['in_reg'];

                // menghitung absent
                $absent = Attendance::absent($r->year, $r->month, $e->id);
                $absent_punishment = $absent * ($sr->basic_salary / 22);
                
                S::updateOrCreate([
                    'employee'      => $e->id,
                    'month'         => $r->month,
                    'year'          => $r->year,
                ], [
                    'salary_rule'           => $sr->id,
                    'department'            => $e->dep->id,
                    'position'              => $e->pos->id,
                    'ot_regular'            => round($ot_regular, env('ROUND', 2)),
                    'ot_holiday'            => round($ot_holiday_money, env('ROUND', 2)),
                    'ot_regular_in_hours'   => $otr['in_hours'],
                    'ot_holiday_in_hours'   => $ot_holiday_hours,
                    'absent'                => $absent,
                    'absent_punishment'     => round($absent_punishment, env('ROUND', 2)),
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

    public function filter(Request $r)
    {
        return S::with(['emp', 'sr' => function($q){
            $q->where('status', '1');
        }])->where('month', $r->month)->where('year', $r->year)->latest()->get();
    }
}


