<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	protected $table = 'hris_users';
	public $timestamps = false;
	protected $fillable = ['username', 'password', 'level', 'api_token', 'remember_token', 'avatar', 'employee'];
	protected $hidden = ['avatar', 'remember_token', 'api_token', 'password'];
	protected $appends = ['level_name'];

	public static function data($id=null)
	{
		$data = parent::join('hris_user_menus', 'hris_user_menus.user', '=', 'hris_users.id')
		->join('hris_employees', 'hris_employees.id', '=', 'hris_users.employee')
		->join('hris_positions', 'hris_employees.position', '=', 'hris_positions.id')
		->join('hris_sub_departments', 'hris_sub_departments.id', '=', 'hris_employees.department')
		->join('hris_departments', 'hris_departments.id', '=', 'hris_sub_departments.department')
		->selectRaw('hris_employees.department, hris_positions.name as p_name, hris_departments.name as d_name, hris_sub_departments.name as sd_name, hris_employees.name as e_name, hris_users.*, hris_users.id as u_id, hris_user_menus.*, hris_employees.nin');
		if($id!=null)
			return $data->where('hris_users.id', $id)->first();
		return $data->where('hris_users.id', '!=', 1)->get();
	}

	public function emp()
	{
		return $this->belongsTo('App\Models\Hris\Employee', 'employee');
	}

	public function getLevelNameAttribute($value)
	{
		$value = $this->level;
		switch($value){
			case 2 : return 'Admin'; break;
			case 3 : return 'Supervisor'; break;
			case 4 : return 'Manager'; break;
		}
	}

	public function auth()
	{
		return $this->hasOne('App\Models\Hris\Authority', 'user');
	}
}
