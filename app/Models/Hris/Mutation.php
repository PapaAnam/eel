<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
class Mutation extends Model
{
	protected $table = 'hris_mutations';
	public $timestamps = false;
	protected $fillable = ['employee', 'old_position', 'new_position', 'reason', 'created_at', 'old_department', 'new_department', 'effect_on', 'manager', 'mutation_id', 'city'];

	public function scopeInMonth($q, $year, $month)
    {
        return $q->with(['emp', 'njb', 'ojb', 'ndep', 'odep', 'man'])->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->latest()
        ->get();
    }

    public function scopeSingle($q, $id)
    {
        return $q->with(['emp', 'njb', 'ojb', 'ndep', 'odep', 'man'])->first();
    }

    public function emp()
    {
        return $this->belongsTo('App\Models\Hris\Employee', 'employee');
    }

    public function man()
    {
        return $this->belongsTo('App\Models\Hris\Employee', 'manager');
    }

    public function njb()
    {
        return $this->belongsTo('App\Models\Hris\Position', 'new_position');
    }

    public function ojb()
    {
        return $this->belongsTo('App\Models\Hris\Position', 'old_position');
    }

    public function ndep()
    {
        return $this->belongsTo('App\Models\Hris\Department', 'new_department');
    }

    public function odep()
    {
        return $this->belongsTo('App\Models\Hris\Department', 'old_department');
    }
}
