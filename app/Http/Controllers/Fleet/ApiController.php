<?php

namespace App\Http\Controllers\Fleet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fleet\Collector;

class ApiController extends Controller
{
    public function drivers()
    {
    	return Collector::where('Grup', 'SUPIR')->get()->pluck('Nama', 'Kode');
    }

    public function allDrivers()
    {
    	// return [];
    	return Collector::all();
    }
}
