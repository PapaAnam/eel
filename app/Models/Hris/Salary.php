<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hris\Attendance;
class Salary extends Model
{
	protected $table = 'hris_salaries';
	public $timestamps = false;
	protected $fillable = ['employee', 'created_at', 'month', 'year', 'department', 'salary_rule', 'position', 'over_time', 'ot_regular', 'ot_holiday', 'ot_regular_in_hours', 'ot_holiday_in_hours', 'absent', 'absent_punishment', 'salary_group', 'present_total', 'seguranca_id'];
	protected $appends = ['clear_salary', 'gross_salary', 'seguranca', 'total_potongan', 'sg'];

	# RELATIONSHIP

	public function emp()
	{
		return $this->belongsTo('App\Models\Hris\Employee', 'employee');
	}

	public function sr()
	{
		return $this->belongsTo('App\Models\Hris\SalaryRule', 'salary_rule');
	}

	# SCOPE

	public function scopeSlip($q)
	{
		return $q->with(['emp.pos', 'sr.salaryGroup']);
	}

	# MUTATOR

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
			$sr = $this->sr;
			$bs = 0;
			$incentive = 0;
			$food = 0;
			$allowance = 0;
			$retention = 0;
			$ot_regular = 0;
			$ot_holiday = 0;
			$etc = 0;
			$thr = 0;
			$rent_motorcycle = 0;
			$sg = $sr->salaryGroup;
			if($sg){
				if($sg['basic_salary'] == 1){
					$bs = $sr->basic_salary;
					if($sr->salary_type == 'daily'){
						$bs = $this->present_total * $bs;
					}
				}
				if($sg['incentive'] == 1){
					$incentive = $sr->incentive;
				}
				if($sg['food_allowance'] == 1){
					$food = $sr->eat_cost;
				}
				if($sg['allowance'] == 1){
					$allowance = $sr->allowance;
				}
				if($sg['retention'] == 1){
					$retention = $sr->ritation;
				}
				if($sg['ot_regular'] == 1){
					$ot_regular = $this->ot_regular;
				}
				if($sg['ot_holiday'] == 1){
					$ot_holiday = $this->ot_holiday;
				}
				if($sg['rent_motorcycle'] == 1){
					$rent_motorcycle = $sr->rent_motorcycle;
				}
				if($sg['etc'] == 1){
					$etc = $sr->etc;
				}	
				if($sg['thr'] == 1){
					$thr = $sr->thr;
				}	
			}
			return $bs+$incentive+$food+$allowance+$retention+$ot_regular+$ot_holiday+$rent_motorcycle+$etc+$thr;
		}
		return 0;
	}

	public function getSegurancaAttribute()
	{
		if(is_null($this->seguranca_id) || $this->seguranca_id == '' || $this->seguranca_id == '0'){
			return 0;
		}
		$sr = $this->sr;
		if($sr){
			$sg = $sr->salaryGroup;
			if($sg){
				if($sg->seguranca_social == 1){
					$seguranca_social = $sr->seguranca;
					if(config('app.seguranca')){
						$seguranca_social = $sr->basic_salary * 4 / 100;
					}	
					return round($seguranca_social, 2);
				}
			}
		}
		return 0;
	}

	public function getTotalPotonganAttribute()
	{
		$cash = 0;
		$absent_punishment = 0;
		$tax_insurance = 0;
		$sr = $this->sr;
		if($sr){
			$sg = $this->sr->salaryGroup;
			if($sg){
				if($sg['cash_withdrawal'] == 1){
					$cash = is_null($this->sr) ? 0 : $this->sr->cash_receipt;
				}
				if($sg['absent'] == 1){
					$absent_punishment = $this->absent_punishment;
				}
				if($sg['tax_insurance'] == 1){
					$tax_insurance = $this->tax_insurance;
				}	
			}
			return $this->seguranca+$cash+$absent_punishment+$tax_insurance;
		}
		return 0;
	}

	public function getTaxInsuranceAttribute($value)
	{
		$tax = $this->gross_salary > 500 ? ($this->gross_salary - 500) * 10 / 100 : 0;
		return round($tax, 2);
	}

	public function getSgAttribute()
	{
		if($this->sr){
			if($this->sr->salaryGroup){
				return $this->sr->salaryGroup;
			}
		}
		return null;
	}

}
