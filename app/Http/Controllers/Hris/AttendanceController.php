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
use App\Models\Absensi\CheckInOut;
use Excel;
use Storage;

class AttendanceController extends Controller
{
    public function getData($id = null, $date = null)
    {
        if($date)
            return A::with('emp')->where('created_at', $date)->get();
        return A::with('emp')->where('created_at', date('Y-m-d'))->get();
    }

    public function x100c()
    {
        return CheckInOut::with('UserInfo')->get();
    }

    private function data($id = null)
    {
        return A::data($id);
    }

    private function create_dt($q)
    {
        $hint = 'data-role="hint" data-hint-background="bg-darkMagenta" data-hint-color="fg-white" data-hint-mode="2" data-hint-position="top"';
        $data = array();
        $no = 1;
        foreach ($q as $d) {
            $data[] = [
                $no++,
                '('.$d->emp->nin.') '.$d->emp->name,
                english_date($d->created_at),
                absence_status($d->status),
                $d->enter,
                $d->break,
                $d->end_break,
                $d->out,
                '<a data-hint="Break" '.$hint.' href="#" onclick="addBreak(\''.$d->id.'\')" class="fg-white button cycle-button bg-darkMagenta"><span class="mif-bell"></span></a>
                <a data-hint="End Break" '.$hint.' href="#" onclick="addEndBreak(\''.$d->id.'\')" class="fg-white button cycle-button bg-darkMagenta"><span class="mif-bell"></span></a>
                <a data-hint="Out" '.$hint.' href="#" onclick="addOut(\''.$d->id.'\')" class="fg-white button cycle-button bg-darkMagenta"><span class="mif-bell"></span></a>'.
                del_btn($d->id)
            ];
        }
        return $data;
    }

    public function dt()
    {
        return response(['data'=>$this->create_dt($this->data())], 200);
    }

    public function filter_dt($date)
    {
        return response(['data'=>$this->create_dt(A::whereCreatedAt($date)->get())], 200);
    }

    public function index(Request $r)
    {
        // dd(CheckInOut::all());
        if(!$r->ajax())
            return redirect()->route('hris');
        parent::check_authority('attendance');
        return view('hris.attendances.index', ['CheckInOut' => CheckInOut::with('UserInfo')->get()]);
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
        // dd($r->all());
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
            parent::create_activity('Added new multiple attendance (All Department)');
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
        return parent::created();
    }

    public function update($id, Request $r)
    {
        $break          = $r->break;
        $end_break      = $r->end_break;
        $out            = $r->out;
        $enter          = $r->enter;
        if($r->status != 'Present'){
            $break          = null;
            $end_break      = null;
            $out            = null;
            $enter          = null;
        }
        A::find($id)->update([
            'break'         => $break,
            'end_break'     => $end_break,
            'out'           => $out,
            'enter'         => $enter,
            'status'        => $r->status,
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
        parent::create_activity('Added new attendance');
        return parent::created();
    }

    public function api($id)
    {
        return A::with('emp')->where('id', $id)->first();
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

    public function breakUpdate(Request $r)
    {
        A::find($r->id)->update(['break'=>$r->break]);

        return parent::updated();
    }

    public function endBreak(Request $r)
    {
        $id = $r->id;
        $data = $this->data($id);
        $oper = array(
            'data'          => $data
        );
        return view('hris.attendances.end_break', $oper);
    }

    public function endBreakUpdate(Request $r)
    {
        A::find($r->id)->update(['end_break'=>$r->end_break]);

        return parent::updated();
    }

    public function out(Request $r)
    {
        $id = $r->id;
        $data = $this->data($id);
        $oper = array(
            'data'          => $data
        );
        return view('hris.attendances.out', $oper);
    }

    public function outUpdate(Request $r)
    {
        A::find($r->id)->update(['out'=>$r->out]);
        if(strtotime($r->out)>strtotime('18:00:00')){
            O::create([
                'created_at'      => date('Y-m-d'),
                'employee'  => A::find($r->id)->employee
            ]);
        }
        return parent::updated();
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

        parent::create_activity('Deleted attendance');
        return parent::deleted();
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

    public function to_print($data=null)
    {
        parent::check_authority('attendance');
        return view('hris.attendances.export.print', ['data'=>$this->data()]);
    }

    public function pdf()
    {
        parent::check_authority('attendance');
        return parent::pdfs('hris.attendances.export', $this->data(), true);
    }

    public function excel()
    {
        parent::check_authority('attendance');
        Excel::create('lisun_hris_attendance_'.date('Y_m_d_h_i_s'), function($excel){
            $excel->setTitle('Lisun HRIS Attendance');
            $excel->setCreator('Lisun')->setCompany('Lisun');
            $excel->setDescription('Lisun HRIS Attendance');
            $excel->sheet('data', function($sheet){
                $datas = [];
                foreach ($this->data() as $d) {
                    $arr        = [
                        'Employee'  => '('.$d->nin.') '.$d->e_name,
                        'Date'      => $d->created_at,
                        'Status'    => absence_status($d->status),
                        'Enter'     => $d->enter,
                        'Break'     => $d->break,
                        'End Break' => $d->end_break,
                        'Out'       => $d->out,
                    ];
                    array_push($datas, $arr);
                }
                $sheet->with($datas);
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
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
        $file_path = $r->file('attendance_excel')->store('attendances');
        $file_path = explode('/', $file_path);
        $file_name = end($file_path);
        $rows = Excel::load('public/storage/attendances/'.$file_name)->get();
        $datas = [];
        $rows->each(function($row){
            $created_at = is_string($row->created_at) ? $row->created_at : $row->created_at->format('Y-m-d');
            if(E::where('nin', $row->employee_nin)->count()){
                $re = E::where('nin', $row->employee_nin)->first()->id;
                A::updateOrCreate([
                 'created_at' => $created_at, 
                 'employee'   => $re 
             ], [
                'enter'      => is_null($row->enter) ? '00:00:00' : (is_string($row->enter) ? $row->enter : $row->enter->format('H:i:s')),
                'break'      => is_null($row->break) ? '00:00:00' : (is_string($row->break) ? $row->break : $row->break->format('H:i:s')),
                'end_break'  => is_null($row->end_break) ? '00:00:00' : (is_string($row->end_break) ? $row->end_break : $row->end_break->format('H:i:s')),
                'out'        => is_null($row->out) ? '00:00:00' : (is_string($row->out) ? $row->out : $row->out->format('H:i:s')),
                'status'     => ucwords($row->status),
            ]);
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
}

