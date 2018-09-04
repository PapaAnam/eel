<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Hris\Position            as P;
use App\Models\Hris\Attendance          as A;
use App\Models\Hris\SubDepartment       as SD;
use App\Models\Hris\Employee            as E;
use App\Models\Hris\OverTime            as O;
use App\Models\Hris\LeavePeriod         as LP;
use App\Models\Hris\Department          as D;
use App\Models\Hris\SalaryRule          as SR;
use App\Models\Absensi\CheckInOut;
use App\Models\Hris\Calendar;
use App\Models\Hris\Log;
use App\User;
use Excel;
use Storage;

class AttendanceController extends Controller
{
    public function getData($id = null, $date = null)
    {
        // return A::where('created_at', $date)->where('employee', E::take(1)->first()->id)->first();
        if($date)
            return A::byDate($date);
        return A::with(['emp'=>function($q){
            $q->whereNull('non_active_at');
        }])->where('created_at', date('Y-m-d'))->get();
    }

    public function x100c()
    {
        return CheckInOut::with('UserInfo')->get();
    }

    public function index(Request $r)
    {
        return A::firstOrCreate([
            'employee'      => $r->query('employee'),
            'created_at'    => $r->query('created_at')
        ], [
            'status'        => 'Absent',
        ]);
    }

    private $rules = [
        'status'            => 'required'
    ];

    private function already_absence($emp, $date)
    {
        return A::whereRaw('employee = \''.$emp.'\' and date(created_at)=\''.$date.'\'')->count()>0;
    }

    public function create_multiply(Request $r)
    {
        $sd = [
            'status'        => 'present',
            'created_at'    => $r->created_at
        ];
        $sd = array_add($sd, $r->time, $r->time_oclock);
        $sd = array_add($sd, 'employee', '');
        if($r->department=='all'){
            foreach(E::all() as $e){
                $sd['employee'] = $e->id;
                if($this->already_absence($e->id, $r->created_at)){
                    A::whereRaw('employee = \''.$e->id.'\' and date(created_at)=\''.$r->created_at.'\'')
                    ->update($sd);
                }else{
                    A::create($sd);
                }
            }
            // parent::create_activity('Added new multiple attendance (All Department)');
        }else{
            if($r->sub_department=='all'){
                $errorMsg = [];
                foreach (SD::get_by_department($r->department) as $sub) {
                    $E = E::get_by_department($sub->id);
                    if(count($E)){
                        foreach ($E as $e) {
                            $sd['employee'] = $e->id;
                            if($this->already_absence($e->id, $r->created_at)){
                                A::whereRaw('employee = \''.$e->id.'\' and date(created_at)=\''.$r->created_at.'\'')
                                ->update($sd);
                            }else{
                                A::create($sd);
                            }
                        }   
                    }else{
                        array_push($errorMsg, 'No Employee in Sub Department '.$sub->name.'!!!<br>');
                    }
                }
                if(count($errorMsg))
                    return response('A part of sub department has been attendance because<br>'.implode('',$errorMsg), 409);
            }else{
                $E = E::get_by_department($r->sub_department);
                if(count($E)){
                    foreach ($E as $e) {
                        $sd['employee'] = $e->id;
                        if($this->already_absence($e->id, $r->created_at)){
                            A::whereRaw('employee = \''.$e->id.'\' and date(created_at)=\''.$r->created_at.'\'')
                            ->update($sd);
                        }else{
                            A::create($sd);
                        }
                    }   
                }else{
                    return response('No Employee to this Sub Department!!!', 409);
                }
            }
        }
        // return parent::created();
    }

