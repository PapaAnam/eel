<?php

namespace App\Http\Controllers\Hris;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Hris\Department      as D;
use App\Models\Hris\Position        as P;
use App\Models\Hris\Activity;
use App\Models\Hris\Employee        as E;
use Excel;

class PositionController extends Controller
{
    // public function __construct()
    // {
    //     parent::set_table(P::class);
    //     parent::__construct('positions', $this->data());
    //     parent::set_add_oper(['lisun'=>false]);
    // }

    public function getData($id = null)
    {
        if($id){
            return P::find($id);
        }
        return P::all();
    }

    private function data()
    {
        return P::orderBy('name', 'asc')->get();
    }

    public function dt()
    {
        $data = array();
        $no = 1;
        foreach ($this->data() as $d) {
            $data[] = [
                $no++,
                $d->name,
                get_edit_button($d->id, route('position.edit'), 'small').
                get_delete_button($d->id, route('position.remove'))
            ];
        }
        return ['data'=>$data];
    }

    public function index(Request $r)
    {
        if(!$r->ajax())
            return redirect()->route('hris');
        // parent::check_authority('position');
        $oper = array(
            'modul'         => 'position',
            'data'          => $this->data(),
        );
        return view('hris.positions.index', $oper);
    }

    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required'
        ]);
        foreach ($r->name as $name) {
            if(P::where('name', $name)->count()>0){
                return response('Position already has been taken', 409);
            }
        }
        foreach($r->name as $name)
            P::create([
                'name'          => $name
            ]);
        Activity::cr('Added new position');
        return 'position success added';
    }

    public function edit(Request $r)
    {
        // parent::check_authority('position');
        $data = P::find($r->id);
        $oper = array(
            'modul'             => 'position',
            'data'              => $data
        );
        return view('hris.positions.edit', $oper);
    }

    public function update(Request $r)
    {
        // parent::check_authority('position');
        // $rules['name'] = 'required';
        // $nameIsChange = $r->name!=$r->old_name;
        // if($nameIsChange){
        $rules['name']='required|min:2|unique:hris_positions';
        // }
        $r->validate($rules);
        P::find($r->id)->update($r->all());
        // parent::create_activity('Update position');
        return 'position success updated';
    }

    public function delete($id)
    {
        // parent::check_authority('position');
        // $login = M::find($request->id)->login;

        // M::destroy($request->id);
        P::find($id)->delete();
        // U::destroy($login);
        return 'position success deleted';
        // return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function check(Request $r)
    {
        if(E::where('position', $r->id)->count()<=0){
            return 1;
        }
        $E = E::where('position', $r->id)->get();
        $oper = [
            'employee'      => $E
        ];
        return view('hris.positions.alert', $oper);
    }

    public function to_print($data=null)
    {
        return view('hris.positions.print', ['data'=>D::all()]);
    }

    public function pdf()
    {
        // parent::check_authority('position');
        return parent::pdfs('hris.positions', $this->data());
    }

    public function excel()
    {
        // parent::check_authority('position');
        $data = $this->data()->toArray();
        Excel::create('lisun_hris_positions_'.date('Y_m_d_h_i_s'), function($excel) use ($data) {
            $excel->setTitle('Lisun HRIS Positions');
            $excel->setCreator('Lisun')->setCompany('Lisun');
            $excel->setDescription('Lisun HRIS Positions');
            $excel->sheet('data', function($sheet) use ($data) {
                for ($i=1; $i<=count($data); $i++) {
                    $data[$i-1] = ['#'=>$i]+$data[$i-1];
                }
                $sheet->with($data);
                // $sheet->row(1, ['#', 'name', 'department']);
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                });
            });
        })->export('xlsx');
    }
}

