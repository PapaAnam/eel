<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hris\Employee;

class EmployeeNonActiveController extends Controller
{
	
	public function index()
	{
		return Employee::nonActive();
	}

}
