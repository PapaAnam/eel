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
    private $dt;

    public function __construct()
    {
        // $this->dt = $this->data();
    }

    private function data($id = null)
    {
        $data = DB::table('salaries')
        ->join('employees', 'employees.id', '=', 'salaries.employee')
        ->join('positions', 'employees.position', '=', 'positions.id')
        ->join('sub_departments', 'sub_departments.id', '=', 'employees.department')
        ->join('departments', 'departments.id', '=', 'sub_departments.department')
        ->selectRaw('departments.name as d_name, positions.name as p_name, sub_departments.name as sd_name, employees.name as e_name, salaries.*')
        ->latest();
        if($id!=null)
            return $data->where('salaries.id', $id)->first();
        return $data->get();
    }

    public function index()
    {
        return view('payroll.index');
    }

    public function dt()
    {
        $data = array();
        $no   = 1;
        
        foreach ($this->dt as $d) {
            $data[] = [
                $no++,
                $d->d_name.'/'.$d->sd_name,
                $d->p_name,
                $d->e_name,
                english_date($d->created_at),
                month_name($d->month),
                $d->year,
                ''
            ];
        }
        return ['data'=>$data];
    }

    public function create(Request $r)
    {
        $total_day_in_month = cal_days_in_month(CAL_GREGORIAN, $r->month, $r->year);
        for($i=1; $i<=$total_day_in_month; $i++){
            $d[] = date('l', mktime(0, 0, 0, $r->month, $i, $r->year));
        }
        // return response(409);
        $E = E::where('department', $r->sub_department)->get();
        // return response($E, 409);
        foreach ($E as $e) {
            $exist = S::where([
                'employee'  => $e->id,
                'month'     => $r->month,
                'year'      => $r->year
            ])->count()>0;
            if($exist)
                return response('Department has been salaried', 409);
            S::create([
                'employee'       => $e->id,
                'month'          => $r->month,
                'year'           => $r->year,
                'position'       => $e->position,
                'sub_department' => $e->department
            ]);
        }

        return parent::created();
    }

    public function detail(Request $r)
    {
        $data = DB::table('salaries')
        ->join('employees', 'employees.id', '=', 'salaries.employee')
        ->join('sub_departments', 'sub_departments.id', '=', 'employees.department')
        ->join('positions', 'positions.id', '=', 'employees.position')
        ->where('salaries.id', $r->id)
        ->selectRaw('salaries.*, sub_departments.name as d_name, positions.name as p_name, positions.*, employees.name as e_name')
        ->first();
        $absence = DB::table('absences')
        ->join('employees', 'employees.id', '=', 'absences.employee')
        ->whereRaw('month(date)=\''.$data->month.'\'')
        ->get();
        $absences = null;
        $p = 0; $s = 0; $al = 0; $o = 0;
        foreach ($absence as $a) {
            if($a->status==1)
                $p++;
            if($a->status==2)
                $s++;
            if($a->status==3)
                $al++;
            if($a->status==4)
                $o++;
        }
        $absences = [
            'present'               => $p,
            'sick'                  => $s,
            'absent'                => $al,
            'official_travel'       => $o
        ];
        $over_work = DB::table('over_works')
        ->join('employees', 'employees.id', '=', 'over_works.employee')
        ->selectRaw('sum(pay) as over_work')
        ->whereRaw('month(date)=\''.$data->month.'\'')
        ->first();
        $oper = [
            'data'      => $data,
            'absences'  => (object) $absences,
            'over_work' => $over_work->over_work
        ];
        // dd($oper);
        return view('payroll.detail', $oper);
    }

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
                foreach($attendances as $a){
                    $over_time += $a->over_time_in_money;
                }
                // return $over_time;
                S::updateOrCreate([
                    'employee'      => $e->id,
                    'month'         => $r->month,
                    'year'          => $r->year,
                ], [
                    'salary_rule'   => $sr->id,
                    'department'    => $e->dep->id,
                    'position'      => $e->pos->id,
                    'over_time'     => $over_time,
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


