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
        // return $oth = Attendance::overTimeHolidayInMonth($r->query('year'), $r->query('month'), $r->query('employee'));
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
        if($emp == 'all'){
            $b=[];
            foreach(E::active() as $e){
                foreach (range(1, cal_days_in_month(CAL_GREGORIAN, $month, $year)) as $i) {
                    if($i < 10){
                        $i = '0'.$i;
                    }
                    $bulan = $month;
                    if($month < 10){
                        $bulan = '0'.$month;
                    }
                    $tgl = $year.'-'.$bulan.'-'.$i;
                    if(!Attendance::where('created_at', $tgl)->where('employee', $e->id)->exists()){
                        $b[] = [
                            'status'        => 'Absent',
                            'employee'      => $e->id,
                            'created_at'    => $tgl,
                        ];
                    }
                }
            }
            foreach(collect($b)->chunk(200)->values()->all() as $c){
                Attendance::insert(collect($c)->values()->toArray());
            }
        }
        $title = 'Over Time All Employee in '.$year.'-'.$month.' ['.now().']';
        if($emp != 'all'){
            $title = 'Over Time '.$employee->name.' in '.$year.'-'.$month.' ['.now().']';
        }
        Excel::create($title, function($excel) use ($emp, $year, $month, $employee){
            $excel->setTitle('Lisun HRIS Over Time');
            $excel->setCreator('Lisun')->setCompany('Lisun');
            $excel->setDescription('Lisun HRIS Over Time');
            $excel->sheet('data', function($sheet) use ($emp, $year, $month, $employee){
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
                        'NIN'               => $a['emp']['nin'],
                        'Employee'          => $a['emp']['name'],
                        'Day'               => $a['day'],
                        'Date'              => $a['created_at'],
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
                $kolom = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];
                if($emp != 'all'){
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
                    foreach ($kolom as $k) {
                        $sheet->cell($k.'1', function($cell){
                            $cell->setBorder('thin', 'thin', 'thin', 'thin');
                        });   
                    }
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
                    if($a['status'] == 'Absent'){
                        $sheet->row($baris, function($row){
                            $row->setFontColor('#ff0000')->setFontWeight('bold');
                        });
                    }
                    $baris++;
                }
                $title = 'Over Time All Employee in '.english_month_name($month).' '.$year;
                if($emp != 'all'){
                    $title = 'Over Time '.$employee->name.' in '.english_month_name($month).' '.$year;
                }
                $sheet->prependRow(1, [$title]);
                $sheet->mergeCells('A1:L1');
                $sheet->cell('A1', function($cell){
                    $cell->setAlignment('center')->setBackground('#999999')->setFontSize(16)->setFontWeight('bold');
                });
            });
})->export('xlsx');
}

}

