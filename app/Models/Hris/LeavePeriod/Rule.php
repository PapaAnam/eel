<?php

namespace App\Models\Hris\LeavePeriod;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
	protected $table = 'hris_leave_period_rules_per_year';
	protected $fillable = [
		'status_id',
		'rule_year',
		'qty_max',
		'is_local',
		'user_id',
	];

	public function status()
	{
		return $this->belongsTo('App\Models\Hris\LeavePeriod\Status', 'status_id');
	}
}
