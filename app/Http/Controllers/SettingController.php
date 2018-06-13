<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{

	public function animationIcon(Request $r)
	{
		$status = config('app.animation_icon', false);
		if($status){
			return 1;
		}
		return 0;
	}

}
