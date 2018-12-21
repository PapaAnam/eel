<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use App\Models\Hris\LeavePeriod\Status;
use App\Models\Hris\LeavePeriod\Rule;
use App\Http\Controllers\Controller;
use App\Models\Hris\LeavePeriod;
use App\Models\Hris\Employee;
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
		// return $request->all();
		$day_total 	= (strtotime($request->end_date)-strtotime($request->start_date)) / 3600 / 24;
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
		
		# CEK STOK LEAVE PERIOD
		$rule_year 		= substr($request->start_date, 0, 4);
		$employee_id 	= $request->employee;
		$employee 		= Employee::find($employee_id);
		$is_local		= $employee->e_from == 'Local' ? 'true' : 'false';
		$max 			= Rule::where('status_id', $status_id)
		->where('rule_year', $rule_year)
		->where('is_local', $is_local)
		->first();
		// CEK GENDER
		if($status->only_female == 'true'){
			if($employee->gender != 'Female'){
				return response('Status '.$status->status_name.' only for female employee', 409);
			}
		}
		// CEK MARIED
		if($status->only_maried == 'true'){
			if($employee->marital_status == 0){
				return response('Status '.$status->status_name.' only for maried employee', 409);
			}
		}
		// JIKA RULE PADA STATUS DAN PADA TAHUN TERTENTU BELUM DI SET
		if(is_null($max)){
			return response('Status '.$status->status_name.' in '.$rule_year.' not set yet', 409);
		}
		$max = $max->qty_max;
		// AMBIL LEAVE PERIOD YANG SUDAH DIPAKAI
		$ygKeambil = LeavePeriod::where('employee_id', $employee_id)
		->where('status_id', $status_id)
		->whereYear('start_date', $rule_year)
		->sum('day_total');
		// DICEK DENGAN LAMA BEKERJANYA
		if($employee->joining_date == '0000-00-00' || is_null($employee->joining_date)){
			return response('Joining date for employee '.$employee->name.' is invalid with value '.$employee->joining_date, 409);
		}
		$joining_date = $employee->joining_date;
		$lama_bekerja = floor((strtotime($joining_date) - strtotime(date('Y-m-d'))) / 3600 / 30); // dalam bulan
		if($status->joining_date == 'true' && $lama_bekerja < $max){
			$max = $lama_bekerja;
		}
		$sisa = $max - $ygKeambil;
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
		if($requiredAttach)
			$lp->attachment 	= $attachment;
		$lp->save();
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
		$leave->delete();
		return 'Leave period success deleted';
	}

}