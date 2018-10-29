<?php

use Illuminate\Database\Seeder;
use App\Models\Hris\Employee;
use App\Models\Hris\Attendance;

class GenerateAttendanceUntilEndMonth extends Seeder
{
    public function run()
    {
        $employees = Employee::active();
        $tglMaks = date('t');
        $hariIni = date('d');
        foreach ($employees as $e) {
            foreach (range($hariIni, $tglMaks) as $tgl) {
                $data = [
                    'enter'=>null,
                    'out'=>null,
                    'break'=>'12:00:00',
                    'end_break'=>'13:00:00',
                ];
                if(date('N',strtotime(date('Y-m').'-'.$tgl)) == 7){
                    $data = [
                        'enter'=>null,
                        'out'=>null,
                        'break'=>null,
                        'end_break'=>null,
                    ];
                }
                if(date('Y-m').'-'.$tgl != '2018-10-29'){
                    Attendance::updateOrCreate([
                        'created_at'=>date('Y-m').'-'.$tgl,
                        'employee'=>$e->id,
                    ],$data);
                }
            }
        }
    }
}
