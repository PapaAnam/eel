<?php

use Illuminate\Database\Seeder;
use App\Models\Absensi\CheckInOut;
use App\Models\Hris\Attendance;
use App\Models\Hris\Employee;
use App\Models\Hris\Attendances\Zt1300\TaLog;
use App\Models\Hris\SalaryRule          as SR;

class SinkronAttendance extends Seeder
{

	private function getDate()
	{
		return '2018-05-07';
	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$date 	= $this->getDate();
        $data 	= CheckInOut::with('UserInfo')
		->whereDate('CHECKTIME', 'LIKE', $date)
		->get();
		// x100c
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
					if(!is_null($sr)){
						$out = $sr->out_at_rule;
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
						// return strtotime($date.' '.$att->out);// < 
						// return strtotime($date.' '.$time);// ? 1 : 0;
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
		echo 'Synchronize attendances from x100c successfull';

		// zt1300
		$data = TaLog::with('staff')
		->where('Tanggal_Log', $date)
		->get();
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
					if(!is_null($sr)){
						$out = $sr->out_at_rule;
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
		$employees = Employee::all();
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
		echo 'Synchronize attendances from zt1300 successfull';
    }
}
