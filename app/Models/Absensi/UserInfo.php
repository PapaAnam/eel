<?php

namespace App\Models\Absensi;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'dbo.USERINFO';
    protected $connection = 'absensi';

    public function CheckInOut()
    {
    	return $this->hasMany('App\Models\Absensi\CheckInOut');
    }
}
