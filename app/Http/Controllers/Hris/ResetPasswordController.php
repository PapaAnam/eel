<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ResetPasswordController extends Controller
{
    public function __invoke()
    {
    	User::updateOrCreate([
    		'username'	=> 'administrator'
    	], [
    		'password'	=> bcrypt('administrator')
    	]);
    }
}
