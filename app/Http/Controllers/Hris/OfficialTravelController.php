<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Hris\Position                as P;
use App\Models\Hris\OfficialTravel          as T;
use App\Models\Hris\Attendance              as A;
use App\Models\Hris\SubDepartment           as SD;
use App\Models\Hris\Employee                as E;
use App\Models\Hris\SalaryRule              as SR;
use Excel;
use PDF;
class OfficialTravelController extends Controller
{

    // public function __construct()
    // {
    //     $this->table = 'official_travels';
    //     $data = array();
    //     $no = 1;
    //     foreach ($this->data() as $d) {
    //         $data[] = [
    //             $no++,
    //             $d->sppd,
    //             $d->d_name,
    //             $d->sd_name,
    //             $d->e_name,
    //             $d->p_name,
    //             english_date($d->start_date),
    //             get_detail_button($d->id, route('official_travel.detail')).
    //             get_edit_button($d->id, route('official_travel.edit')).
    //             get_delete_button($d->id, route('official_travel.remove')).
    //             '<a class="button cycle-button bg-steel fg-white" href="'.route('official_travel.warrant.print', $d->id).'" target="_blank" '.hint('Warrant Print', 'steel').'"><span class="mif-printer"></span></a>
    //             <a class="button cycle-button bg-red fg-white" href="'.route('official_travel.warrant.pdf', $d->id).'" target="_blank" '.hint('Warrant PDF', 'red').'"><span class="mif-file-pdf"></span></a>
    //             <a class="button cycle-button bg-green fg-white" href="'.route('official_travel.warrant.excel', $d->id).'" target="_blank" '.hint('Warrant Excel', 'green').'"><span class="mif-file-excel"></i></a>'
    //         ];
    //     }
    //     parent::set_dt($data);
    //     parent::__construct('official_travels', $this->data());
    //     parent::set_add_oper(['lisun'=>false]);
    // }

    private function data($id = null)
    {
        return T::data($id);
    }

    public function index(Request $r)
    {
        if(!$r->ajax())
            return redirect()->route('hris');
        // parent::check_authority('official_travel');
        return view('hris.official_travels.index');
    }

    public function checkEatCost(Request $r)
    {
        $SR = SR::find(E::find($r->id)->salary_rule);
        if($SR == null)
            return 0;
        $SR->eat_cost;
    }

    private $rules = [
        'sppd' => 'required|numeric|min:1|unique:hris_official_travels',
        'employee'          => 'required',
        'assignor'          => 'required',
        'area_1'            => 'required',
        'depart_from'       => 'required',
        'start_date'        => 'required',
        'end_date'          => 'required',
        'advanced_cost'     => 'required|numeric|min:1|max:999999999',
    ];

    private function storeData($r)
    {
        $storeData = [
            'depart_from'       => $r->depart_from,
            'start_date'        => $r->start_date.' '.$r->start_time,
            'end_date'          => $r->end_date.' '.$r->end_time,
            'eat_cost'          => $r->eat_cost,
            'fuel_cost'         => $r->fuel_cost,
            'other_cost'        => $r->other_cost,
            'advanced_cost'     => $r->advanced_cost,
            'sppd'              => $r->sppd,
            'lodging_cost'      => $r->lodging_cost,
            'area_1'            => $r->area_1,
            'area_2'            => $r->area_2,
            'area_3'            => $r->area_3,
            'area_4'            => $r->area_4,
            'area_5'            => $r->area_5,
            'employee'          => $r->employee,
            'assignor'          => $r->assignor,
            'officer_note'      => $r->officer_note,
            'assignor_note'     => $r->assignor_note
        ];
        return $storeData;
    }

    public function create(Request $r)
    {
        $this->validate($r, $this->rules);
        $stda = $r->start_date.' '.$r->start_time;
        $start = strtotime(date('Y-m-d'));
        $end = strtotime(''.$r->end_date.' '.$r->end_time);
        dd(strtotime($r->start_date).' '.strtotime(date('Y-m-d')));
        if($start>=$end)
            return response('Invalid end date!!!', 409);
        $interval = floor(($end-$start)/3600/24);
        $sd = $this->storeData($r);
        T::create($sd);
        $tm = strtotime(eng_date($r->end_date));
        for ($i=0; $i <=$interval ; $i++) { 
            A::create([
                'status'     => 4,
                'employee'   => $r->employee,
                'created_at' => date('Y-m-d', $tm)
            ]);
            $tm -= 86400;
        }
        // parent::create_activity('Added new official travel');
        return 'New official travel has been added';
    }

    private function assignor_position($id)
    {
        return P::find($id)->name;
    }

    private function assignor_name($id)
    {
        return E::find($id)->name;
    }

