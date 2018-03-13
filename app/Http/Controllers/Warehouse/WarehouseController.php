<?php

namespace App\Http\Controllers\Warehouse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WarehouseController extends Controller
{

	public function index()
	{
		return view('warehouse.index');
	}

}
