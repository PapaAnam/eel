<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hris\Employee;
class SalaryRule extends Model
{
	protected $table = 'hris_salary_rules';
	protected $guarded = [];

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

	public function scopeExcel()
	{
		$data = [];
		$i = 1;
		foreach ($this->export() as $d) {
			$data[] = [
				'#' 						=> $i++,
				'Employee'                  => '('.$d->nin.') '.$d->name,
				'Dept/Pos' 					=> $d->dep->name.'/'.$d->pos->name,
				'Basic Salary'              => $d->sr ? $d->sr->basic_salary : 'Not Set Yet',
				'Allowance'                 => $d->sr ? $d->sr->allowance : 'Not Set Yet',
				'Seguranca'                 => $d->sr ? $d->sr->seguranca : 'Not Set Yet',
				'Incentive'                 => $d->sr ? $d->sr->incentive : 'Not Set Yet',
				'Eat Cost'                  => $d->sr ? $d->sr->eat_cost : 'Not Set Yet',
				'Rent Motorcycle'           => $d->sr ? $d->sr->rent_motorcycle : 'Not Set Yet',
				'Active' => $d->sr ? (($d->sr->status == 0) ? 'N' : 'Y') : 'Not Set Yet',
				'Last Updated' => $d->sr ? $d->sr->created_at : 'Not Set Yet'
			];
		}
		return $data;
	}
}
