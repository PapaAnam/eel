<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;

class LeavePeriodRule extends Model
{
	protected $table = 'hris_leave_period_rules';
	public $timestamps = false;
	protected $fillable = ['employee_type', 'special_permit', 'holiday', 'father_leave', 'sick', 'pregnancy', ];
}
