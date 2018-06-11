<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{

	public function animationIcon(Request $r)
	{
		if(!config('app.animation_icon', false)){
			return 1;
		}
		return 0;
	}

}
