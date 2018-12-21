<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
class LeavePeriod extends Model
{
	protected $table = 'hris_leave_periods';
	protected $fillable = [
		'employee_id',
		'user_id',
		'start_date',
		'end_date',
		'day_total',
		'status_id',
		'status',
		'attachment',
	];

	public function employee()
	{
		return $this->belongsTo('App\Models\Hris\Employee', 'employee_id');
	}
}
