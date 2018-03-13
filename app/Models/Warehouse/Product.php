<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $connection = 'sqlsrv', $table = 'dbo.Product', $primaryKey = 'Kode';
}
