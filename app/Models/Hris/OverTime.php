<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
class OverTime extends Model
{

	protected $table = 'hris_over_times';

	public $timestamps = false;

	protected $fillable = [
        'employee_id', 'month', 'year', 'ot_regular_in_hours', 'ot_holiday_in_hours',
    ];

    protected $appends = [
        'ot_reg', 'ot_hol',
    ];

    private function convertHour($hours)
    {
        $jam   = floor($hours);
        $dec   = $hours - $jam;
        $minutes = round($dec * 60);
        $t = ($jam > 1) ? 'hours' : "hour";
        return $jam . ' '.$t.' '.$minutes.' minutes';
    }

    public function getOtHolAttribute()
    {
        return $this->convertHour($this->ot_holiday_in_hours);
    }

    public function getOtRegAttribute()
    {
        return $this->convertHour($this->ot_regular_in_hours);
    }

}
