<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Hris\Position                as P;
use App\Models\Hris\Department              as D;
use App\Models\Hris\Mutation                as M;
use App\Models\Hris\SubDepartment           as SD;
use App\Models\Hris\Employee                as E;
use PDF;
use Excel;

class MutationController extends Controller
{

    private function data($id = null)
    {
        return M::data($id);
    }

    public function store(Request $r)
    {
        $r->validate([
            'city'          => 'required',
            'job_title'     => 'required',
            'effect_on'     => 'required|date_format:Y-m-d',
            'reason'        => 'required',
            'mutation_id'   => 'required|unique:hris_mutations'
        ]);
        if(count($r->department) <= 0){
            return response('Please select department', 409);
        }
        $emp = E::find($r->employee);
        M::create([
            'employee'              => $r->employee,
            'old_position'          => $emp->position,
            'old_department'        => $emp->department,
            'new_position'          => $r->job_title,
            'new_department'        => last($r->department),
            'reason'                => $r->reason,
            'effect_on'             => $r->effect_on,
            'manager'               => $r->manager,
            'city'                  => $r->city,
            'mutation_id'           => $r->mutation_id,
            'created_at'            => (String) now(),
        ]);
        $emp->update([
            'position'      => $r->job_title,
            'department'    => last($r->department),
        ]);
        return 'Mutation has been created';
    }

    public function index(Request $r)
    {
        return M::inMonth($r->query('year'), $r->query('month'));
    }

    public function edit(Request $r)
    {
        $data = $this->data($r->id);
        $oper = array(
            'data'                   => $data,
            'department'             => SD::find($data->old_department)->department,
            'sub_departments'        => SD::where('department', $data->old_department)->get(),
            'old_position'           => P::find($data->old_position)->name,
            'old_department'         => SD::find($data->old_department)->name,
            'manager_sub_department' => E::find($data->manager)->department,
            'manager_department'     => SD::find(E::find($data->manager)->department)->department
        );
        return view('hris.mutations.edit', $oper);
    }

    public function update(Request $r)
    {
        $this->rules['employee'] = '';
        $this->validate($r, $this->rules);
        M::find($r->id)->update($this->storeData($r));
        E::find(M::find($r->id)->employee)->update(['position'=>$r->position, 'department'    => $r->sub_department]);

        return parent::updated();
    }

    public function detail(Request $r)
    {
        $d = $this->data($r->id);
        $oper = [
            // 'data'                   => $d,
            // 'old_sub_department'     => parent::sub_department_name($d->old_department),
            // 'old_department'         => parent::department_name(),
            // 'old_position'           => parent::position_name($d->old_position),
            // 'manager'                => parent::employee_name($d->manager),
            // 'manager_position'       => parent::position_name(E::find($d->manager)->position),
            // 'manager_department'     => parent::department_name(SD::find(E::find($d->manager)->department)->department),
            // 'manager_sub_department' => parent::sub_department_name(E::find($d->manager)->department)
        ];
        return view('hris.mutations.detail', $oper);
    }

    public function remove($id, Request $r)
    {
        $mutation             = M::find($id);
        $employee             = E::find($mutation->employee);
        $employee->department = $mutation->old_department;
        $employee->position   = $mutation->old_position;
        $employee->save();
        $mutation->delete();
        parent::create_activity('Delete and restore mutation');
        return 'Mutation has been deleted, and employee restored to before status';
    }

    private $modul = 'mutations';

    public function to_print($data=null)
    {
        $oper  = [
            'data2'     => $this->data2(),
            'data'      => $this->data()
        ];
        return view($this->modul.'.print', $oper);
    }

    public function pdf()
    {
        $l = true;
        $oper  = [
            'data2'     => $this->data2(),
            'data'      => $this->data()
        ];
        $pdf = PDF::loadView($this->modul.'.print', $oper);
        $pdf->setPaper('a4');
        if($l)
            $pdf->setPaper('a4', 'landscape');
        return $pdf->download($this->modul.' ['.now().'].pdf');
    }

    public function excel(Request $r)
    {
        return Excel::create('Mutation in '.$r->query('year').'-'.$r->query('month').' ['.now().']', function($excel) use ($r){
            $excel->sheet('data', function($sheet) use ($r){
                $data = $this->index($r);
                $i = 1;
                $table = [];
                foreach ($data as $d) {
                    $table[] = [
                        '#'                     => $i++,
                        'Mutation ID'           => $d->mutation_id,
                        'Employee'              => '('.$d->emp->nin.') '.$d->emp->name,
                        'New Job Title'         => $d->njb->name,
                        'Old Job Title'         => $d->ojb->name,
                        'New Department'        => $d->ndep->name,
                        'Old Department'        => $d->odep->name,
                        'Manager Who Rule'      => $d->man->name,
                        'Manager City'          => $d->city,
                        'Effect On'             => $d->effect_on,
                        'Created At'            => $d->created_at,
                    ];
                }
                $sheet->with($table);
                // set border to all active cell
                $kolom = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K'];
                foreach ($kolom as $k) {
                    $sheet->cell($k.'1', function($cell){
                        $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    });   
                }
                $baris = 2;
                foreach ($data as $a) { 
                    foreach ($kolom as $k) {
                        $sheet->cell($k.$baris, function($cell){
                            $cell->setBorder('thin', 'thin', 'thin', 'thin');
                        });   
                    }
                    $baris++;
                }
            });
        })->export('xlsx');
    }

    private function letteroper($id)
    {
        $d = $this->data($id);
        $oper = [
            'data'           => $d,
            // 'm'              => parent::employee_detail($d->manager),
            'old'            => (object) [
                // 'position'       => parent::position_name($d->old_position),
                // 'sub_department' => parent::sub_department_name($d->old_department),
                // 'department'     => parent::department_name()
            ]
        ];
        return $oper;
    }

    public function letterprint($id)
    {
        $oper['data'] = M::single($id);
        $oper['img'] = asset('images/company/mutation_logo.jpg');
        return view('hris.mutations.letter', $oper);
    }

    public function letterexcel($id)
    {
        $oper          = $this->letteroper($id);
        $oper['img']   = local_file('images/company/mutation_logo.jpg');
        $oper['lisun'] = false;
        // return parent::to_excel('Mutation Letter', 'hris.mutations.letter_excel', $oper);
    }

    public function letterpdf($id)
    {
        $oper['data'] = M::single($id);
        $oper['img'] = asset('images/company/mutation_logo.jpg');
        // return parent::to_pdf('Mutation Letter', 'hris.mutations.letter_pdf', $oper);
    }

    public function check_position_department(Request $r)
    {
        return view('hris.mutations.check_position_department', ['data'=>E::data($r->id)]);
    }

}

