<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
class Salary extends Model
{
	protected $table = 'hris_salaries';
	public $timestamps = false;
	protected $fillable = ['employee', 'created_at', 'month', 'year', 'department', 'salary_rule', 'position'];
	protected $appends = ['clear_salary'];

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
		if($this->sr){
			if(count($this->sr) > 0){
				$sr = $this->sr[0];
				return $sr->basic_salary+$sr->incentive+$sr->eat_cost+$sr->allowance+$sr->ritation;
			}
		}
		return 0;
	}
}
