<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hris\Employee;
class SalaryRule extends Model
{
	protected $table = 'hris_salary_rules';
	protected $appends = ['month_name', 'year'];
	protected $guarded = ['month_name', 'year'];

	public function emp()
	{
		return $this->belongsTo('App\Models\Hris\Employee', 'employee');
	}

	public function scopeExport()
	{
		return Employee::with(['dep', 'pos', 'sr'=>function($q){
			$q->where('status', '!=', '0');
		}])->where('non_active', null)->get();
	}

	public function scopeExcel($q, $type = 'all')
	{
		$data = [];
		$i = 1;
		$MM = [];
		if(is_null($type)){
			$type = 'all';
		}
		if($type == 'all')
			$MM = $this->export();
		else
			$MM = Employee::with(['dep', 'pos', 'sr'=>function($q) use ($type){
				$q->where('status', '!=', '0')->where('out_at_rule', $type);
			}])->where('non_active', null)->get();
		foreach ($MM as $d) {
			$a = [
				'#' 						=> $i++,
				'NIN'						=> $d->nin,
				'Employee'                  => $d->name,
				'Department' 				=> $d->dep->name,
				'Job Title'					=> $d->pos->name,
				''							=> '',
				'Basic Salary'              => $d->sr ? $d->sr->basic_salary : 'Not Set Yet',
				'Allowance'                 => $d->sr ? $d->sr->allowance : 'Not Set Yet',
				'Incentive'                 => $d->sr ? $d->sr->incentive : 'Not Set Yet',
				'Food Allowance'            => $d->sr ? $d->sr->eat_cost : 'Not Set Yet',
				'Rent Motorcycle'           => $d->sr ? $d->sr->rent_motorcycle : 'Not Set Yet',
				'Cash Withdrawal'           => $d->sr ? $d->sr->cash_receipt : 'Not Set Yet',
				'Retention'           		=> $d->sr ? $d->sr->ritation : 'Not Set Yet',
				'Salary Type'				=> $d->sr ? $d->sr->salary_type : 'Not Set Yet',
				// 'Active' => $d->sr ? (($d->sr->status == 0) ? 'N' : 'Y') : 'Not Set Yet',
				'Last Updated' => $d->sr ? $d->sr->created_at : 'Not Set Yet'
			];
			if(!config('app.seguranca')){
				$a['Seguranca'] = $d->sr ? $d->sr->seguranca : 'Not Set Yet';
			}
			$data[] = $a;
		}
		return $data;
	}

	public function getMonthNameAttribute()
	{
		return english_month_name(substr($this->created_at, 5, 2));
	}

	public function getYearAttribute()
	{
		return substr($this->created_at, 0, 4);
	}
}
