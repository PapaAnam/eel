<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;

class LeavePeriodRule extends Model
{
	protected $table = 'hris_leave_period_rules_per_year';
	protected $fillable = [
		'status_id',
		'rule_year',
		'qty_max',
		'is_local',
	];
}
