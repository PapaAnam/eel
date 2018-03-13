<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
class OfficialTravel extends Model
{
	protected $table = 'hris_official_travels';
	public $timestamps = false;
	protected $fillable = ['employee', 'assignor', 'officer_note', 'assignor_note', 'advanced_cost', 'lodging_cost', 'sppd', 'goal', 'area_1', 'area_2', 'area_3', 'area_4', 'area_5', 'start_date', 'end_date', 'fuel_cost', 'other_cost', 'report_at', 'area_6', 'depart_from', 'eat_cost'];

	public static function data($id=null)
	{
		$data = parent::join('hris_employees', 'hris_employees.id', '=', 'hris_official_travels.employee')
        ->join('hris_positions', 'hris_employees.position', '=', 'hris_positions.id')
        ->join('hris_sub_departments', 'hris_sub_departments.id', '=', 'hris_employees.department')
        ->join('hris_departments', 'hris_departments.id', '=', 'hris_sub_departments.department')
        ->selectRaw('hris_employees.department, hris_positions.name as p_name, hris_sub_departments.name as sd_name, hris_employees.name as e_name, hris_official_travels.*, hris_departments.name as d_name, hris_employees.nin')
        ->orderBy('start_date', 'desc');
        if($id!=null)
            return $data->where('hris_official_travels.id', $id)->first();
        return $data->get();
    }

    public function scopeGetData($q, $id = null)
    {
        $newData = [];
        $data = null;
        if($id){
            $data = $this->with(['emp.dep', 'emp.pos', 'ass.pos', 'ass.dep'])->where('id', $id)->get();
        }else{
            $data = $this->with(['emp.dep', 'emp.pos', 'ass.pos', 'ass.dep'])->get();
        }
        foreach ($data->toArray() as $a) {
            $newData[] = collect([
                'department' => $a['emp']['dep']['name'],
                'position' => $a['emp']['pos']['name'],
                'emp' => $a['emp']['name'],
                'nin' => $a['emp']['nin'],
                'ass' => $a['ass']['name'],
                'assnin' => $a['ass']['nin'],
                'assdep' => $a['ass']['dep']['name'],
                'asspos' => $a['ass']['pos']['name'],
            ]+$a);
        }
        return $id ? $newData[0] : $newData;
    }

    public function emp()
    {
        return $this->belongsTo('App\Models\Hris\Employee', 'employee');
    }

    public function ass()
    {
        return $this->belongsTo('App\Models\Hris\Employee', 'assignor');
    }

    public function scopeExcel()
    {
        $data = [];
        $no = 1;
        foreach ($this->getData() as $d) {
            $data[]                        = [
                '#' => $no++,
                'SPPD Number'               => $d['sppd'],
                'Employee'                  => '('.$d['nin'].') '.$d['emp'],
                'Dept/Pos' => $d['department'].'/'.$d['position'],
                'Assignor' => '('.$d['assnin'].') '.$d['ass'],
                'Date' => substr($d['start_date'], 0, 10).' -> '.substr($d['end_date'], 0, 10)
            ];
        }
        return $data;
    }
}