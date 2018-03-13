<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubDepartment extends Model
{

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'hris_sub_departments';
    public $timestamps = false;
    protected $fillable = ['name', 'department'];
    protected $hidden = ['deleted_at', 'department'];

    public static function get_by_department($dept)
    {
    	return parent::where('department', $dept)->orderBy('name')->get();
    }

    public static function data()
    {
    	return parent::join('hris_departments', 'hris_departments.id', '=', 'hris_sub_departments.department')
        ->where('hris_sub_departments.name', '!=', '-')
        ->selectRaw('hris_sub_departments.*, hris_departments.name as d_name')
        ->orderBy('hris_departments.name');
    }

    public function dep()
    {
        return $this->belongsTo('App\Models\Hris\Department', 'department');
    }

    public function dept()
    {
        return $this->belongsTo('App\Models\Hris\Department', 'department');
    }
}
