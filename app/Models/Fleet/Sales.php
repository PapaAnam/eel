<?php

namespace App\Models\Fleet;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'dbo.SalesPerson';
    public $timestamps = false;
}
