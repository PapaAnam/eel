<?php

namespace App\Models\Fleet;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'dbo.Pelanggan';
}
