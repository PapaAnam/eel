<?php

namespace App\Http\Controllers\Hris;

use Auth;
use Hash;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
	
	public function login(Request $request)
	{
		$request->validate([
			'username' => 'required',
			'password' => 'required',
		]);
		$user = User::where('username', $request->username)->first();
		if($user){
			if(Hash::check($request->password, $user->password)){
				Auth::login($user, $request->filled('remember_me'));
				$user->update([
					'api_token'=>bcrypt($user->username.date('YmdHis')),
				]);
				return redirect('hris/home');
			}else{
				return redirect()->back()->withInput()->with('error_msg', 'Password is wrong');	
			}
		}else{
			return redirect()->back()->withInput()->with('error_msg', 'Username doesn\'t exist');
		}
	}

}
