<?php

namespace App\Models\Altius;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'dbo.Product';
}
