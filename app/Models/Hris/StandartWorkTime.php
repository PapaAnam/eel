<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
use App\Mytrait\ConvertHour;

class StandartWorkTime extends Model
{

	use ConvertHour;

	protected $table = 'hris_max_work_time';

	public $timestamps = false;

	protected $fillable = [
		'max_time', 'year', 'month'
	];

	protected $appends = [
		'max_time_view'
	];

	public function getMaxTimeViewAttribute()
	{
		return $this->convertHour($this->max_time);
	}

}
