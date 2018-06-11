<?php

namespace App\Http\Controllers\Hris\Attendances;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hris\Attendances\Zt1300\TaLog;
use App\Models\Hris\Employee;
use App\Models\Hris\Attendance;

class Zt1300Controller extends Controller
{
    
	public function get(Request $r)
	{
		$date = str_replace('-', '/', $r->query('date'));
		$date = substr($date, 8, 2).'/'.substr($date, 5, 2).'/'.substr($date, 0, 4);
		return TaLog::with('staff')
		->where('Tanggal_Log', $date)
		->get();
	}

	public function synchronize(Request $r)
	{
		$data = $this->get($r);
		$date = $r->query('date');
		$berhasil = 0;
		$o = 0;
		foreach ($data as $d) {
			$time 	= $d->Jam_Log;
			$nin = (String) $d->staff->NIK;
			$e 		= Employee::where('nin', $nin)->orWhere('nin', (int) $nin)->first();
			$o++;
			if(!is_null($e)){
				if(strtotime($date.' '.$time) >= strtotime($date.' 03:00:00') && strtotime($date.' '.$time) <= strtotime($date.' 08:30:00')){
					Attendance::updateOrCreate([
						'employee'		=> $e->id,
						'created_at'	=> $date,
					], [
						'break'			=> '12:00:00',
						'end_break'		=> '13:00:00',
						'enter'			=> '08:30:00',
						'status'		=> 'Present',
					]);
					$berhasil++;
				}else if(strtotime($date.' '.$time) > strtotime($date.' 08:30:00') && strtotime($date.' '.$time) < strtotime($date.' 11:59:00')){
					Attendance::updateOrCreate([
						'employee'		=> $e->id,
						'created_at'	=> $date,
					], [
						'break'			=> '12:00:00',
						'end_break'		=> '13:00:00',
						'enter'			=> $time,
						'status'		=> 'Present',
					]);
					$berhasil++;
				}else if(strtotime($date.' '.$time) >= strtotime($date.' 17:00:00') && strtotime($date.' '.$time) <= strtotime($date.' 23:59:00')){
					Attendance::updateOrCreate([
						'employee'		=> $e->id,
						'created_at'	=> $date,
					], [
						'break'			=> '12:00:00',
						'end_break'		=> '13:00:00',
						'out'			=> $time,
						'status'		=> 'Present',
					]);
					$berhasil++;
				}
			}
		}
		$employees = Employee::all();
		foreach ($employees as $e) {
			$hi = Attendance::where('employee', $e->id)->where('created_at', $date)->first();
			if(is_null($hi)){
				Attendance::updateOrCreate([
					'employee'		=> $e->id,
					'created_at'	=> $date,
				], [
					'enter'			=> null,
					'break'			=> null,
					'end_break'		=> null,
					'out'			=> null,
					'status'		=> 'Absent',
				]);
			}
		}
		// return $berhasil;
		return 'Synchronize attendances from zt1300 successfull';
	}

}
