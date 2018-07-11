<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;

class CashWithdrawal extends Model
{
	protected $table = 'hris_cash_withdrawal';
	public $timestamps = false;
	protected $fillable = [
		'applicant_id',
		'job_title_id',
		'department_id',
		'hrd_id',
		'manager_id',
		'total',
		'reason',
		'installment',
		'month_start',
		'year_start',
		'month_end',
		'year_end',
		'created_at',
	];

	public function applicant()
	{
		return $this->belongsTo('App\Models\Hris\Employee', 'applicant_id');
	}

	public function manager()
	{
		return $this->belongsTo('App\Models\Hris\Employee', 'manager_id');
	}

	public function hrd()
	{
		return $this->belongsTo('App\Models\Hris\Employee', 'hrd_id');
	}
}
