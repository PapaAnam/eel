<?php

namespace App\Models\Warehouse;

use Illuminate\Foundation\Auth\User as Authenticatable;

class WarehouseUser extends Authenticatable
{
	// protected $table   = 'warehouse_users';
	public $timestamps = false;
	protected $guarded = [];
	protected $hidden  = ['avatar', 'remember_token', 'api_token'];
}
