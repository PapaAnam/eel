<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

	protected $table = 'hris_log';

	protected $fillable = [
		'user_id',
		'table_name',
		'target_id',
		'action',
		'value',
		'description',
	];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

}
