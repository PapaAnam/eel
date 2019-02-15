<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use App\Models\Hris\LeavePeriod\Status;
use App\Models\Hris\LeavePeriod\Rule;
use App\Http\Controllers\Controller;
use App\Models\Hris\LeavePeriod;
use App\Models\Hris\Employee;
use App\Models\Hris\Attendance;
use App\Models\Hris\Calendar;
use Auth;

class LeavePeriodController extends Controller
{

	public function allStatus()
	{
		return [
			'data'			=> Status::all(),
			'status_code' 	=> 200,
			'status'		=> 'success',
		];
	}

	public function updateRule(Request $request)
	{
		$user = Auth::guard('api')->user();
		$request->validate([
			'qty_max'=>'required|min:0',
		]);
		Rule::updateOrCreate([
			'is_local' 		=> $request->is_local,
			'status_id' 	=> $request->status_id,
			'rule_year' 	=> $request->year,
		],[
			'qty_max'		=> $request->qty_max,
			'user_id'		=> $user->id,
		]);
		return 'Leave Period Success';
	}

	public function store(Request $request)
	{
		$day_total 	= (strtotime($request->end_date)-strtotime($request->start_date)) / 3600 / 24; // brp lama leave
		$status_id 	= $request->status;
		$status = Status::find($request->status);
		$requiredAttach = $status->attachment == 'true';
		$request->validate([
			'employee'=>'required|numeric',
			'status'=>'required|numeric',
			'start_date'=>'required|date_format:Y-m-d',
			'end_date'=>[
				'required',
				'date_format:Y-m-d',
				function($attribute, $value, $fail) use ($day_total, $request){
					if ($day_total <= 0) {
						return $fail('End date is invalid.');
					}
				},
				'before:'.(substr($request->start_date, 0, 4)+1).'-01-01',
			],
			'attachment'=>$requiredAttach ? 'required|file' : 'nullable',
		]);

		// CEK RENTANG TANGGAL
		for($i = strtotime($request->start_date); $i <= strtotime($request->end_date); $i+= 86400) {
			$isMinggu = date('N', $i) == 7;
			$isEvent = Calendar::where('date', date('d', $i))->where('month', date('m', $i))->first();
			if($isMinggu){
			}elseif(!is_null($isEvent)){
			}else{
				$tanggal[] = date('Y-m-d', $i);
			}
		}

		$day_total = count($tanggal);
		
		# CEK STOK LEAVE PERIOD
		$rule_year 		= substr($request->start_date, 0, 4);
		$employee_id 	= $request->employee;
		$employee 		= Employee::find($employee_id);
		$is_local		= $employee->e_from == 'Local' ? 'true' : 'false';
		$rule 			= Rule::where('status_id', $status_id)
		->where('rule_year', $rule_year)
		// ->where('is_local', $is_local)
		->where('employee_id', $employee_id)
		->first();
		// // CEK GENDER
		// if($status->only_female == 'true'){
		// 	if($employee->gender != 'Female'){
		// 		return response('Status '.$status->status_name.' only for female employee', 409);
		// 	}
		// }
		// // CEK MARIED
		// if($status->only_maried == 'true'){
		// 	if($employee->marital_status == 0){
		// 		return response('Status '.$status->status_name.' only for maried employee', 409);
		// 	}
		// }
		// // CEK ONLY MALE
		// if($status->only_male == 'true'){
		// 	if($employee->gender != 'Male'){
		// 		return response('Status '.$status->status_name.' only for male employee', 409);
		// 	}
		// }
		// JIKA RULE PADA STATUS DAN PADA TAHUN TERTENTU BELUM DI SET
		if(is_null($rule)){
			return response('Status '.$status->status_name.' employee '.$employee->name.' in '.$rule_year.' not set yet', 409);
		}
		$max = $rule->qty_max;
		// AMBIL LEAVE PERIOD YANG SUDAH DIPAKAI
		// $ygKeambil = LeavePeriod::where('employee_id', $employee_id)
		// ->where('status_id', $status_id)
		// ->whereYear('start_date', $rule_year)
		// ->sum('day_total');
		$ygKeambil = $rule->used;
		// // DICEK DENGAN LAMA BEKERJANYA
		// if($employee->joining_date == '0000-00-00' || is_null($employee->joining_date)){
		// 	return response('Joining date for employee '.$employee->name.' is invalid with value '.$employee->joining_date, 409);
		// }
		// $joining_date = $employee->joining_date;
		// $lama_bekerja = $employee->length_of_work_in_month;
		// return $lama_bekerja;
		// if($status->joining_date == 'true' && $lama_bekerja < $max){
		// 	$max = $lama_bekerja;
		// }
		$sisa = $max - $ygKeambil;
		// if($rule_year > 2018){
		// 	if($status->accumulation == 'true'){
		// 		$tahun = range(2018,$rule_year);
		// 		$sisa = 0;
		// 		foreach ($tahun as $t) {
		// 			$sisa += Employee::LeftLeaveByStatus($employee->id, $status_id, $t);
		// 		}
		// 		// return $tahun;
		// 	}
		// }
		// return $sisa;
		if($sisa <= 0){
			return response('Status '.$status->status_name.' in '.$rule_year.' reach the limit for employee '.$employee->name, 409);
		}
		if($sisa < $day_total){
			return response('Status '.$status->status_name.' in '.$rule_year.' left '.$sisa.' for employee '.$employee->name, 409);
		}
		# END CEK STOK LEAVE PERIOD
		if($requiredAttach){
			$attachment = $request->file('attachment');
			// $attachment = $attachment->storeAs('public/leave-period/attachment', $attachment->getClientOriginalName());
			$attachment = $attachment->store('public/leave-period/attachment');
			$attachment = url(str_replace('public/', 'storage/', $attachment));
		}
		$user_id 	= Auth::guard('api')->user()->id;
		$lp = new LeavePeriod();
		$lp->employee_id 	= $request->employee;
		$lp->user_id 		= $user_id;
		$lp->start_date 	= $request->start_date;
		$lp->end_date 		= $request->end_date;
		$lp->day_total 		= $day_total;
		$lp->status_id 		= $request->status;
		$lp->status 		= $status->status_name;
		$lp->reason 		= $request->reason;
		if($requiredAttach)
			$lp->attachment 	= $attachment;
		$lp->save();
		foreach ($tanggal as $t) {
			$attendance = Attendance::where('employee', $employee_id)
			->where('created_at', 'LIKE', $t.'%')
			->first();
			$isMinggu = date('N', strtotime($t)) == 7;
			if(is_null($attendance)){
				Attendance::create([
					'employee'=>$employee_id,
					'created_at'=>$t,
					'status'=>$status->status_name,
				]);
			}else{
				$attendance->update([
					'employee'=>$employee_id,
					'created_at'=>$t,
					'status'=>$status->status_name,
				]);
			}
		}
		$rule->used += $day_total;
		$rule->save();
		return 'Leave period success created';
	}

