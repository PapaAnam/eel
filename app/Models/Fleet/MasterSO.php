<?php

namespace App\Models\Fleet;

use Illuminate\Database\Eloquent\Model;

class MasterSO extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'dbo.MasterSO';

    public function detailOrder()
    {
    	return $this->hasMany('App\Models\Fleet\DetailSO', 'KodeNota', 'KodeNota');
    }
}
