<?php

namespace App\Models\Fleet;

use Illuminate\Database\Eloquent\Model;

class Collector extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'dbo.Collector';
}
