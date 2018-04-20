<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hris\Attendance;
class Salary extends Model
{
	protected $table = 'hris_salaries';
	public $timestamps = false;
	protected $fillable = ['employee', 'created_at', 'month', 'year', 'department', 'salary_rule', 'position', 'over_time', 'ot_regular', 'ot_holiday', 'ot_regular_in_hours', 'ot_holiday_in_hours', 'seguranca'];
	protected $appends = ['clear_salary', 'gross_salary', 
	// 'ot_regular', 
	// 'ot_holiday', 'ot_regular_in_hours', 'ot_holiday_in_hours'
];

	public function emp()
	{
		return $this->belongsTo('App\Models\Hris\Employee', 'employee');
	}

	public function sr()
	{
		return $this->belongsTo('App\Models\Hris\SalaryRule', 'salary_rule');
	}

	public function getClearSalaryAttribute()
	{
		if($this->gross_salary){
			$sr = $this->sr;
			$seguranca_social = $sr->seguranca;
			if(config('app.seguranca')){
				$seguranca_social = $sr->basic_salary * 4 / 100;
			}
			return round($this->gross_salary - ($seguranca_social + $sr->cash_receipt), env('ROUND', 2));
		}
		return 0;
	}

	public function getGrossSalaryAttribute()
	{
		if($this->sr){
			$sr = $this->sr;
			return $sr->basic_salary+$sr->incentive+$sr->eat_cost+$sr->allowance+$sr->ritation+$sr->etc+$this->over_time;
		}
		return 0;
	}

	// public function getOtRegularAttribute()
	// {
	// 	$ot_reg = Attendance::otRegularInMonth($this->year, $this->month, $this->employee);
	// 	$ot = round($this->sr->basic_salary/22/8*2*$ot_reg, env('ROUND', 2));
	// 	return $ot;
	// }

	// public function getOtRegularInHoursAttribute()
	// {
	// 	$ot_reg = Attendance::otRegularInMonth($this->year, $this->month, $this->employee);
	// 	return convertHour($ot_reg);
	// }

	// public function getOtHolidayAttribute()
	// {
	// 	$ot = Attendance::overTimeHolidayInMonth($this->year, $this->month, $this->employee);
	// 	return $ot['in_money'];
	// }

	// public function getOtHolidayInHoursAttribute()
	// {
	// 	$ot = Attendance::overTimeHolidayInMonth($this->year, $this->month, $this->employee);
	// 	return $ot['in_hours'];
	// }
}
