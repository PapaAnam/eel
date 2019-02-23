<?php

namespace App\Models\Hris\AlwaysPresence;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

	protected $table = 'location';

	protected $fillable = [
		'name',
		'latitude',
		'longitude',
		'north',
		'east',
		'south',
		'west',
	];

}