    public function update($id, Request $r)
    {
        $tempId = $id;
        $break          = $r->break;
        $end_break      = $r->end_break;
        $out            = $r->out;
        $enter          = $r->enter;
        $value = [
            'break'         => $break,
            'end_break'     => $end_break,
            'out'           => $out,
            'enter'         => $enter,
            'status'        => $r->status,
        ];
        if(is_numeric($id)){
            A::find($id)->update($value); 
        }else{
            $tempId = A::updateOrCreate([
                'employee'      => $r->query('employee'),
                'created_at'    => $r->query('date'),
            ], $value);
            $tempId = $tempId->id;
        }
        $user = User::find($r->query('user_id'));
        $action = 'edit';
        $value = json_encode($value);
        $table_name = 'hris_attendances';
        Log::create([
            'user_id'=>$r->query('user_id'),
            'table_name'=>$table_name,
            'action'=>$action,
            'value'=>$value,
            'target_id'=>$tempId,
            'description'=>'user '.$user->username.' '.$action.' in '.$table_name.' with id '.$id.' and with value '.$value,
        ]);
        return 'Attendance updated';
    }

    public function create(Request $r)
    {
        $rules             = $this->rules;
        $rules['employee'] = 'required';
        $e_from = E::find($r->employee)->e_from;
        if($e_from=='Local')
            $e_from = 1;
        else
            $e_from = 2;
        if(A::whereRaw('employee = \''.$r->employee.'\' and date(created_at)=\''.$r->created_at.'\'')->count()>0){
            return response('Employee already attendance!!!', 409);
        }
        if($r->status==1){
            $rules['enter'] = 'required';
            $this->validate($r, $rules);
        }else if($r->status==3){

        }else{
            $status = null;
            if($r->status==2)
                $status = 'sick';
            else if($r->status==5)
                $status = 'father_leave';
            else if($r->status==6)
                $status = 'holiday';
            else if($r->status==7)
                $status = 'special_permit';
            else if($r->status==8)
                $status = 'pregnancy';
            $exist = LP::where([
                'employee' => $r->employee,
                'year'     => date('Y')
            ])->count()>0;
            if($exist){
                $LP = LP::where(array(
                    'employee' => $r->employee,
                    'year'     => date('Y')
                ))
                ->first();
                if(LP::find($e_from)->$status-$LP->$status<=0){
                    return response(title_case(str_replace('_', ' ', $status)).' reached limit is '.$LP->$status, 409);
                }
                LP::where([
                    'employee' => $r->employee,
                    'year'     => date('Y')
                ])
                ->update([
                    $status=> ++$LP->$status
                ]);
            }else{
                LP::create([
                    $status    => 1,
                    'employee' => $r->employee,
                    'year'     => date('Y')
                ]);
            }
        }
        $sd = [
            'employee'      => $r->employee,
            'status'        => $r->status,
            'created_at'    => $r->created_at,
            'enter'         => $r->enter
        ];
        A::create($sd);
        // parent::create_activity('Added new attendance');
        // return parent::created();
    }

    public function api($id, Request $r)
    {
        if(is_numeric($id)){
            return A::with('emp')->where('id', $id)->first();
        }
        $date = $r->query('date');
        $libur = Calendar::where('month', substr($date, 5, 2))
        ->where('date', substr($date, 8, 2))
        ->exists() || date('l', strtotime($date)) === 'Sunday';
        $e = E::find($r->query('employee'));
        return [
            "id"                        => $id,
            "employee"                  => $r->query('employee'),
            "created_at"                => $r->query('date'),
            "enter"                     => null,
            "break"                     => null,
            "end_break"                 => null,
            "out"                       => null,
            "status"                    => 'Absent',
            "over_time_in_week"         => null,
            "work_total_in_week"        => null,
            "stat"                      => null,
            "work_total"                => null,
            "over_time"                 => null,
            "work_total_in_hours"       => null,
            "is_holiday"                => null,
            "over_time_in_hours"        => null,
            "over_time_in_money"        => null,
            "day"                       => date('l', strtotime($r->query('date'))),
            "emp"                       => $e,
        ];
    }

