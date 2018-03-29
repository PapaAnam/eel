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
    	$round 		= env('ROUND', 2);
    	foreach ($employees as $e) {
    		$data[] = [
    			'employee'			=> $e,
    			'created_at'		=> (String) now(),
    			'basic_salary'		=> round($faker->numberBetween(2000000, 6000000), $round) / 10000,
    			'allowance'			=> round($faker->numberBetween(2000000, 6000000), $round) / 10000,
    			'incentive'			=> round($faker->numberBetween(2000000, 6000000), $round) / 10000,
    			'eat_cost'			=> round($faker->numberBetween(100000, 6000000), $round) / 10000,
    			'ritation'			=> round($faker->numberBetween(2000000, 6000000), $round) / 10000,
    			'etc'				=> round($faker->numberBetween(100000, 6000000), $round) / 10000,
    			'seguranca_social'	=> round($faker->numberBetween(100000, 1000000), $round) / 10000,
    			'cash_receipt'		=> round($faker->numberBetween(100000, 3000000), $round) / 10000,
    			'status'			=> '1',
    			'created_at'		=> (String) now(),
    			'updated_at'		=> (String) now(),
    		];
    	}
    	DB::table('hris_salary_rules')->insert($data);
    }
}
