<?php

namespace App\Models\Altius;

use Illuminate\Database\Eloquent\Model;

class MataUang extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'dbo.MataUang';
}
