<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hris\Calendar;

class Attendance extends Model
{
	protected $table = 'hris_attendances';
	public $timestamps = false;
	protected $fillable = ['employee', 'created_at', 'enter', 'break', 'end_break', 'out', 'status'];
    protected $appends = ['stat', 'work_total', 'over_time', 'work_total_in_hours', 'is_holiday', 'over_time_in_hours', 'over_time_in_money', 
    // 'over_time_in_week', 
    'day'];

    public function emp()
    {
        return $this->belongsTo('App\Models\Hris\Employee', 'employee');
    }

    public function getStatAttribute()
    {
        return absence_status($this->status);
    }

    public function getWorkTotalAttribute()
    {
        if($this->work_total_in_hours === '-')
            return '-';
        return convertHour($this->work_total_in_hours);
    }

    public function getWorkTotalInHoursAttribute()
    {
        if($this->break && $this->enter && $this->end_break && $this->out && !$this->is_holiday){
            $kedua = (strtotime($this->out)-strtotime($this->end_break));
            if($kedua < 0){
                $kedua = 0;
            }else{
                $kedua = $kedua/3600;
            }
            return (strtotime($this->break)-strtotime($this->enter))/3600 + $kedua;
        }
        return '-';
    }

    private function convertHour($hours)
    {
        $jam   = floor($hours);
        $dec   = $hours - $jam;
        $minutes = round($dec * 60);
        $t = ($jam > 1) ? 'hours' : "hour";
        return $jam . ' '.$t.' '.$minutes.' minutes';
    }

    public function getOverTimeAttribute()
    {
        if($this->over_time_in_hours === 0)
            return 0;
        return convertHour($this->over_time_in_hours);
    }

    public function getOverTimeInHoursAttribute()
    {
        // if($this->status === 'Over Time' || ($this->status === 'Present' && $this->is_holiday)){
            if($this->out && $this->enter){
                $break      = strtotime('12:00:00');
                $end_break  = strtotime('13:00:00');
                $enter      = strtotime($this->enter);
                $out        = strtotime($this->out);
                return (($break-$enter)+($out-$end_break))/3600;
            }
            return 0;
        // }
        // if(strtotime($this->out) > strtotime(env('OVER_TIME', '17:00:00'))){
        //     return (strtotime($this->out)-strtotime(env('OVER_TIME', '17:00:00')))/3600;
        // }
        // return 0;
    }

    public function getIsHolidayAttribute()
    {
        $libur = Calendar::where('month', substr($this->created_at, 5, 2))
        ->where('date', substr($this->created_at, 8, 2))
        ->exists();
        return date('l', strtotime($this->created_at)) === 'Sunday' || $libur;
    }

    public function getOverTimeInMoneyAttribute()
    {
        if($this->emp){
            if($this->emp->sr){
                $sr = $this->emp->sr;
                $basic_salary = $sr->basic_salary;
                $mul = 1.5;
                if($this->is_holiday){
                    $mul = 2;
                }
                // return round($basic_salary/22/8*$mul*$this->over_time_in_hours, 2);
                return round($basic_salary/22/8*$mul*$this->over_time_in_hours, env('ROUND', 2));
            }
        }
        return 0;
    }

    public function scopeWorkTotalInMonth($q, $year, $month, $employee)
    {
        return $q->whereMonth('created_at', $month)->whereYear('created_at', $year)->whereEmployee($employee)->get()->sum(function($item){
            if($item['work_total_in_hours'] !== '-'){
                return $item['work_total_in_hours'];
            }
        });
    }

    public function scopeOverTimeTotalInMonth($q, $year, $month, $employee)
    {
        return $q->workTotalInMonth($year, $month, $employee) - 176;
    }

    public function scopeOtRegularInMonth($q, $year, $month, $employee)
    {
        return $q->overTimeTotalInMonth($year, $month, $employee) - $q->overTimeHolidayInMonth($year, $month, $employee)['in_reg'];
    }

    public function scopeOtRegular($q, $year, $month, $employee)
    {
        $work_total = $q->workTotalInMonth($year, $month, $employee);
        if($work_total <= 176){
            return '-';
        }
        $ot_hol = $q->overTimeHolidayInMonth($year, $month, $employee)['in_reg'];
        return convertHour($q->workTotalInMonth($year, $month, $employee) - 176 - $ot_hol);
    }

    public function scopeOtHoliday($q, $year, $month, $employee)
    {
        return $q->overTimeHolidayInMonth($year, $month, $employee)['in_hours'];
    }

