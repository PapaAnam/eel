<?php

namespace App\Http\Controllers\Hris;

use App\Http\Requests\CreateDepartment;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hris\Department      as D;
use App\Models\Hris\SubDepartment      as SD;
use App\Models\Hris\Position        as P;
use App\Models\Hris\Employee        as E;
use Excel;
use PDF;

class DepartmentController extends Controller
{

    public function api($id = null)
    {
        if($id){
            return D::find($id);
        }
        return D::data();
    }

    public function getData($id = null)
    {
        if($id){
            if($id == 'all'){
                return D::all();
            }
            return D::with('dibawahi_oleh')->whereId($id)->first();
        }
        return D::data();
    }

    private function data()
    {
        return D::all();
    }

    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required'
        ]);
        foreach ($r->name as $name) {
            if(D::where('name', $name)->where('dibawahi', $r->dibawahi)->count()>0){
                return response([
                    'errors' => [
                        'name' => ['Department name already has been taken']
                    ]
                ], 422);
            }
        }
        foreach ($r->name as $name) {
            $data = [
                'name'      => $name,
            ];
            if($r->dibawahi){
                $data['dibawahi'] = $r->dibawahi;
            }
            D::create($data);
        }
        // parent::create_activity('Added new department');
        return response('Department success created', 200);
    }

    public function delete($id)
    {
        D::find($id)->delete();
        return 'department success deleted';
    }

    public function update($id, Request $r)
    {
        $rules = [
            'name'          => 'required|min:2',
        ];
        $d = D::find($id);
        $nameIsChange = $r->name!=$d->name;
        if($nameIsChange){
            $sudahAda = D::whereName($r->name)->whereDibawahi($d->dibawahi)->count() > 0;
            if($sudahAda){
                $rules['name']='required|min:2|unique:hris_departments';
            }
        }
        $r->validate($rules);
        D::find($r->id)
        ->update([
            'name'  => $r->name
        ]);
        // parent::create_activity('Edited department');
        return response('Department success updated', 200);
    }

    # EKSPOR

    public function toPrint($data=null)
    {
        return view('hris.departments.print', [
            'data'=>D::data()
        ]);
    }

    public function pdf()
    {
        return PDF::loadView('hris.departments.print', [
            'data' => D::data()
        ])->download('lisun-hris-departments ['.now().'].pdf');
    }

    public function excel()
    {
        // parent::check_authority('department');
        Excel::create('lisun-hris-departments ['.now().']', function($excel){
            $excel->setTitle('Lisun HRIS Departments');
            $excel->setCreator('Lisun')->setCompany('Lisun');
            $excel->setDescription('Lisun HRIS Departments');
            $excel->sheet('data', function($sheet){
                $sheet->fromArray(D::excel());
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                });
                $sheet->prependRow(['Departments']);
                $sheet->mergeCells('A1:C1');
                $sheet->cell('A1', function($cell){
                    $cell->setFontSize(16);
                    $cell->setAlignment('center');
                });
            });
        })->export('xlsx');
    }

    public function dd()
    {
        return D::with('depts.depts.depts.depts.depts')->where('dibawahi', '0')->get();
    }

    public function m()
    {
        foreach(SD::where('name', '!=', '-')->get() as $sd){
            D::create([
                'name' => $sd->name,
                'dibawahi' => $sd->department,
                'deleted_at' => $sd->deleted_at
            ]);
        }
    }

    // DEPRECATED
    public function disable(Request $request)
    {
        // parent::check_authority('department');
        D::destroy($request->id);

        return redirect()->back()->with('success', 'Data has been disabled');
    }

    public function disabled()
    {
        // parent::check_authority('department');
        $data = D::onlyTrashed()->get();
        $oper = array(
            'title'         => 'Disabled Departments'.title(),
            'modul'         => 'department.disabled',
            'data'          => $data,
            'add'           => route('department.add'),
            'enable'        => route('department.enable'),
            'profile'       => $this->profile()
        );
        return view('hris.departments.disabled', $oper);
    }

    public function enable(Request $request)
    {
        // parent::check_authority('department');
        D::withTrashed()->where('id',$request->id)->restore();

        return redirect()->back()->with('success', 'Data has been enabled');
    }

    public function check(Request $r)
    {
        if(P::where('department', $r->id)->count()<=0)
            return 1;
            $P = P::where('department', $r->id)->get();
            foreach ($P as $p) {
                $E[] = E::where('position', $p->id)->get();
            }
            $oper = [
                'position'      => $P,
                'employee'      => $E
            ];
            return view('hris.departments.alert', $oper);
        }

        public function recycle()
        {
            $data = array();
            $no = 1;
            $dt = D::onlyTrashed()->get();
            foreach ($dt as $d) {
                $data[] = [
                    $no++,
                    $d->name,
                    english_date($d->deleted_at),
                    get_restore_button($d->id, route('department.restore')).
                    get_permanent_delete_button($d->id, route('department.permanent_delete'))
                ];
            }
            return ['data'=>$data];
        }

        public function restore(Request $r)
        {
            D::withTrashed()->where('id', $r->id)->restore();
            // parent::create_activity('Restore department');
            // return parent::restored();
        }

        public function permanent_delete(Request $r)
        {
            D::withTrashed()->where('id', $r->id)->forceDelete();
            // parent::create_activity('Permanent delete department');
            // return parent::permanent_deleted();
        }
    }
