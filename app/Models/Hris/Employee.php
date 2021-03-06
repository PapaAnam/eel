<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Hris\SubDepartment;
use App\Models\Hris\Department;
use App\Models\Hris\Position;
use App\Models\Hris\LeavePeriod\Status;
use App\Models\Hris\LeavePeriod\Rule;
use DB;
// use App\Models\Hris\Leave

class Employee extends Model
{
	use SoftDeletes;
	protected $table = 'hris_employees';
	protected $dates = ['deleted_at'];
	public $timestamps = false;
	protected $fillable = ['name', 'nin', 'gender', 'born_in', 'birthdate', 'position', 'login', 'father', 'mother', 'husband', 'wife', 'son', 'daughter', 'elementary', 'el_year', 'junior', 'jun_year', 'senior', 'sen_year', 'university', 'u_year', 'elektoral', 'cartao_rdtl', 'certidao_baptismo', 'elektoral_path', 'cartao_rdtl_path', 'certidao_baptismo_path', 'type', 'e_from', 'department', 'photo', 'marital_status', 'present_address', 'handphone', 'joining_date', 'non_active', 'non_active_at', 'bri_account', 'salary_rule', 'department_id', 'seguranca_social'];
	protected $hidden = ['salary_rule', 'login', 'deleted_at'];
	protected $appends = [
		'bd', 
		'e_type', 
		'marry', 
		'join_date',  
		'non_act', 
		'non_act_date',
		'length_of_work',
		'length_of_work_in_month',
		'is_local'
	];

	// APPENDED ATTRIBUTE

	public function getIsLocalAttribute()
	{
		return $this->e_from == 'Local' ? 'true' : 'false';
	}

	public static function permanent_employee_count()
	{
		return parent::where('type', 2)->count();
	}

	public static function active_female_employee_count()
	{
		return parent::where(['type'=> 2, 'gender'=>'Female'])->count();
	}

	public static function active_male_employee_count()
	{
		return parent::where(['type'=> 2,'gender'=>'Male'])->count();
	}

	public static function active_employee_count()
	{
		return parent::where('type', 2)->count();
	}

	public static function accounting_employee_count()
	{
		return parent::where('department', 29)->count();
	}

	public static function unilever_employee_count()
	{
		return parent::where('department', 11)->count();
	}

	public static function employees()
	{
		$E = parent::orderBy('nin', 'asc')->get();
		$em = [];
		foreach ($E as $e) {
			$em = array_add($em, $e->id, '('.$e->nin.') '.$e->name);
		}
		return $em;
	}

	public static function get_by_department($sub_dept)
	{
		return parent::where('department', $sub_dept)->get();
	}

	public function dep()
	{
		return $this->belongsTo('App\Models\Hris\Department', 'department_id');
	}

	public function departmentdetail()
	{
		return $this->belongsTo('App\Models\Hris\Department', 'department_id');
	}

	public function pos()
	{
		return $this->belongsTo('App\Models\Hris\Position', 'position');
	}

	public function job()
	{
		return $this->belongsTo('App\Models\Hris\Position', 'position');
	}

	public function salaryrule()
	{
		return $this->hasMany('App\Models\Hris\SalaryRule','employee');
	}

	public function getBdAttribute()
	{
		return english_date($this->birthdate);
	}

	public function getMarryAttribute()
	{
		return maried($this->marital_status);
	}

	public function getETypeAttribute()
	{
		return employee_type($this->type);
	}

	public function getJoinDateAttribute()
	{
		return english_date($this->joining_date);
	}

	public function getNonActAttribute()
	{
		return non_active($this->non_active);
	}

	public function getNonActDateAttribute()
	{
		return $this->non_active_at != '0000-00-00' ? english_date($this->non_active_at) : '';
	}

	public function ruleOfSalaries()
	{
		return $this->hasMany("App\Models\Hris\SalaryRule", 'employee');
	}

	public function ruleOfSalary()
	{
		return $this->hasOne("App\Models\Hris\SalaryRule", 'employee');
	}

	public function sr()
	{
		return $this->hasOne('App\Models\Hris\SalaryRule', 'employee');
	}

