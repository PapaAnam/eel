<?php

namespace App\Http\Controllers\Hris\AlwaysPresence;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hris\Employee;

class LoginController extends Controller
{

	public function login(Request $request)
	{
		$request->validate([
			'nin'	=> 'required|numeric',
		]);
		$employee = Employee::where('nin', $request->nin)->first();
		if(is_null($employee)){
			return [
				'status' => 'error',
				'message' => 'Employee not found with nin : '.$request->nin,
			];
		}
		return $employee->only([
			'id', 
			'nin',
			'name', 
			'gender', 
		]);
	}

}
