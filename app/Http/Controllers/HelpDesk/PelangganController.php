<?php

namespace App\Http\Controllers\HelpDesk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HelpDesk\Pelanggan;

class PelangganController extends Controller
{
    public function index()
    {
    	$oper = [
    		'pelanggan' => Pelanggan::paginate(100)
    	];
    	return view('modules.help-desk.pelanggan.index', $oper);
    }

    public function data($k = null)
    {
    	if($k != null)
    		return Pelanggan::where('NickNameOwner', 'like', '%'.$k.'%')->orWhere('Perusahaan', 'like', '%'.$k.'%')->paginate(50);
    	return Pelanggan::paginate(50);
    }
}
