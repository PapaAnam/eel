<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{

	protected $table = 'hris_positions';
    public $timestamps = false;
    protected $fillable = ['name'];
    // protected $hidden = ['id'];
}
