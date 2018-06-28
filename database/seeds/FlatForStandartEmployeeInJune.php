<?php

use Illuminate\Database\Seeder;

class FlatForStandartEmployeeInJune extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$att = DB::table('hris_attendances')->whereMonth('created_at', 6)->whereYear('created_at', 2018)->get();
    	foreach ($att as $a) {
    		$sr = DB::table('hris_salary_rules')->where('employee', $a->employee)->where('status', '1')->first();
    		if(strtotime($a->created_at.' '.$a->out) <= strtotime($a->created_at.' 17:25:00') && $sr->salary_type == 'standart' && !is_null($a->enter)){
    			DB::table('hris_attendances')->where('id', $a->id)->update([
    				'out'    => '17:00:00',
    			]);
    		}else if(is_null($a->status) || $a->status == ''){
    			DB::table('hris_attendances')->where('id', $a->id)->update([
    				'out'    	=> null,
    				'enter'		=> null,
    				'break'		=> null,
    				'end_break'	=> null,
    			]);
    		}
    	}
    	echo "flat success";
    }
}
