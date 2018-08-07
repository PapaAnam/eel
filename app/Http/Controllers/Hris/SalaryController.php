<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hris\Salary;

class SalaryController extends Controller
{

	public function multipleSlip(Request $r)
	{
		$employees = explode(',', $r->query('employees'));
		$salaries = Salary::whereIn('employee', $employees)
		->where('month', $r->query('month'))
		->where('year', $r->query('year'))
		->get();
		return view('hris/salaries/multiple-slip', [
			'salaries'	=> $salaries,
		]);
	}

}