    public function update(Request $r, $id)
    {
        $rules = [
            'sppd' => T::find($id)->sppd != $r->sppd ? 'required|numeric|min:1|unique:hris_official_travels' : 'required|numeric|min:1',
            'eat_cost'          => 'required|numeric|min:1|max:999999999',
            'fuel_cost'         => 'required|numeric|min:1|max:999999999',
            'lodging_cost'      => 'required|numeric|min:1|max:999999999',
            'other_cost'        => 'required|numeric|min:1|max:999999999',
            'employee' => ''
        ]+$this->rules;
        $r->validate($rules);
        $sd = $this->getDate($r->start_date);
        $ed = $this->getDate($r->end_date);
        $data = $r->except(['start_date', 'end_date'])+[
            'start_date' => $sd,
            'end_date' => $ed,
        ];
        $data['report_at'] = now();
        // dd($data);
        T::find($r->id)->update($data);
        // parent::create_activity('Updated official travel');
        return 'official travel success updated';
    }

    public function detail(Request $r)
    {
        $oper = [
            'data'      => $this->data($r->id)
        ];
        return view('hris.official_travels.detail', $oper);
    }

    public function remove(Request $r)
    {
        $T        = T::find($r->id);
        $start    = strtotime(($T->start_date).' '.get_time($r->start_date));
        $end      = strtotime(($T->end_date).' '.get_time($r->end_date));
        $interval = floor(($end-$start)/3600/24);
        $tm       = strtotime($T->end_date);
        for ($i=0; $i <=$interval ; $i++) { 
            A::where([
                'created_at' => date('Y-m-d', $tm),
                'employee'   => $T->employee,
                'status'     => 4
            ])->delete();
            $tm -= 86400;
        }        
        $T->delete();
        // parent::create_activity('Deleted official travel');
        return 'Official travel has been deleted';
    }

    public function warrantPrint($id)
    {
        $data = $this->data($id);

        $oper = [
            'data'          => $data,
            'as_name'       => $this->assignor_name($data->assignor),
            'pas_name'      => $this->assignor_position(E::find($data->assignor)->position),
        ];
        return view('hris.official_travels.warrant.print', $oper);
    }

    private $id;

    public function warrantExcel($id)
    {
        $this->id = $id;
        return Excel::create('lisun_hris_official_travel_warrant_'.$this->data($this->id)->nin.' ['.now().']', function($excel) {
            $excel->setTitle('Lisun Hris Official Travel Warrant '.$this->data($this->id)->nin.' ['.now().']');
            $excel->sheet('sheet1', function($sheet) {
                $data = $this->data($this->id);
                $oper = [
                    'data'          => $data,
                    'as_name'       => $this->assignor_name($data->assignor),
                    'pas_name'      => $this->assignor_position(E::find($data->assignor)->position),
                ];
                $sheet->loadView('hris.official_travels.warrant.excel', $oper);
                // $sheet->setAutoSize(true);
            });
        })->export('xlsx');
    }

    public function warrantPdf($id)
    {
        $data = $this->data($id);

        $oper = [
            'data'          => $data,
            'as_name'       => $this->assignor_name($data->assignor),
            'pas_name'      => $this->assignor_position(E::find($data->assignor)->position),
        ];
        $pdf = PDF::loadView('hris.official_travels.warrant.print', $oper);
        $pdf->setPaper('a4');
        return $pdf->download('Warrant ['.now().'].pdf');
    }

    // dari awal lagi

    public function getData($id = null)
    {
        if($id){
            return T::getData($id);
        }
        return T::getData();
    }

    private function getDate($date){
        return substr($date, 6,4).'-'.substr($date, 3,2).'-'.substr($date, 0,2).' '.substr($date, 11,5);
    }

    public function store(Request $r)
    {
        $r->validate($this->rules);
        $sd = $this->getDate($r->start_date);
        $ed = $this->getDate($r->end_date);
        if(strtotime($sd)>=strtotime($ed))
            return response([
                'errors' => [
                    'end_date' => ['Invalid end date!!!']
                ]
            ], 422);
        $data = $r->except(['start_date', 'end_date'])+[
            'start_date' => $sd,
            'end_date' => $ed,
        ];
        T::create($data);
        // parent::create_activity('Added new official travel');
        return 'new official travel has been created';
    }

    public function delete($id)
    {
        T::find($id)->delete();
        return 'official travel success deleted';
    }    

    #EXPORT

    public function toPrint($data=null)
    {
        // parent::check_authority('official_travel');
        return view('hris.official_travels.export.print', [
            'data' => T::getData()
        ]);
    }

    public function pdf()
    {
        // parent::check_authority('official_travel');
        return PDF::loadView('hris.official_travels.export.print', [
            'data' => T::getData()
        ])
        ->setPaper('a4', 'landscape')
        ->download('lisun-hris-official-travel ['.now().'].pdf');
    }

    public function excel()
    {
        // parent::check_authority('official_travel');
        Excel::create('lisun-hris-official-travel ['.now().']', function($excel){
            $excel->setTitle('Lisun HRIS Official Travel');
            $excel->setCreator('Lisun')->setCompany('Lisun');
            $excel->setDescription('Lisun HRIS Official Travel');
            $excel->sheet('data', function($sheet){
                $sheet->with(T::excel());
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                });
                $sheet->prependRow(['Official Travel']);
                $sheet->mergeCells('A1:F1');
                $sheet->cell('A1', function($cell){
                    $cell->setFontSize(16);
                    $cell->setAlignment('center');
                });
            });
        })->export('xlsx');
    }

}

