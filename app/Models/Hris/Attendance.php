<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hris\Calendar;

class Attendance extends Model
{
	protected $table = 'hris_attendances';
	public $timestamps = false;
	protected $fillable = ['employee', 'created_at', 'enter', 'break', 'end_break', 'out', 'status'];
    protected $appends = ['stat', 'work_total', 'over_time', 'work_total_in_hours', 'is_holiday', 'over_time_in_hours', 'over_time_in_money'];

    public static function data($id)
    {
        $data = parent::join('hris_employees', 'hris_employees.id', '=', 'hris_attendances.employee')
        ->join('hris_positions', 'hris_employees.position', '=', 'hris_positions.id')
        ->join('hris_sub_departments', 'hris_sub_departments.id', '=', 'hris_employees.department')
        ->selectRaw('hris_positions.name as p_name, hris_sub_departments.name as d_name, hris_employees.name as e_name, hris_attendances.*, hris_employees.nin')
        ->orderBy('enter', 'desc')
        ->latest();
        if($id!=null)
            return $data->where('hris_attendances.id', $id)->first();
        return $data->get();
    }

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
        return $this->convertHour($this->work_total_in_hours);
    }

    public function getWorkTotalInHoursAttribute()
    {
        if($this->break && $this->enter && $this->end_break && $this->out && !$this->is_holiday){
            return round((strtotime($this->break)-strtotime($this->enter))/3600 + (strtotime($this->out)-strtotime($this->end_break))/3600, 2);
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
        return $this->convertHour($this->over_time_in_hours);
    }

    public function getOverTimeInHoursAttribute()
    {
        if($this->status === 'Over Time' || ($this->status === 'Present' && $this->is_holiday)){
            if($this->out && $this->enter){
                return (strtotime($this->out)-strtotime($this->enter))/3600;
            }
            return 0;
        }
        if(strtotime($this->out) > strtotime(env('OVER_TIME', '17:00:00'))){
            return (strtotime($this->out)-strtotime(env('OVER_TIME', '17:00:00')))/3600;
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
                // return round($basic_salary/22/8*$mul*$this->over_time_in_hours, 2);
                return $basic_salary/22/8*$mul*$this->over_time_in_hours;
            }
        }
        return 0;
    }

}
