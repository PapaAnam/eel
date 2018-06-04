<?php

namespace App\Models\Hris\Attendances\Zt1300;

use Illuminate\Database\Eloquent\Model;

class TaLog extends Model
{
    protected $connection = 'zt1300';
	public $timestamps = false;
	protected $table = 'ta_log';

	public function staff()
	{
		return $this->belongsTo('App\Models\Hris\Attendances\Zt1300\StaffInfo', 'Fid', 'FID');
	}

}
