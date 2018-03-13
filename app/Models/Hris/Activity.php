<?php

namespace App\Models\Hris;
use Auth;

use Illuminate\Database\Eloquent\Model;
class Activity extends Model
{
	protected $table = 'hris_system_activities';
	public $timestamps = false;
	protected $fillable = ['created_at', 'event', 'user'];

	public function scopeCr($q, $event)
	{
		$q->create([
			'user'      => Auth::id(),
			'event'     => $event
		]);
	}
}