    public function scopeOverTimeHolidayInMonth($q, $year, $month, $employee)
    {
        $attendances    = $q->inMonth($employee, $year, $month);
        // $ot_money       = 0;
        $ot_hours       = 0;
        // return $attendances;
        foreach ($attendances as $a) {
            if($a['is_holiday']){
                // $ot_money += $a['over_time_in_money'];
                $ot_hours += $a['over_time_in_hours'];
            }
        }
        return [
            // 'in_money'      => $ot_money,
            'in_hours'      => convertHour($ot_hours),
            'in_reg'        => $ot_hours,
        ];
    }

    public function scopeOverTimeRegularInMonth($q, $year, $month, $employee)
    {
        $work_total = $q->workTotalInMonth($year, $month, $employee)['in_reg'];
        if($work_total <= 0){
            return [
            // 'in_money'      => 0,
            'in_hours'      => '-',
            'in_reg'        => 0,
        ];
        }
        $ot_hol = $q->overTimeHolidayInMonth($year, $month, $employee)['in_reg'];
        $otr = $work_total - 176 - $ot_hol;
        return [
            // 'in_money'      => 0,
            'in_hours'      => convertHour($otr),
            'in_reg'        => $otr,
        ];
    }

    public function scopeInMonth($q, $employee, $year, $month)
    {
        $att = $q->with(['emp' => function($q){
            $q->with(['sr'=>function($k){
                $k->where('status', '1');
            }]);
        }])->where('employee', $employee)
        ->whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->orderBy('created_at')
        ->get();
        $total = count($att);
        $total_in_week = [];
        $sum = 0;
        $sum_over_time = 0;
        foreach ($att as $key => $a) {
            if($a->day == 'Saturday' || ($total - $key < 7 && $key == $total-1)){
                if($a->work_total_in_hours != '-'){
                    $sum+=$a->work_total_in_hours;
                }
                if($a->over_time_in_hours != '-'){
                    $sum_over_time+=$a->over_time_in_hours;
                }
                $total_in_week [] = [
                    'total_in_week'             => convertHour($sum),
                    'over_time_total_in_week'   => convertHour($sum_over_time),
                    'date'                      => $a->created_at,
                ];
                $sum = 0;
                $sum_over_time = 0;
            }else{
                if($a->work_total != '-'){
                    $sum+=$a->work_total_in_hours;
                }
                if($a->over_time_in_hours != '-'){
                    $sum_over_time+=$a->over_time_in_hours;
                }
            }
        }
        $att = $att->transform(function($item) use ($total_in_week){
            $ada = false;
            foreach ($total_in_week as $week) {
                if($item->created_at == $week['date']){
                    $item->over_time_in_week = $week['over_time_total_in_week'];
                    $item->work_total_in_week = $week['total_in_week'];
                    $ada = true;
                    break;
                }
            }
            if(!$ada){
                $item->over_time_in_week = 0;
                $item->work_total_in_week = 0;
            }
            return $item;
        })->values();
        $att_baru = [];
        foreach (range(1, cal_days_in_month(CAL_GREGORIAN, $month, $year)) as $i) {
            $ada = false;
            foreach ($att as $a) {
                if(substr($a->created_at, 8, 2) == $i){
                    $att_baru[] = $a;
                    $ada = true;
                    break;
                }
            }
            if($i < 10){
                $i = '0'.$i;
            }
            $bulan = '';
            if($month < 10){
                $bulan = '0'.$month;
            }
            $tgl = $year.'-'.$bulan.'-'.$i;
            if(!$ada){
                $libur = Calendar::where('month', substr($tgl, 5, 2))
                ->where('date', substr($tgl, 8, 2))
                ->exists() || date('l', strtotime($tgl)) === 'Sunday';
                $att_baru[] = [
                    "id"                        => str_random(12),
                    "employee"                  => null,
                    "created_at"                => $tgl,
                    "enter"                     => null,
                    "break"                     => null,
                    "end_break"                 => null,
                    "out"                       => null,
                    "status"                    => null,
                    "over_time_in_week"         => null,
                    "work_total_in_week"        => null,
                    "stat"                      => null,
                    "work_total"                => null,
                    "over_time"                 => null,
                    "work_total_in_hours"       => null,
                    "is_holiday"                => $libur,
                    "over_time_in_hours"        => null,
                    "over_time_in_money"        => null,
                    "day"                       => date('l', strtotime($tgl)),
                    "emp"                       => null,
                ];
            }
        }
        return $att_baru;
    }

    public function getDayAttribute($q)
    {
        $hari = date('l', strtotime($this->created_at));
        return $hari;
    }

    public function scopeTotalHariKerja($q, $year, $month, $employee)
    {
        return $q->where('employee', $employee)
        ->whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->where('status', 'Present')
        ->count();
    }

    public function scopeAbsent($q, $year, $month, $employee)
    {
        return $q->where('employee', $employee)
        ->whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->where('status', 'Absent')
        ->count();
    }

}
