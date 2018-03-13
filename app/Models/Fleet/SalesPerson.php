<?php

namespace App\Models\Fleet;

use Illuminate\Database\Eloquent\Model;

class SalesPerson extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'dbo.SalesPerson';

    public function collector()
    {
    	return $this->belongsTo('App\Models\Fleet\Collector', 'Kode', 'Kode');
    }

    public function salesOrder()
    {
    	return $this->belongsTo('App\Models\Fleet\MasterSO', 'Kode', 'Sales');
    }
}
