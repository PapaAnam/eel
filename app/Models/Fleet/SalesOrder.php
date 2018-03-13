<?php

namespace App\Models\Fleet;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    public $timestamps = false;
    protected $table = 'fleet_sales_order';
	protected $fillable = [
		'KodeNota',
		'Status',
		'AlasanDitolak',
		'Sopir',
		'DikirimPada',
		'DilaporkanPada',
	];

	public function driver()
	{
		return $this->belongsTo('App\Models\Fleet\Collector', 'Sopir', 'Kode');
	}
}
