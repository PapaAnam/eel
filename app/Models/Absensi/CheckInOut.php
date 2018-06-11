<?php

namespace App\Models\Absensi;

use Illuminate\Database\Eloquent\Model;

class CheckInOut extends Model
{
    protected $table = 'dbo.CHECKINOUT';
    protected $connection = 'x100c';

    public function UserInfo()
    {
    	return $this->belongsTo('App\Models\Absensi\UserInfo', 'USERID', 'USERID');
    }
}
