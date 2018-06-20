<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hris\Attendance;
class Salary extends Model
{
	protected $table = 'hris_salaries';
	public $timestamps = false;
	protected $fillable = ['employee', 'created_at', 'month', 'year', 'department', 'salary_rule', 'position', 'over_time', 'ot_regular', 'ot_holiday', 'ot_regular_in_hours', 'ot_holiday_in_hours', 'seguranca', 'absent', 'absent_punishment', 'tax_insurance', 'salary_group'];
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
			$sr = $this->sr;
			return $sr->basic_salary+$sr->incentive+$sr->eat_cost+$sr->allowance+$sr->ritation+$sr->etc+$this->ot_regular+$this->ot_holiday+$sr->rent_motorcycle;
		}
		return 0;
	}

	public function getSegurancaAttribute()
	{
		$sr = $this->sr;
		$seguranca_social = $sr->seguranca;
		if(config('app.seguranca')){
			$seguranca_social = $sr->basic_salary * 4 / 100;
		}
		return $seguranca_social;
	}

	public function getTotalPotonganAttribute()
	{
		return $this->seguranca+$this->sr->cash_receipt+$this->absent_punishment+$this->tax_insurance;
	}
}
