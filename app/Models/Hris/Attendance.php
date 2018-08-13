<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hris\Calendar;
use App\Models\Hris\Employee;

class Attendance extends Model
{
	protected $table = 'hris_attendances';
	public $timestamps = false;
	protected $fillable = ['employee', 'created_at', 'enter', 'break', 'end_break', 'out', 'status', 'real_enter'];
    protected $appends = ['stat', 'work_total', 'over_time', 'work_total_in_hours', 'is_holiday', 'over_time_in_hours', 'over_time_in_money', 'day', 'is_event_holiday'];

    public function emp()
    {
        return $this->belongsTo('App\Models\Hris\Employee', 'employee');
    }

    public function getStatAttribute()
    {
        $absence_status = ['Present', 'Sick', 'Absent', 'Official Travel', 'Father Leave', 'Annual Leave', 'Special Permit', 'Pregnancy'];
        foreach ($absence_status as $key => $value) {
            if($key == $this->status)
                return $value;
        }
    }

    public function getWorkTotalAttribute()
    {
        if($this->work_total_in_hours === '-')
            return '-';
        return convertHour($this->work_total_in_hours);
    }

    public function getWorkTotalInHoursAttribute()
    {
        if($this->break && $this->enter && $this->end_break && $this->out){
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
        if($this->out && $this->enter){
            $break      = strtotime('12:00:00');
            $end_break  = strtotime('13:00:00');
            $enter      = strtotime($this->enter);
            $out        = strtotime($this->out);
            return (($break-$enter)+($out-$end_break))/3600;
        }
        return 0;
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
        return $q->overTimeRegularInMonth($year, $month, $employee)['in_hours'];
    }

    public function scopeOtHoliday($q, $year, $month, $employee)
    {
        return convertHour($q->overTimeHolidayInMonth($year, $month, $employee)['in_reg']+$q->overTimeEventHolidayInMonth($year, $month, $employee)['in_reg']);
    }

    public function scopeOverTimeHolidayInMonth($q, $year, $month, $employee)
    {
        $attendances    = $q->inMonth($employee, $year, $month);
        $ot_hours       = 0;
        foreach ($attendances as $a) {
            if($a['is_holiday'] && !$a['is_event_holiday']){
                $ot_hours += $a['over_time_in_hours'];
            }
        }
        return [
            'in_hours'      => convertHour($ot_hours),
            'in_reg'        => $ot_hours,
        ];
    }

    public function scopeOverTimeSundayInMonth($q, $year, $month, $employee)
    {
        $attendances    = $q->inMonth($employee, $year, $month);
        $ot_hours       = 0;
        foreach ($attendances as $a) {
            if($a['is_holiday'] && $a['day'] == 'Sunday'){
                $ot_hours += $a['over_time_in_hours'];
            }
        }
        return [
            'in_hours'      => convertHour($ot_hours),
            'in_reg'        => $ot_hours,
        ];
    }

    public function scopeOverTimeEventInMonth($q, $year, $month, $employee)
    {
        $attendances    = $q->inMonth($employee, $year, $month);
        $ot_hours       = $attendances->sum(function($item){
            if($item['is_event_holiday'] && $item['day'] != 'Sunday'){
                return $item['over_time_in_hours'];
            }
        });
        return [
            'in_hours'      => convertHour($ot_hours),
            'in_reg'        => $ot_hours,
        ];
    }

    public function scopeOverTimeEventHolidayInMonth($q, $year, $month, $employee)
    {
        $attendances    = $q->inMonth($employee, $year, $month);
        $ot_hours       = 0;
        foreach ($attendances as $a) {
            if($a['is_event_holiday']){
                $ot_hours += $a['over_time_in_hours'];
            }
        }
        return [
            'in_hours'      => convertHour($ot_hours),
            'in_reg'        => $ot_hours,
        ];
    }

    public function scopeOverTimeRegularInMonth($q, $year, $month, $employee)
    {
        $work_total = Attendance::workTotalInMonth($year, $month, $employee);
        if($work_total <= 0){
            return [
                'in_hours'      => '-',
                'in_reg'        => 0,
            ];
        }
        $ot_hol = $q->overTimeSundayInMonth($year, $month, $employee)['in_reg']+$q->overTimeEventInMonth($year, $month, $employee)['in_reg'];
        $otr = $work_total - 176 - $ot_hol;
        if($otr < 0){
            $otr = 0;
        }
        return [
            'in_hours'      => convertHour($otr),
            'in_reg'        => $otr,
        ];
    }

    public function scopeInMonth($q, $employee, $year, $month)
    {
        $skrg = date('d');
        for ($i = 1; $i <= $skrg; $i++) {
            $date = $i;
            if($date < 10){
                $date = '0'.$i;
            }
            if($month < 10 ){
                $month = '0'.$i;
            }
            $fulldate = $year.'-'.$month.'-'.$date;
            $normalAtt = Attendance::where('employee', $employee)
            ->where('created_at', $fulldate)
            ->first();
            $libur = Calendar::where('month', $month)
            ->where('date', $date)
            ->exists() || date('l', strtotime($fulldate)) === 'Sunday';
            // return $libur ? 1 : 0;
            if(is_null($normalAtt)){
                Attendance::updateOrCreate([
                    'employee'=>$employee,
                    'created_at'=>$year.'-'.$month.'-'.$date,
                ],[
                    'status'=>$libur ? null : 'Absent',
                ]);
            }
        }
        if($employee != 'all'){
            $att = $q->with(['emp' => function($q){
                $q->with(['sr'=>function($k){
                    $k->where('status', '1');
                }]);
            }])->where('employee', $employee)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->orderBy('created_at')
            ->get();
        }else{
            $att = $q->with(['emp' => function($q){
                $q->with(['sr'=>function($k){
                    $k->where('status', '1');
                }]);
            }])
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->orderBy('employee', 'created_at')
            ->get();
        }
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
        return $att;
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

    public function scopeA($q, $date, $emp)
    {
        return $q->where('created_at', $date)->where('employee', $emp)->first();
    }

    public function getIsEventHolidayAttribute(){
        return Calendar::where('month', substr($this->created_at, 5, 2))
        ->where('date', substr($this->created_at, 8, 2))
        ->exists();
    }

    public function scopeByDate($q, $date)
    {
        $employees = Employee::whereNull('non_active_at')->get();
        $data = [];
        foreach ($employees as $e) {
            $att = Attendance::where('created_at', $date)->where('employee', $e->id)->first();
            $libur = Calendar::where('month', substr($date, 5, 2))
            ->where('date', substr($date, 8, 2))
            ->exists() || date('l', strtotime($date)) === 'Sunday';
            $dt = null;
            if(!is_null($att)){
                $dt = $att;
            }else{
                $dt = Attendance::firstOrCreate([
                    'created_at'        => $date,
                    'employee'          => $e->id
                ], [
                    'status'            => 'Absent',
                ]);
            }
            $data[] = $dt;
        }
        return $data;
    }

    public function scopePresentTotalInMonth($q, $e, $y, $m){
        return $q->where('employee', $e)
        ->whereYear('created_at', $y)
        ->whereMonth('created_at', $m)
        ->where('status', 'Present')
        ->count();
    }

}
