<?php

use Illuminate\Database\Seeder;

class ResetAttendance extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hris_attendances')->whereNotNull('enter')->orWhereNotNull('out')->update([
        	'status'	=> 'Present'
        ]);
        DB::table('hris_attendances')->whereNull('enter')->orWhereNull('out')->delete();
    }
}
