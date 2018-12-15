<?php

namespace App\Models\Hris\LeavePeriod;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

	protected $table = 'hris_leave_period_names';

	protected $fillable = [
		'status_name',
		'joining_date',
		'only_female',
		'only_maried',
	];

}
