<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
class Salary extends Model
{
	protected $table = 'hris_salaries';
	public $timestamps = false;
	protected $fillable = ['employee', 'created_at', 'month', 'year'];
}
