<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
class Attendance extends Model
{
	protected $table = 'hris_attendances';
	public $timestamps = false;
	protected $fillable = ['employee', 'created_at', 'enter', 'break', 'end_break', 'out', 'status'];
    protected $appends = ['stat'];

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

}
