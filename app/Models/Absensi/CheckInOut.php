<?php

namespace App\Models\Absensi;

use Illuminate\Database\Eloquent\Model;

class CheckInOut extends Model
{
    protected $table = 'dbo.CHECKINOUT';
    protected $connection = 'absensi';

    public function UserInfo()
    {
    	return $this->belongsTo('App\Models\Absensi\UserInfo', 'USERID', 'USERID');
    }
}
