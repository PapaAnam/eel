<?php

use Illuminate\Database\Seeder;
use App\Models\Hris\Employee;
use App\Models\Hris\SalaryRule;

class MoveSalaryGroupFromEmployeeToSalaryRule extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = Employee::active();
        foreach ($employees as $e) {
			SalaryRule::where('employee',$e->id)->update([
				'salary_group_id'=>$e->salary_group
			]);
        }
        echo 'Move salary group from employee to salary rule success';
    }
}
