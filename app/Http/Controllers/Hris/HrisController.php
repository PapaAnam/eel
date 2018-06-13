<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HrisController extends Controller
{
    public function index()
    {
    	// return 'eek';
    	return view('App.hris');
    }
}
