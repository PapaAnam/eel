<?php

namespace App\Models\HelpDesk;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $connection = 'sqlsrv', $table = 'dbo.Pelanggan', $primaryKey = 'Kode';
}
