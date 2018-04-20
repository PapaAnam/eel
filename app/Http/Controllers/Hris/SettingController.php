<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function seguranca()
    {
    	return config('app.seguranca') ? 1 : 0;
    }
}
