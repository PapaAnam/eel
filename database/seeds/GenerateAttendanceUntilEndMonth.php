<?php

use Illuminate\Database\Seeder;
use App\Models\Hris\Employee;
use App\Models\Hris\Attendance;

class GenerateAttendanceUntilEndMonth extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = Employee::active();
        $tglMaks = date('t');
        $hariIni = date('d');
        foreach ($employees as $e) {
        	foreach (range($hariIni, $tglMaks) as $tgl) {
        		Attendance::updateOrCreate([
        			'created_at'=>date('Y-m').'-'.$tgl,
        			'employee'=>$e->id,
        		],[]);
        	}
        }
    }
}
