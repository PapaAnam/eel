<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hris\SalaryGroup as SG;

class SalaryGroupController extends Controller
{

	public function index()
	{
		return SG::all();
	}

	public function store(Request $r)
	{
		$r->validate([
			'name'	=> 'required',
		]);
		SG::create([
			'name'				=> $r->name,
			'basic_salary'		=> $r->basic_salary,
			'allowance'			=> $r->allowance,
			'ot_regular'		=> $r->ot_regular,
			'ot_holiday'		=> $r->ot_holiday,
			'incentive'			=> $r->incentive,
			'food_allowance'	=> $r->food_allowance,
			'rent_motorcycle'	=> $r->rent_motorcycle,
			'retention'			=> $r->retention,
			'tax_insurance'		=> $r->tax_insurance,
			'seguranca_social'	=> $r->seguranca_social,
			'cash_withdrawal'	=> $r->cash_withdrawal,
			'absent'			=> $r->absent,
		]);
		return 'Salary Group success created';
	}

	public function update(Request $r, $id)
	{
		$r->validate([
			'name'	=> 'required',
		]);
		SG::find($id)->update([
			'name'				=> $r->name,
			'basic_salary'		=> $r->basic_salary,
			'allowance'			=> $r->allowance,
			'ot_regular'		=> $r->ot_regular,
			'ot_holiday'		=> $r->ot_holiday,
			'incentive'			=> $r->incentive,
			'food_allowance'	=> $r->food_allowance,
			'rent_motorcycle'	=> $r->rent_motorcycle,
			'retention'			=> $r->retention,
			'tax_insurance'		=> $r->tax_insurance,
			'seguranca_social'	=> $r->seguranca_social,
			'cash_withdrawal'	=> $r->cash_withdrawal,
			'absent'			=> $r->absent,
		]);
		return 'Salary Group success updated';
	}

	public function delete(Request $r, $id)
	{
		SG::destroy($id);
		return 'Salary Group success deleted';
	}

}
