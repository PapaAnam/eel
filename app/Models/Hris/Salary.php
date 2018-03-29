<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
class Salary extends Model
{
	protected $table = 'hris_salaries';
	public $timestamps = false;
	protected $fillable = ['employee', 'created_at', 'month', 'year', 'department', 'salary_rule', 'position', 'over_time'];
	protected $appends = ['clear_salary', 'gross_salary'];

	public function emp()
	{
		return $this->belongsTo('App\Models\Hris\Employee', 'employee');
	}

	public function sr()
	{
		return $this->hasMany('App\Models\Hris\SalaryRule', 'id', 'salary_rule');
	}

	public function getClearSalaryAttribute()
	{
		if($this->gross_salary){
			$sr = $this->sr[0];
			// return $this->gross_salary - ($sr->seguranca_social + $sr->cash_receipt);
			return round($this->gross_salary - ($sr->seguranca_social + $sr->cash_receipt), env('ROUND', 2));
		}
		return 0;
	}

	public function getGrossSalaryAttribute()
	{
		if($this->sr){
			if(count($this->sr) > 0){
				$sr = $this->sr[0];
				// return round($sr->basic_salary+$sr->incentive+$sr->eat_cost+$sr->allowance+$sr->ritation+$sr->etc+$this->over_time, env('ROUND', 2));
				return $sr->basic_salary+$sr->incentive+$sr->eat_cost+$sr->allowance+$sr->ritation+$sr->etc+$this->over_time;
			}
		}
		return 0;
	}
}