	public function scopeExcel()
	{
		$data = [];
		foreach ($this->data() as $d) {
			$data[]                        = [
				'NIN'                       => $d->nin,
				'Name'                      => $d->name,
				'Gender'                    => $d->gender,
				'Born In'                   => $d->born_in,
				'Birthdate'                 => english_date($d->birthdate),
				'Father'                    => $d->father,
				'Mother'                    => $d->mother,
				'Wife'                      => $d->wife,
				'Husband'                   => $d->husband,
				'Son'                       => $d->son,
				'Daughter'                  => $d->daughter,
				'Elementary School'         => $d->elementary,
				'Graduation Year'           => $d->el_year,
				'Junior High School'        => $d->junior,
				'Graduation Year'           => $d->jun_year,
				'Senior High School'        => $d->senior,
				'Graduation Year'           => $d->sen_year,
				'University'                => $d->university,
				'Graduation Year'           => $d->u_year,
				'Type'                      => employee_type($d->type),
				'From'                      => $d->e_from,
				'Marital Status'            => maried($d->marital_status),
				'Present Address'           => $d->present_address,
				'Handphone'                 => $d->handphone,
				'Joining Date'              => english_date($d->joining_date),
				'BRI Account'               => $d->bri_account,
				'Department' => $d->dep->name,
				'Position'                  => $d->p_name,
			];
		}
		return $data;
	}

	public function scopeData($q, $id = null)
	{
		if($id){
			return $q->with(['dep', 'pos'])->where('id', $id)->first();
		}
		return $q->with(['dep', 'pos'])->where('non_active', null)->get();
	}

	public function scopeActive($q)
	{
		return $q->whereNull('non_active_at')->get();
	}

	public function scopeNonActive($q)
	{
		return $q->with('dep', 'pos')->whereNotNull('non_active_at')->get();
	}

	public function scopeSelectMode()
	{
		return DB::table('hris_employees')->whereNull('non_active')->select('id','name','nin')->get();
	}

	public function getLengthOfWorkAttribute()
	{
		return dateDifference($this->joining_date, date('Y-m-d'));
	}

	public function getLengthOfWorkInMonthAttribute()
	{
		return selisihDalamBulan(date('Y-m-d'), $this->joining_date);
	}

	public function scopeLeftLeaveByStatus($q, $employee_id, $status_id, $year)
	{
		$status 	= Status::find($status_id);
		$employee 	= $q->where('id', $employee_id)->first();
		$is_local 	= $employee->e_from == 'Local' ? 'true' : 'false';
		$rule 		= Rule::where('rule_year', $year)
		->where('status_id', $status_id)
		->where('is_local', $is_local)
		->first();
		if(is_null($rule)){
			return 0;
		}
		$max 		= $rule->qty_max;
		if($status->joining_date == 'true'){
			if($employee->length_of_work_in_month < $max){
				$max = $employee->length_of_work_in_month;
			}
		}
		if($status->only_female == 'true'){
			if($employee->gender != 'Female'){
				return 0;
			}
		}
		if($status->only_maried == 'true'){
			if($employee->marital_status != 1){
				return 0;
			}
		}
		$used 		= (int) LeavePeriod::where('employee_id', $employee_id)
		->whereYear('start_date', $year)
		->where('status_id', $status_id)
		->sum('day_total');
		return $max - $used;
	}

	public function scopeMaxLeaveByStatus($q, $employee_id, $status_id, $year)
	{
		$status 	= Status::find($status_id);
		$employee 	= $q->where('id', $employee_id)->first();
		$is_local 	= $employee->e_from == 'Local' ? 'true' : 'false';
		$rule 		= Rule::where('rule_year', $year)
		->where('status_id', $status_id)
		->where('is_local', $is_local)
		->first();
		if(is_null($rule)){
			return 0;
		}
		$max 		= $rule->qty_max;
		if($status->joining_date == 'true'){
			if($employee->length_of_work_in_month < $max){
				$max = $employee->length_of_work_in_month;
			}
		}
		if($status->only_female == 'true'){
			if($employee->gender != 'Female'){
				return 0;
			}
		}
		if($status->only_male == 'true'){
			if($employee->gender != 'Male'){
				return 0;
			}
		}
		if($status->only_maried == 'true'){
			if($employee->marital_status != 1){
				return 0;
			}
		}
		return $max;
	}

}
