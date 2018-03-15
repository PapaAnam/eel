<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyAppController extends Controller
{
    public function appName()
    {
    	return config('app.name');
    }

    public function hrisName()
    {
    	return config('app.hris_name');
    }
}
