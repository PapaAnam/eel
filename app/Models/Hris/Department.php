<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{

	use SoftDeletes;
    protected $table = 'hris_departments';
    protected $dates = ['deleted_at'];

    public $timestamps = false;
    protected $fillable = ['name', 'dibawahi', 'deleted_at'];
    protected $hidden = ['deleted_at'];

    public static function departments()
    {
    	$departments = parent::all();
    	$dept = [];
    	foreach ($departments as $d) {
    		$dept = array_add($dept, $d->id, $d->name);
    	}
    	return $dept;
    }

    public function depts()
    {
        return $this->hasMany('App\Models\Hris\Department', 'dibawahi');
    }

    public function scopeData($q)
    {
        return $q->with('depts.depts.depts.depts.depts.depts.depts.depts.depts.depts.depts.depts.depts.depts.depts.depts.depts.depts.depts.depts.depts.depts.depts')->where('dibawahi', '0')->get();
    }

    public function dibawahi_oleh()
    {
        return $this->belongsTo('App\Models\Hris\Department', 'dibawahi');
    }

    public function scopeExcel($q)
    {
        $data = [];
        $i = 1;
        foreach ($q->with('dibawahi_oleh')->get() as $d) {
            $data[] = [
                '#' => $i++,
                'Name' => $d->name,
                'Primary Department' => count($d->dibawahi_oleh) ? $d->dibawahi_oleh->name : '-'
            ];
        }
        return $data;
    }
}