<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Hris\Position        as P;
use App\Models\Hris\OverTime        as O;
use App\Models\Hris\Department      as D;
use App\Models\Hris\Employee        as E;
use Excel;

class OverTimeController extends Controller
{
    private function data($id = null)
    {
        return O::data($id);
    }

    public function dt()
    {
        $data = array();
        $no = 1;
        foreach ($this->data() as $d) {
            $data[] = [
            $no++,
            $d->e_name,
            $d->d_name,
            $d->sd_name,
            $d->p_name,
            english_date($d->created_at),
            $d->pay,
            '<a data-role="hint" data-hint-background="bg-blue" data-hint-color="fg-white" data-hint-mode="2" data-hint="Pay" data-hint-position="top" onclick="pay(\''.$d->id.'\')" class="button fg-white bg-blue cycle-button" href="#"><span class="mif-dollar2"></span></a>'
            ];
        }
        return response(['data'=>$data], 200);
    }

    public function index(Request $r)
    {
        if(!$r->ajax()){
            return redirect()->route('/');
        }
        return view('hris.over_times.index');
    }

    private function storeData($r)
    {
        $storeData = [
        'new_position'      => $r->new_position,
        'reason'            => $r->reason,
        'date'              => date('Y-m-d H:i:s'),
        'status'            => 1
        ];
        return $storeData;
    }

    public function payEdit(Request $r)
    {
        $data = O::find($r->id);
        $oper = [
        'data'      => $data,
        'action'    => route('overtime.pay')
        ];
        return view('hris.over_times.pay', $oper);
    }

    public function pay(Request $r)
    {
        $this->validate($r, ['pay'=>'numeric|min:0']);
        O::find($r->id)->update(['pay'=>$r->pay]);
        parent::create_activity('Paying employee for over time');
        return parent::updated();
    }

    #EXPORT

    public function to_print($data=null)
    {
        parent::check_authority('over_time');
        return view('hris.over_times.export.print', ['data'=>$this->data()]);
    }

    public function pdf()
    {
        parent::check_authority('over_time');
        return parent::pdfs('hris.over_times.export', $this->data(), true);
    }

    public function excel()
    {
        parent::check_authority('over_time');
        Excel::create('lisun_hris_over_time_'.date('Y_m_d_h_i_s'), function($excel){
            $excel->setTitle('Lisun HRIS Over Time');
            $excel->setCreator('Lisun')->setCompany('Lisun');
            $excel->setDescription('Lisun HRIS Over Time');
            $excel->sheet('data', function($sheet){
                $datas = [];
                foreach ($this->data() as $d) {
                    $arr                        = [
                    'Employee'                  => '('.$d->nin.') '.$d->e_name,
                    'Department/Sub Department' => $d->d_name.'/'.$d->sd_name,
                    'Position'                  => $d->p_name,
                    'Date'                      => $d->created_at,
                    'Pay ($)'                   => $d->pay
                    ];
                    array_push($datas, $arr);
                }
                $sheet->with($datas);
                // $sheet->row(1, ['#', 'name', 'department']);
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                });
            });
        })->export('xlsx');
    }

}

