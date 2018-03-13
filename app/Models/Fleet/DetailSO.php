<?php

namespace App\Models\Fleet;

use Illuminate\Database\Eloquent\Model;

class DetailSO extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'dbo.DetailSO';
}
