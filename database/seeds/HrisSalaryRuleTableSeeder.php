<?php

use Illuminate\Database\Seeder;

class HrisSalaryRuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    	DB::table('hris_salary_rules')->truncate();
    	$employees 	= DB::table('hris_employees')->get()->pluck('id');
    	$faker 		= \Faker\Factory::create('id_ID');
    	$data 		= [];
    	foreach ($employees as $e) {
    		$data[] = [
    			'employee'		=> $e,
    			'created_at'	=> (String) now(),
    			'basic_salary'	=> round($faker->numberBetween(2000000, 6000000), -4),
    			'allowance'		=> round($faker->numberBetween(2000000, 6000000), -4),
    			'incentive'		=> round($faker->numberBetween(2000000, 6000000), -4),
    			'eat_cost'		=> round($faker->numberBetween(100000, 6000000), -4),
    			'ritation'		=> round($faker->numberBetween(2000000, 6000000), -4),
    			'status'		=> '1',
    			'created_at'	=> (String) now(),
    			'updated_at'	=> (String) now(),
    		];
    	}
    	DB::table('hris_salary_rules')->insert($data);
    }
}
