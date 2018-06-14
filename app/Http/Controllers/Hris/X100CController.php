<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Absensi\CheckInOut;
use App\Models\Hris\Employee;
use App\Models\Hris\Attendance;

class X100CController extends Controller
{

	public function get(Request $r)
	{
		return CheckInOut::with('UserInfo')
		->whereDate('CHECKTIME', 'LIKE', $r->query('date'))
		->get();
	}

	public function synchronize(Request $r)
	{
		$data 	= $this->get($r);
		$date 	= $r->query('date');
		foreach ($data as $d) {
			$u 		= $d->userInfo;
			$time 	= substr($d->CHECKTIME, 11, 8);
			$e 		= Employee::where('nin', $u->BADGENUMBER)->orWhere('nin', (int) $u->BADGENUMBER)->orWhere('nin', $u->SSN)->orWhere('nin', (int) $u->SSN)->first();
			if(!is_null($e)){
				if($d->CHECKTYPE == 'I' or $d->CHECKTYPE == 'i'){
					if(strtotime($date.' '.$time) >= strtotime($date.' 03:00:00') && strtotime($date.' '.$time) <= strtotime($date.' 08:30:00')){
						Attendance::updateOrCreate([
							'employee'		=> $e->id,
							'created_at'	=> $date,
						], [
							'break'			=> '12:00:00',
							'end_break'		=> '13:00:00',
							'enter'			=> '08:30:00',
							'status'		=> 'Present',
							'real_enter'	=> $time,
						]);
					}else{
						Attendance::updateOrCreate([
							'employee'		=> $e->id,
							'created_at'	=> $date,
						], [
							'break'			=> '12:00:00',
							'end_break'		=> '13:00:00',
							'enter'			=> $time,
							'status'		=> 'Present',
							'real_enter'	=> $time,
						]);
					}
				}else if($d->CHECKTYPE == '1' or $d->CHECKTYPE == 1){
					Attendance::updateOrCreate([
						'employee'		=> $e->id,
						'created_at'	=> $date,
					], [
						'break'			=> '12:00:00',
						'end_break'		=> '13:00:00',
						'out'			=> $time,
						'status'		=> 'Present',
					]);
				}
			}
		}
		$employees = Employee::all();
		foreach ($employees as $e) {
			if(!Attendance::where('employee', $e->id)->where('created_at', $date)->exists()){
				Attendance::create([
					'employee'		=> $e->id,
					'created_at'	=> $date,
					'enter'			=> null,
					'break'			=> null,
					'end_break'		=> null,
					'out'			=> null,
					'status'		=> 'Absent',
				]);
			}
		}
		return 'Synchronize attendances from x100c successfull';
	}

}