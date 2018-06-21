<?php

use Illuminate\Database\Seeder;
use App\User;

class ResetAdministrator extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
        	'username'	=> 'administrator'
        ], [
        	'password'	=> bcrypt('administrator')
        ]);
    }
}
