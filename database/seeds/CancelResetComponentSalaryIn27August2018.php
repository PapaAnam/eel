<?php

use Illuminate\Database\Seeder;
use App\Models\Hris\SalaryRule;

class CancelResetComponentSalaryIn27August2018 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SalaryRule::where('created_at', '>=', '2018-08-27')->delete();
        $sr = SalaryRule::latest()->groupBy('employee')->get();
        SalaryRule::where('id', '>=', 1)->update([
        	'status'=>'0'
        ]);
        foreach ($sr as $s) {
        	SalaryRule::find($s->id)->update([
        		'status'=>'1'
        	]);
        }
        echo 'Salary rule reset success';
    }
}
