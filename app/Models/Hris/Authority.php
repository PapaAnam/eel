<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Authority extends Model
{
	protected $table = 'hris_user_menus';
	public $timestamps = false;
	protected $guarded = [];

	public static function allowed($module)
	{
		return parent::where('user', Auth::id())->first()->$module==1;
	}
}