	public function index(Request $request)
	{
		$month	= $request->query('month');
		$year	= $request->query('year');
		if($year && $month){
			return LeavePeriod::with('employee')->whereMonth('start_date', $month)->whereYear('start_date', $year)->latest()->get();
		}
	}

	public function delete(LeavePeriod $leave)
	{
		// CEK RENTANG TANGGAL
		for($i = strtotime($leave->start_date); $i <= strtotime($leave->end_date); $i+= 86400) {
			$tanggal[] = date('Y-m-d', $i);
		}
		Attendance::whereIn('created_at',$tanggal)->where('employee', $leave->employee_id)->delete();
		$leave->delete();
		return 'Leave period success deleted';
	}

	public function left(Request $request)
	{
		$request->validate([
			'employee_id'=>[
				'required',
				'numeric',
			]
		]);
		$employee_id	= $request->query('employee_id');
		$year			= $request->query('year');
		$employee 		= Employee::find($employee_id);
		$is_local 		= $employee->e_from == 'Local' ? 'true' : 'false';
		$rules 			= Rule::with('status')->where('employee_id', $employee_id)->where('rule_year', $year)->where('is_local', $is_local)->get();
		$status =  Status::with(['rules'=>function($q) use ($year, $employee_id){
			$q->with('employee')->where('rule_year', $year)->where('employee_id', $employee_id);
		}])->get()->transform(function($item) use ($employee){
			$item->rule = null;
			$item->employee = $employee->name;
			$item->max = 0;
			$item->used = 0;
			$item->leftovers = 0;
			if(count($item->rules) > 0){
				$item->rule = $item->rules->first();
				$item->max = $item->rule->qty_max;
				$item->used = $item->rule->used;
				$item->leftovers = $item->max - $item->used;
			}
			return $item;
		});
		$status_id = $request->query('status_id');
		if(is_null($status_id))
			return $status;
		return $status->where('id', $status_id)->first();
		// $rules->transform(function($item) use ($employee, $year, $is_local){
		// 	$max = $item->qty_max;
		// 	if($item->status->joining_date == 'true'){
		// 		if($employee->length_of_work_in_month < $max){
		// 			$max = $employee->length_of_work_in_month;
		// 		}
		// 	}
		// 	if($item->status->only_female == 'true'){
		// 		if($employee->gender != 'Female'){
		// 			$max = 0;
		// 		}
		// 	}
		// 	if($item->status->only_maried == 'true'){
		// 		if($employee->marital_status != 1){
		// 			$max = 0;
		// 		}
		// 	}
		// 	if($year > 2018){
		// 		if($item->status->accumulation == 'true'){
		// 			$tahun = range(2018,($year-1));
		// 			$sisa = 0;
		// 			foreach ($tahun as $t) {
		// 				$sisa += Employee::LeftLeaveByStatus($employee->id, $item->status_id, $t);
		// 			}
		// 			$max += $sisa;
		// 		}
		// 	}
		// 	$item->max = $max;
		// 	$used = (int) LeavePeriod::where('employee_id', $employee->id)->whereYear('start_date', $year)->where('status_id', $item->status_id)->sum('day_total');
		// 	$item->used = $used;
		// 	$item->leftovers = $max - $used;
		// 	$item->employee = $employee->name;
		// 	if($item->status->only_female == 'true'){
		// 		if($employee->gender != 'Female'){
		// 			$item->status->status_name = $item->status->status_name.' <b><i>(only female employee)</i></b>';
		// 		}
		// 	}
		// 	return $item;
		// });
		// return [];
		// $rules->transform(function($item) use ($employee){
		// 	$item->max = $item->qty_max;
		// 	$item->leftovers = $item->qty_max - $item->used;
		// 	$item->employee = $employee->name;
		// 	return $item;
		// });
		// return $rules;
	}

	public function docPrint(LeavePeriod $leave)
	{
		$leave->load('employee.departmentdetail', 'employee.job');
		$rules = Rule::with('status')
		->where('rule_year', $leave->year)
		->where('is_local', $leave->employee->is_local)
		->get();
		$rules->transform(function($item) use ($leave){
			$item->max = Employee::maxLeaveByStatus($leave->employee_id, $item->status_id, $leave->year);
			if($leave->status_id == $item->status_id){
				$item->total = $leave->day_total;
				$item->sisa  = $item->max - $item->total;
			}else{
				$item->total = '';
				$item->sisa  = '';
			}
			return $item;
		});
		// return $rules;
		return view('hris.leave-periods.doc-print',[
			'leave'=>$leave,
			'rules'=>$rules,
		]);
	}

}