<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hris\Attendance;
class Salary extends Model
{
	protected $table = 'hris_salaries';
	public $timestamps = false;
	protected $fillable = ['employee', 'created_at', 'month', 'year', 'department', 'salary_rule', 'position', 'over_time', 'ot_regular', 'ot_holiday', 'ot_regular_in_hours', 'ot_holiday_in_hours', 'seguranca', 'absent', 'absent_punishment', 'salary_group', 'present_total', 'seguranca_id'];
	protected $appends = ['clear_salary', 'gross_salary', 'seguranca', 'total_potongan'];

	public function emp()
	{
		return $this->belongsTo('App\Models\Hris\Employee', 'employee');
	}

	public function sr()
	{
		return $this->belongsTo('App\Models\Hris\SalaryRule', 'salary_rule');
	}

	public function sg()
	{
		return $this->belongsTo('App\Models\Hris\SalaryGroup', 'salary_group');
	}

	public function getClearSalaryAttribute()
	{
		if($this->gross_salary){
			$sr = $this->sr;
			$seguranca_social = $sr->seguranca;
			if(config('app.seguranca')){
				$seguranca_social = $sr->basic_salary * 4 / 100;
			}
			return round($this->gross_salary - $this->total_potongan, env('ROUND', 2));
		}
		return 0;
	}

	public function getGrossSalaryAttribute()
	{
		if($this->sr){
			// if($this->sr->salary_type == 'freelance'){
			// 	return round($this->basic_salary * $this->present_total, 2);
			// }	
			$sr = $this->sr;
			$sg = $this->sg;
			$bs = 0;
			if($sg['basic_salary'] == 1){
				$bs = $sr->basic_salary;
			}
			$incentive = 0;
			if($sg['incentive'] == 1){
				$incentive = $sr->incentive;
			}
			$food = 0;
			if($sg['food_allowance'] == 1){
				$food = $sr->eat_cost;
			}
			$allowance = 0;
			if($sg['allowance'] == 1){
				$allowance = $sr->allowance;
			}
			$retention = 0;
			if($sg['retention'] == 1){
				$retention = $sr->ritation;
			}
			$ot_regular = 0;
			if($sg['ot_regular'] == 1){
				$ot_regular = $this->ot_regular;
			}
			$ot_holiday = 0;
			if($sg['ot_holiday'] == 1){
				$ot_holiday = $this->ot_holiday;
			}
			$rent_motorcycle = 0;
			if($sg['rent_motorcycle'] == 1){
				$rent_motorcycle = $sr->rent_motorcycle;
			}
			$etc = 0;
			if($sg['etc'] == 1){
				$etc = $sr->etc;
			}
			return $bs+$incentive+$food+$allowance+$retention+$ot_regular+$ot_holiday+$rent_motorcycle+$etc;
		}
		return 0;
	}

	public function getSegurancaAttribute()
	{
		if(is_null($this->seguranca_id) or $this->seguranca_id == ''){
			return 0;
		}
		if(is_null($this->sg['seguranca_social']) || $this->sg['seguranca_social'] == '0'){
			return 0;
		}
		if(is_null($this->seguranca_id) || $this->seguranca_id == '' || $this->seguranca_id == '0'){
			return 0;
		}
		$sr = $this->sr;
		if(is_null($sr)){
			return 0;
		}
		$seguranca_social = $sr->seguranca;
		if(config('app.seguranca')){
			$seguranca_social = ($sr->basic_salary 
				// - $this->absent_punishment
			) * 4 / 100;
		}
		return round($seguranca_social, 2);
	}

	public function getTotalPotonganAttribute()
	{
		$sg = $this->seguranca;
		if(is_null($this->seguranca_id) or $this->seguranca_id == ''){
			$sg = 0;
		}
		if(is_null($this->sg['seguranca_social']) || $this->sg['seguranca_social'] == '0'){
			$sg = 0;
		}
		$cash = 0;
		if($this->sg['cash_withdrawal'] == 1){
			$cash = is_null($this->sr) ? 0 : $this->sr->cash_receipt;
		}
		$absent_punishment = 0;
		if($this->sg['absent'] == 1){
			$absent_punishment = $this->absent_punishment;
		}
		$tax_insurance = 0;
		if($this->sg['tax_insurance'] == 1){
			$tax_insurance = $this->tax_insurance;
		}
		return $sg+$cash+$absent_punishment+$tax_insurance;
	}

	public function getTaxInsuranceAttribute($value)
	{
		$tax = $this->gross_salary > 500 ? ($this->gross_salary - 500) * 10 / 100 : 0;
		return round($tax, 2);
	}

	public function getOtRegularAttribute($value)
	{
		if($this->sr->salary_type == 'sales' || $this->sr->salary_type == 'driver'){
			return 0;
		}
		return $value;
	}
}
