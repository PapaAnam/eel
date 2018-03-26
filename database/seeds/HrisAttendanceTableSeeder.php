<?php

use Illuminate\Database\Seeder;

class HrisAttendanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [];
		$employees = DB::table('hris_employees')->get()->pluck('id');
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    	DB::table('hris_attendances')->truncate();
    	foreach (range(0,30) as $i) {
    		$data 		= [];
    		$interval 	= strtotime('+'.$i.' days');
    		$is_sunday 	= date('l', $interval) == 'Sunday';
    		foreach ($employees as $e) {
    			$data[] = [
    				'employee'		=> $e,
    				'created_at'	=> date('Y-m-d', $interval),
    				'enter'			=> $is_sunday ? null : env('ATT_ENTER_DUMMY', '08:30:00'),
    				'break'			=> $is_sunday ? null : env('ATT_BREAK_DUMMY', '12:00:00'),
    				'end_break'		=> $is_sunday ? null : env('ATT_END_BREAK_DUMMY', '13:00:00'),
    				'out'			=> $is_sunday ? null : array_random(range(17,22)).':'.array_random(range(0,59)).':'.array_random(range(0,59)),
    				'status'		=> $is_sunday ? null : 'Present',
    			];
    		}
	        DB::table('hris_attendances')->insert($data);
    	}
    	foreach (range(1,30) as $i) {
    		$data 		= [];
    		$interval 	= strtotime('-'.$i.' days');
    		$is_sunday 	= date('l', $interval) == 'Sunday';
    		foreach ($employees as $e) {
    			$data[] = [
    				'employee'      => $e,
                    'created_at'    => date('Y-m-d', $interval),
                    'enter'         => $is_sunday ? null : env('ATT_ENTER_DUMMY', '08:30:00'),
                    'break'         => $is_sunday ? null : env('ATT_BREAK_DUMMY', '12:00:00'),
                    'end_break'     => $is_sunday ? null : env('ATT_END_BREAK_DUMMY', '13:00:00'),
                    'out'           => $is_sunday ? null : array_random(range(17,22)).':'.array_random(range(0,59)).':'.array_random(range(0,59)),
                    'status'        => $is_sunday ? null : 'Present',
    			];
    		}
	        DB::table('hris_attendances')->insert($data);
    	}
    }
}
