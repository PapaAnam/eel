<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Absensi\CheckInOut;
use App\Models\Hris\Employee;
use App\Models\Hris\Attendance;
use App\Models\Hris\SalaryRule          as SR;

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
						if(is_null($att->enter) || $att->enter == '00:00:00'){
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
						if(is_null($att->enter) || $att->enter == '00:00:00'){
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
					$sr = SR::where('employee', $e->id)->where('status', '1')->first();
					if(strtotime($date.' '.$time) < strtotime($date.' 17:00:00')){
						$out = $time;
					}elseif(!is_null($sr)){
						if(strtotime($date.' '.$time) > strtotime($date.' '.$sr->out_at_rule)){
							$out = $sr->out_at_rule;
						}
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
						$ambilOutTerlama = is_null($att->out) || ($att->out == '00:00:00') || strtotime($date.' '.$att->out) < strtotime($date.' '.$time);
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
		$employees = Employee::active();
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
