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
		'attachment',
	];

	public function leaveperiod()
	{
		return $this->hasMany('App\Models\Hris\LeavePeriod', 'status_id');
	}

	public function rules()
	{
		return $this->hasMany('App\Models\Hris\LeavePeriod\Rule', 'status_id');
	}

}
