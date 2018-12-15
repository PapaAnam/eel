<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use App\Models\Hris\LeavePeriod\Status;
use App\Models\Hris\LeavePeriod\Rule;
use App\Http\Controllers\Controller;
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
}