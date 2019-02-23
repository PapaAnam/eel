<?php

namespace App\Http\Controllers\Hris\AlwaysPresence;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hris\AlwaysPresence\Location;

class LocationController extends Controller
{
    
	public function index()
	{
		return Location::all();
	}

	public function save(Request $request)
	{
		return $request->all();
	}

}
