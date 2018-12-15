<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeavePeriodStatus extends Model
{

	protected $table = 'hris_leave_period_names';

	protected $fillable = [
		'status_name',
		'joining_date',
		'only_female',
		'only_maried',
	];

}
