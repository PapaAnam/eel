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
use App\Models\Hris\Attendance;
use Excel;

class OverTimeController extends Controller
{

    public function regular(Request $r)
    {
        return Attendance::otRegular($r->query('year'), $r->query('month'), $r->query('employee'));
    }

    public function holiday(Request $r)
    {
        return Attendance::otHoliday($r->query('year'), $r->query('month'), $r->query('employee'));
    }

    private function data($id = null)
    {
        return O::data($id);
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

    public function excel(Request $r)
    {
        $emp        = $r->query('employee');
        $year       = $r->query('year');
        $month      = $r->query('month');
        $employee   = E::find($emp);
        Excel::create('Over Time '.$employee->name.' '.$year.'-'.$month.' ['.now().']', function($excel) use ($emp, $year, $month){
            $excel->setTitle('Lisun HRIS Over Time');
            $excel->setCreator('Lisun')->setCompany('Lisun');
            $excel->setDescription('Lisun HRIS Over Time');
            $excel->sheet('data', function($sheet) use ($emp, $year, $month){
                $datas = [];
                $i = 1;
                $attendances = Attendance::inMonth($emp, $year, $month);
                $ot_regular = 0;
                $ot_holiday = 0;
                $total      = 0;
                foreach ($attendances as $a) {
                    if($a['is_holiday'])
                        $ot_holiday += $a['over_time_in_hours'];
                    // else
                    //     $ot_regular += $a->over_time_in_hours;
                    if($a['work_total_in_hours'] != '-'){
                        $total += $a['work_total_in_hours'];   
                    }
                    $arr         = [
                        '#'                 => $i++,
                        'Employee'          => $a['emp']['nin'].$a['emp']['name'],
                        'Date'              => $a['day'].' '.$a['created_at'],
                        'Status'            => $a['status'],
                        'Enter At'          => $a['enter'],
                        'Break'             => $a['break'],
                        'End Break'         => $a['end_break'],
                        'Out At'            => $a['out'],
                        'Work Total'        => $a['work_total'],
                        'Total Time (W)'    => $a['work_total_in_week']
                    ];
                    array_push($datas, $arr);
                }
                $total_data = count($attendances);
                $sheet->with($datas);
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold')->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G'.($total_data+2), 'Total');
                $sheet->cell('G'.($total_data+2), function($cell){
                    $cell->setFontWeight('bold')->setBorder('thin', 'thin', 'thin', 'thin')->setAlignment('center');
                });
                $sheet->cell('H'.($total_data+2), convertHour($total));
                $sheet->cell('H'.($total_data+2), function($cell){
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G'.($total_data+3), 'Standart Time Work / Month');
                $sheet->cell('G'.($total_data+3), function($cell){
                    $cell->setFontWeight('bold')->setBorder('thin', 'thin', 'thin', 'thin')->setAlignment('center');
                });
                $sheet->cell('H'.($total_data+3), '176 hours');
                $sheet->cell('H'.($total_data+3), function($cell){
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $ot_regular = $total - 176 - $ot_holiday;
                $sheet->cell('G'.($total_data+4), 'Over Time Regular');
                $sheet->cell('G'.($total_data+4), function($cell){
                    $cell->setFontWeight('bold')->setBorder('thin', 'thin', 'thin', 'thin')->setAlignment('center');
                });
                $sheet->cell('H'.($total_data+4), convertHour($ot_regular));
                $sheet->cell('H'.($total_data+4), function($cell){
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->cell('G'.($total_data+5), 'Over Time Holiday');
                $sheet->cell('G'.($total_data+5), function($cell){
                    $cell->setFontWeight('bold')->setBorder('thin', 'thin', 'thin', 'thin')->setAlignment('center');
                });
                $sheet->cell('H'.($total_data+5), convertHour($ot_holiday));
                $sheet->cell('H'.($total_data+5), function($cell){
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                // set border to all active cell
                $kolom = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
                foreach ($kolom as $k) {
                    $sheet->cell($k.'1', function($cell){
                        $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    });   
                }
                $baris = 2;
                foreach ($attendances as $a) { 
                    foreach ($kolom as $k) {
                        $sheet->cell($k.$baris, function($cell){
                            $cell->setBorder('thin', 'thin', 'thin', 'thin');
                        });   
                    }
                    if($a['is_holiday']){
                        $sheet->row($baris, function($row){
                            $row->setBackground('#ff0055');
                        });
                    }
                    $baris++;
                }
            });
})->export('xlsx');
}

}

