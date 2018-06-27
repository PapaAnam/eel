<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;

class LeavePeriodLeft extends Model
{
	protected $table = 'hris_leave_period_lefts';
	protected $fillable = ['employee_id','special_permit','holiday','father_leave','sick','pregnancy','year',];
	public $timestamps = false;

	public function emp()
    {
        return $this->belongsTo('App\Models\Hris\Employee', 'employee_id');
    }
}
