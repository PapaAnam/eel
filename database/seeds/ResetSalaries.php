<?php

use Illuminate\Database\Seeder;

class ResetSalaries extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('set foreign_key_checks=0;');
        DB::table('hris_salaries')->truncate();
        echo 'Salaries table truncated';
    }
}
