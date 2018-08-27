<?php

use Illuminate\Database\Seeder;
use App\Models\Hris\SalaryRule;

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
        	$data = $temp + $s->only('basic_salary', 'allowance', 'status', 'salary_type','employee','salary_group_id');
        	SalaryRule::find($s->id)->update(['status'=>0]);
        	SalaryRule::create($data);
        }
        echo 'Salary rule reset success';
    }
}