    public function break(Request $r)
    {
        $id = $r->id;
        $data = $this->data($id);
        $oper = array(
            'data'          => $data
        );
        return view('hris.attendances.break', $oper);
    }

    public function store(Request $r)
    {
        $r->validate([
            'status'        => 'required',
            'created_at'    => 'required|date_format:Y-m-d',
            'enter'         => 'required|date_format:"H:i:s"',
        ]);
        A::updateOrCreate([
            'created_at'    => $r->created_at,
            'employee'      => $r->employee,
        ], [
            'enter'         => $r->enter,
            'status'        => $r->status,
        ]);
        return 'Attendance success created';
    }

    public function remove(Request $r)
    {
        $A = A::find($r->id);
        if($A->status==1){
        }else if($A->status==3){

        }else if($A->status==4){

        }else{
            $status = null;
            if($A->status==2)
                $status = 'sick';
            else if($A->status==5)
                $status = 'father_leave';
            else if($A->status==6)
                $status = 'holiday';
            else if($A->status==7)
                $status = 'special_permit';
            else if($A->status==8)
                $status = 'pregnancy';
            $LP = LP::where(array(
                'employee' => $A->employee,
                'year'     => date('Y')
            ))
            ->first();
            LP::where([
                'employee' => $A->employee,
                'year'     => date('Y')
            ])
            ->update([
                $status=> --$LP->$status
            ]);
            if($LP->special_permit==0&&$LP->holiday==0&&$LP->father_leave==0&&$LP->sick==0&&$LP->pregnancy==0)
                $LP->delete();
        }
        $A->delete();

        // parent::create_activity('Deleted attendance');
        // return parent::deleted();
    }

    public function delete($id)
    {
        A::find($id)->delete();
        return 'Attendance deleted';
    }

    public function upload_attendance(Request $r)
    {
        $this->validate($r, ['attendance_excel'=>'required|mimes:xls,xlsx']);
        $file_path = $r->file('attendance_excel')->store('attendances');
        return response()->json([
            'success'   => 'file has been uploaded', 
            'file_name' => str_replace('attendances/', '', $file_path)
        ], 200);
    }

    public function create_by_excel(Request $r)
    {
        $rows = Excel::load('public\storage\attendances\\'.$r->attendance_excel)->get();
        $datas = [];
        $rows->each(function($row){
            $created_at = $row->created_at->format('Y-m-d');
            if(E::where('nin', $row->employee)->count()){
                $re = E::where('nin', $row->employee)->first()->id;
                A::updateOrCreate([
                   'created_at' => $created_at, 
                   'employee'   => $re 
               ], [
                'enter'      => is_null($row->enter) ? '00:00:00' : $row->enter->format('H:i:s'),
                'break'      => is_null($row->break) ? '00:00:00' : $row->break->format('H:i:s'),
                'end_break'  => is_null($row->end_break) ? '00:00:00' : $row->end_break->format('H:i:s'),
                'out'        => is_null($row->out) ? '00:00:00' : $row->out->format('H:i:s'),
                'status'     => $row->status
            ]);
            }
        });
        return response('Import and attendance success');
    }

    #EXPORT

    public function toPrint(Request $r)
    {
        return view('hris.attendances.export.print', [
            'data' => A::byDate($r->query('date'))
        ]);
    }

    public function pdf()
    {
        // parent::check_authority('attendance');
        // return parent::pdfs('hris.attendances.export', $this->data(), true);
    }

