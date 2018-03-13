<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mhs extends Model
{
    protected $connection = 'access';
    protected $table  = 'AttParam';
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;

}
