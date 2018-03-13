<?php

namespace App\Models\Fleet;

use Illuminate\Database\Eloquent\Model;

class MasterSupply extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'dbo.MasterSupply';
}
