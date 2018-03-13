<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
class Calendar extends Model
{
	protected $table = 'hris_calendars';
	public $timestamps = false;
	protected $fillable = ['date', 'month', 'event'], $appends = ['month_name'];

	public function getMonthNameAttribute()
	{
		return english_month_name($this->month);
	}
}
