<?php

namespace App\Http\Controllers\Fleet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fleet\Sales;
use DB;

class SalesController extends Controller
{
    public function api()
    {
    	return Sales::all();
    }
}
