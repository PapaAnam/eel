<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $connection = 'sqlsrv', $table = 'dbo.Barang', $primaryKey = 'Kode';
}
