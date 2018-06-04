<?php

namespace App\Models\Hris\Attendances\Zt1300;

use Illuminate\Database\Eloquent\Model;

class StaffInfo extends Model
{
	protected $connection = 'zt1300';
    public $timestamps = false;
	protected $table = 'hr_staff_info';
}
