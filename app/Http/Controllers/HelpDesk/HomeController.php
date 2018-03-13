<?php

namespace App\Http\Controllers\HelpDesk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
    	return view('modules.help-desk.app');
    }
}
