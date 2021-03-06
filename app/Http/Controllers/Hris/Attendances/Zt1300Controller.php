<?php

namespace App\Http\Controllers\Hris\Attendances;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hris\Attendances\Zt1300\TaLog;
use App\Models\Hris\Employee;
use App\Models\Hris\Attendance;
use App\Models\Hris\SalaryRule          as SR;

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
				$att = Attendance::where('employee', $e->id)->where('created_at', $date)->first();
				if(strtotime($date.' '.$time) >= strtotime($date.' 03:00:00') && strtotime($date.' '.$time) <= strtotime($date.' 08:30:00')){
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
				}else if(strtotime($date.' '.$time) > strtotime($date.' 08:30:00') && strtotime($date.' '.$time) < strtotime($date.' 11:59:00')){
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
				}else if(strtotime($date.' '.$time) >= strtotime($date.' 13:00:00') && strtotime($date.' '.$time) <= strtotime($date.' 23:59:00')){
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
						if(is_null($att->out) || $att->out == '00:00:00' || strtotime($date.' '.$att->out) < strtotime($date.' '.$time)){
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
			$hi = Attendance::where('employee', $e->id)->where('created_at', $date)->first();
			if(is_null($hi)){
				Attendance::create([
					'employee'		=> $e->id,
					'created_at'	=> $date,
					'status'		=> 'Absent',
				]);
			}
		}
		return 'Synchronize attendances from zt1300 successfull';
	}

}
