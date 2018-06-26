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
		$berhasil = 0;
		foreach ($data as $d) {
			$u 		= $d->userInfo;
			$time 	= substr($d->CHECKTIME, 11, 8);
			$e 		= Employee::where('nin', $u->BADGENUMBER)->orWhere('nin', (int) $u->BADGENUMBER)->orWhere('nin', $u->SSN)->orWhere('nin', (int) $u->SSN)->first();
			if(!is_null($e)){
				$att = Attendance::where('employee', $e->id)->where('created_at', $date)->first();
				$isLowerThanEight = strtotime($date.' '.$time) >= strtotime($date.' 03:00:00') && strtotime($date.' '.$time) <= strtotime($date.' 08:30:00');
				$isNormalEnter = strtotime($date.' '.$time) > strtotime($date.' 08:30:00') && strtotime($date.' '.$time) < strtotime($date.' 11:59:00');
				$isOutTime = strtotime($date.' '.$time) >= strtotime($date.' 13:00:00') && strtotime($date.' '.$time) <= strtotime($date.' 23:59:00');
				if($isLowerThanEight){
					if(is_null($att)){
						Attendance::create([
							'employee'		=> $e->id,
							'created_at'	=> $date,
							'break'			=> '12:00:00',
							'end_break'		=> '13:00:00',
							'enter'			=> '08:30:00',
							'status'		=> 'Present',
							'real_enter'	=> $time,
						]);
					}else{
						if(is_null($att->enter) or $att->enter == '00:00:00'){
							Attendance::where([
								'employee'		=> $e->id,
								'created_at'	=> $date,
							])->update([
								'break'			=> '12:00:00',
								'end_break'		=> '13:00:00',
								'enter'			=> '08:30:00',
								'status'		=> 'Present',
								'real_enter'	=> $time,
							]);
						}
					}
					$berhasil++;
				}else if($isNormalEnter){
					if(is_null($att)){
						Attendance::create([
							'employee'		=> $e->id,
							'created_at'	=> $date,
							'break'			=> '12:00:00',
							'end_break'		=> '13:00:00',
							'enter'			=> $time,
							'status'		=> 'Present',
							'real_enter'	=> $time,
						]);
					}else{
						if(is_null($att->enter) or $att->enter == '00:00:00'){
							Attendance::where([
								'employee'		=> $e->id,
								'created_at'	=> $date,
							])->update([
								'break'			=> '12:00:00',
								'end_break'		=> '13:00:00',
								'enter'			=> $time,
								'status'		=> 'Present',
								'real_enter'	=> $time,
							]);
						}
					}
					$berhasil++;
				}else if($isOutTime){
					$out = $time;
					if($e->salary_type == 'driver' || $e->salary_type == 'sales'){
						$out = '17:00:00';
					}
					if(is_null($att)){
						Attendance::create([
							'employee'		=> $e->id,
							'created_at'	=> $date,
							'break'			=> '12:00:00',
							'end_break'		=> '13:00:00',
							'out'			=> $out,
							'status'		=> 'Present',
						]);
					}else{
						$ambilOutTerlama = is_null($att->out) or $att->out == '00:00:00' or strtotime($date.' '.$att->out) < strtotime($date.' '.$time);
						if($ambilOutTerlama){
							Attendance::where([
								'employee'		=> $e->id,
								'created_at'	=> $date,
							])->update([
								'break'			=> '12:00:00',
								'end_break'		=> '13:00:00',
								'out'			=> $out,
								'status'		=> 'Present',
							]);
						}
					}
					$berhasil++;
				}
			}
		}
		$employees = Employee::all();
		foreach ($employees as $e) {
			if(!Attendance::where('employee', $e->id)->where('created_at', $date)->exists()){
				Attendance::create([
					'employee'		=> $e->id,
					'created_at'	=> $date,
					'status'		=> 'Absent',
				]);
			}
		}
		return 'Synchronize attendances from x100c successfull';
	}

}