    public function excel(Request $r)
    {
        Excel::create(config('app.company_name').' HRIS Attendance '.$r->query('date'), function($excel) use ($r){
            $excel->setTitle(config('app.company_name').' HRIS Attendance per date');
            $excel->setCreator(config('app.company_name'))->setCompany(config('app.company_name'));
            $excel->setDescription(config('app.company_name').' HRIS Attendance per date');
            $excel->sheet('data', function($sheet) use ($r){
                $datas = [];
                $no = 1;
                $cells = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
                foreach ($cells as $c) {
                    $sheet->setBorder($c.($no), 'thin');
                }
                foreach (A::byDate($r->query('date')) as $d) {
                    foreach ($cells as $c) {
                        $sheet->setBorder($c.($no+1), 'thin');
                    }
                    $arr        = [
                        '#'             => $no++,
                        'Employee'      => '('.$d->emp->nin.') '.$d->emp->name,
                        'Date'          => $d->created_at,
                        'Status'        => $d->status,
                        'Enter'         => $d->enter,
                        'Break'         => $d->break,
                        'End Break'     => $d->end_break,
                        'Out'           => $d->out,
                        'Work Total'    => $d->work_total
                    ];
                    array_push($datas, $arr);
                }
                $sheet->with($datas);
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                });
                $sheet->prependRow(1, ['Attendance '.$r->query('date')]);
                $sheet->mergeCells('A1:I1');
                $sheet->cell('A1', function($cell){
                    $cell->setAlignment('center')->setBackground('#999999')->setFontSize(16)->setFontWeight('bold');
                });
            });
        })->export('xlsx');
    }

    public function storeMulti(Request $r)
    {
        $r->validate([
            'dep'           => 'required',
            'created_at'    => 'required|date_format:Y-m-d',
            'time_at'       => 'required|date_format:"H:i:s"',
        ]);
        if(!$r->subdep || $r->subdep == 'all'){
            $d = [];
            $depts = D::with('depts.depts')->where('id', $r->dep)->get();
            $d[] = $depts[0]->id;
            if(count($depts[0]->depts) > 0){
                foreach ($depts[0]->depts as $dep) {
                    $d[] = $dep->id;
                    if(count($dep->depts) > 0){
                        foreach ($dep->depts as $subdep) {
                            $d[] = $subdep->id;
                        }
                    }
                }
            }
            $employees = E::whereIn('department', $d)->get();
            foreach ($employees as $e) {
                A::updateOrCreate([
                    'employee'      => $e->id,
                    'created_at'    => $r->created_at,
                ], [
                    $r->time        => $r->time_at
                ]);
            }
        }else if($r->subdep || $r->subsubdep){
            $d      = [];
            $depts  = D::with('depts')->where('id', $r->subdep)->get();
            $d[]    = $depts[0]->id;
            if(count($depts[0]->depts) > 0){
                foreach ($depts[0]->depts as $dep) {
                    $d[] = $dep->id;
                }
            }
            $employees = E::whereIn('department', $d)->get();
            foreach ($employees as $e) {
                A::updateOrCreate([
                    'employee'      => $e->id,
                    'created_at'    => $r->created_at,
                ], [
                    $r->time        => $r->time_at
                ]);
            }
        }
        return 'Attendance multi success';
    }

    public function storeExcel(Request $r)
    {
        Storage::deleteDirectory('attendances');
        $file_path = $r->file('attendance_excel')->store('public/attendances');
        $file_path = explode('/', $file_path);
        $file_name = end($file_path);
        $rows = Excel::load('public/storage/attendances/'.$file_name)->get();
        $datas = [];
        $rows->each(function($row){
            $created_at = is_string($row->created_at) ? $row->created_at : $row->created_at->format('Y-m-d');
            if(E::where('nin', $row->employee_nin)->count()){
                $employee = E::where('nin', $row->employee_nin)->first();
                $a = A::where('created_at', $created_at)->where('employee', $employee->id)->first();
                $out = is_null($row->out) ? '00:00:00' : (is_string($row->out) ? $row->out : $row->out->format('H:i:s'));
                $sr = SR::where('employee', $employee->id)->where('status', '1')->first();
                if(!is_null($sr)){
                    if($sr->salary_type == 'driver' || $sr->salary_type == 'sales'){
                        $out = '17:00:00';
                    }   
                }
                if(is_null($a)){
                    A::create([
                        'created_at' => $created_at, 
                        'employee'   => $employee->id ,
                        'enter'      => is_null($row->enter) ? '00:00:00' : (is_string($row->enter) ? $row->enter : $row->enter->format('H:i:s')),
                        'break'      => is_null($row->break) ? '00:00:00' : (is_string($row->break) ? $row->break : $row->break->format('H:i:s')),
                        'end_break'  => is_null($row->end_break) ? '00:00:00' : (is_string($row->end_break) ? $row->end_break : $row->end_break->format('H:i:s')),
                        'out'        => $out,
                        'status'     => ucwords($row->status),
                    ]);
                }else{
                    if(is_null($a->enter) or $a->enter == '00:00:00'){
                        A::create([
                            'created_at' => $created_at, 
                            'employee'   => $employee->id ,
                            'enter'      => is_null($row->enter) ? '00:00:00' : (is_string($row->enter) ? $row->enter : $row->enter->format('H:i:s')),
                            'break'      => is_null($row->break) ? '00:00:00' : (is_string($row->break) ? $row->break : $row->break->format('H:i:s')),
                            'end_break'  => is_null($row->end_break) ? '00:00:00' : (is_string($row->end_break) ? $row->end_break : $row->end_break->format('H:i:s')),
                            'out'        => $out,
                            'status'     => ucwords($row->status),
                        ]);
                    }
                }
            }
        });
        return response('Import and attendance success');
    }

    public function example()
    {
        Excel::create('attendance_format_example', function($excel){
            $excel->sheet('data', function($sheet){
                $emp = E::all()->transform(function($item){
                    $status = array_random([
                        'Present',
                        'Sick',
                        'Absent',
                        'Father Leave',
                        'Holiday',
                        'Special Permit',
                        'Pregnancy',
                        'Over Time',
                    ]);
                    return [
                        'employee_nin'  => $item->nin,
                        'employee_name' => $item->name,
                        'enter'         => $status === 'Present' ? '08:30:00' : '',
                        'break'         => $status === 'Present' ? '12:00:00' : '',
                        'end_break'     => $status === 'Present' ? '12:30:00' : '',
                        'out'           => $status === 'Present' ? '18:00:00' : '',
                        'status'        => $status,
                        'created_at'    => substr((String) now(), 0, 10),
                    ];
                });
                $sheet->with($emp);
                $sheet->cell('I2', 'Catatan');
                $sheet->cell('I3', 'Hanya gunakan status berikut');
                $sheet->cell('I4', ucwords('present'));
                $sheet->cell('I5', ucwords('over time'));
                $sheet->cell('I6', ucwords('sick'));
                $sheet->cell('I7', ucwords('absent'));
                $sheet->cell('I8', ucwords('father leave'));
                $sheet->cell('I9', ucwords('holiday'));
                $sheet->cell('I10', ucwords('special permit'));
                $sheet->cell('I11', ucwords('pregnancy'));

            });
        })->download('xlsx');
    }

    public function filter(Request $r)
    {
        return A::inMonth($r->query('employee'), $r->query('year'), $r->query('month'));
    }

    public function printByEmployee(Request $r)
    {
        $data = A::inMonth($r->query('employee'), $r->query('year'), $r->query('month'));
        return view('hris.attendances.export.print', [
            'data' => $data
        ]);
    }

    public function excelByEmployee(Request $r)
    {
        $emp = E::find($r->query('employee'));
        Excel::create(config('app.company_name').' HRIS Attendance ['.$emp->nin.'] '.$emp->name.' '.$r->query('year').'-'.$r->query('month'), function($excel) use ($r, $emp){
            $excel->setTitle(config('app.company_name').' HRIS Attendance per employee');
            $excel->setCreator(config('app.company_name'))->setCompany(config('app.company_name'));
            $excel->setDescription(config('app.company_name').' HRIS Attendance per employee');
            $excel->sheet('data', function($sheet) use ($r, $emp){
                $datas = [];
                $data = A::inMonth($r->query('employee'), $r->query('year'), $r->query('month'));
                $no = 1;
                $cells = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
                foreach ($cells as $c) {
                    $sheet->setBorder($c.($no), 'thin');
                }
                foreach ($data as $d) {
                    foreach ($cells as $c) {
                        $sheet->setBorder($c.($no+1), 'thin');
                    }
                    $arr = null;
                    if(is_array($d)){
                        $arr        = [
                            '#'             => $no++,
                            'Day'           => date('l', strtotime($d['created_at'])),
                            'Date'          => $d['created_at'],
                            'Status'        => $d['status'],
                            'Enter'         => $d['enter'],
                            'Break'         => $d['break'],
                            'End Break'     => $d['end_break'],
                            'Out'           => $d['out'],
                            'Work Total'    => $d['work_total']
                        ];   
                    }else{
                        $arr        = [
                            '#'             => $no++,
                            'Day'           => date('l', strtotime($d->created_at)),
                            'Date'          => $d->created_at,
                            'Status'        => $d->status,
                            'Enter'         => $d->enter,
                            'Break'         => $d->break,
                            'End Break'     => $d->end_break,
                            'Out'           => $d->out,
                            'Work Total'    => $d->work_total
                        ];   
                    }
                    array_push($datas, $arr);
                }
                $sheet->with($datas);
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                });
                $sheet->prependRow(1, [
                    '['.$emp->nin.'] '.$emp->name.' '.$r->query('year').'-'.$r->query('month')
                ]);
                $sheet->mergeCells('A1:I1');
                $sheet->cell('A1', function($cell){
                    $cell->setAlignment('center')->setBackground('#999999')->setFontSize(16)->setFontWeight('bold');
                });
            });
        })->export('xlsx');
    }

    public function workTotal(Request $r)
    {
        return convertHour(A::workTotalInMonth($r->query('year'), $r->query('month'), $r->query('employee')));
    }

    // update satu2

    public function updateEnter($id, Request $r)
    {
        $user = User::find($r->query('user_id'));
        $action = 'edit enter at';
        $value = $r->enter;
        $table_name = 'hris_attendances';
        Log::create([
            'user_id'=>$r->query('user_id'),
            'table_name'=>$table_name,
            'action'=>$action,
            'value'=>$value,
            'target_id'=>$id,
            'description'=>'user '.$user->username.' '.$action.' in '.$table_name.' with id '.$id.' and with value '.$value,
        ]);
        A::find($id)->update([
            'enter'=>$r->enter
        ]);
        return 'Enter attendance with id '.$id.' success updated';
    }

    public function updateOut($id, Request $r)
    {
        $user = User::find($r->query('user_id'));
        $action = 'edit out at';
        $value = $r->out;
        $table_name = 'hris_attendances';
        Log::create([
            'user_id'=>$r->query('user_id'),
            'table_name'=>$table_name,
            'action'=>$action,
            'value'=>$value,
            'target_id'=>$id,
            'description'=>'user '.$user->username.' '.$action.' in '.$table_name.' with id '.$id.' and with value '.$value,
        ]);
        A::find($id)->update([
            'out'=>$r->out
        ]);
        return 'Out attendance with id '.$id.' success updated';
    }

    public function updateStatus($id, Request $r)
    {
        $user = User::find($r->query('user_id'));
        $action = 'edit status';
        $value = $r->status;
        $table_name = 'hris_attendances';
        Log::create([
            'user_id'=>$r->query('user_id'),
            'table_name'=>$table_name,
            'action'=>$action,
            'value'=>$value,
            'target_id'=>$id,
            'description'=>'user '.$user->username.' '.$action.' in '.$table_name.' with id '.$id.' and with value '.$value,
        ]);
        A::find($id)->update([
            'status'=>$r->status
        ]);
        return 'Status attendance with id '.$id.' success updated';
    }
}

