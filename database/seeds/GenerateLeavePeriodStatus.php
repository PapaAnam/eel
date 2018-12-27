<?php

use Illuminate\Database\Seeder;
use App\Models\Hris\LeavePeriod\Status;

class GenerateLeavePeriodStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [
    		[
    			'status_name' 	=> 'Special Permit',
    			'joining_date'	=> 'true',
    			'only_female'	=> 'false',
    			'only_maried' 	=> 'false',
    		],
    		[
    			'status_name' 	=> 'Holiday',
    			'joining_date'	=> 'true',
    			'only_female'	=> 'false',
    			'only_maried' 	=> 'false',
                'accumulation'  => 'true',
    		],
    		[
    			'status_name' 	=> 'Father Leave',
    			'joining_date'	=> 'true',
    			'only_female'	=> 'false',
    			'only_maried' 	=> 'true',
    		],
    		[
    			'status_name' 	=> 'Sick',
    			'joining_date'	=> 'false',
    			'only_female'	=> 'false',
    			'only_maried' 	=> 'false',
                'attachment'    => 'true',
    		],
    		[
    			'status_name' 	=> 'Pregnancy Leave',
    			'joining_date'	=> 'false',
    			'only_female'	=> 'true',
    			'only_maried' 	=> 'true',
    		],
    	];
    	foreach($data as $d){
    		Status::updateOrCreate([
    			'status_name'	=> $d['status_name'],
    		],collect($d)->except('status_name')->toArray());
    	}
    }
}
