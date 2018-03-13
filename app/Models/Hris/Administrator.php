<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
	protected $table = 'hris_administrator';
    public $timestamps = false;
    protected $fillable = ['name', 'born_in', 'birthdate', 'login', 'gender', 'address'];
}
