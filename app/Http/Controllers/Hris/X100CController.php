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
		$data = $this->get($r);
		foreach ($data as $d) {
			$u 		= $d->userInfo;
			$date 	= substr($d->CHECKTIME, 0, 10);
			$time 	= substr($d->CHECKTIME, 11, 8);
			$e 		= Employee::where('nin', $u->BADGENUMBER)->first();
			if($e){
				if($d->CHECKTYPE == 'I' or $d->CHECKTYPE == 'i'){
					Attendance::updateOrCreate([
						'employee'		=> $e->id,
						'created_at'	=> $date,
					], [
						'break'			=> '12:00:00',
						'end_break'		=> '13:00:00',
						'enter'			=> $time,
					]);
				}
			}else if($e){
				if($d->CHECKTYPE == '1' or $d->CHECKTYPE == 1){
					Attendance::updateOrCreate([
						'employee'		=> $e->id,
						'created_at'	=> $date,
					], [
						'break'			=> '12:00:00',
						'end_break'		=> '13:00:00',
						'out'			=> $time,
					]);
				}
			}
		}
		return 'Synchronize attendances from x100c successfull';
	}

}
