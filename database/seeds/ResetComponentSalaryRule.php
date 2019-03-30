<?php

use Illuminate\Database\Seeder;
use App\Models\Hris\SalaryRule;
use App\Models\Hris\Employee;

class ResetComponentSalaryRule extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sr = SalaryRule::where('status', '1')->get();
    	$temp = [
    		'incentive'=>0,
    		'eat_cost'=>0,
    		'ritation'=>0,
    		'cash_receipt'=>0,
    		'seguranca'=>0,
    		'etc'=>0,
    		'rent_motorcycle'=>0,
    	];
        foreach ($sr as $s) {
        	$data = $temp + $s->only('basic_salary', 'allowance', 'status', 'salary_type','employee','salary_group_id','out_at_rule');
        	SalaryRule::find($s->id)->update(['status'=>0]);
        	SalaryRule::create($data);
        }
        foreach(Employee::active() as $e){
            $sr = SalaryRule::where('employee', $e->id)
                ->whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))
                ->where('status', '1')
                ->first();
            if(is_null($sr)){
                $sr = SalaryRule::where('employee', $e->id)
                    ->latest()
                    ->first();
                $data = $sr->only('basic_salary', 'allowance', 'status', 'salary_type','employee','salary_group_id','out_at_rule')+['status'=>'1'];
                SalaryRule::create($data);
            }
        }
        echo 'Salary rule reset success';
    }
}
