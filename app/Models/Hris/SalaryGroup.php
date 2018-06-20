<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;

class SalaryGroup extends Model
{
	public $timestamps = false;
	protected $table = 'hris_salary_group';
	protected $fillable = ['id', 'name', 'basic_salary', 'allowance', 'ot_regular', 'ot_holiday', 'incentive', 'food_allowance', 'rent_motorcycle', 'retention', 'tax_insurance', 'seguranca_social', 'cash_withdrawal', 'absent'];

}