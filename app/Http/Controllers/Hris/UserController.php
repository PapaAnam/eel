<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class UserController extends Controller
{
	public function active(Request $r)
	{
		$id_user = Auth::guard('api')->user()->id;
		return User::with('auth')->where('id', $id_user)->first();
	}
}
