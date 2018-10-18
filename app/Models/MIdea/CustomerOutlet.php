<?php

namespace App\Models\MIdea;

use Illuminate\Database\Eloquent\Model;

class CustomerOutlet extends Model
{
	
	protected $table = 'marketing_customer_outlets';

	public $timestamps = false;

	protected $fillable = [
		'outlet_code',
		'outlet_name',
		'address',
		'district',
		'phone_number',
		'contact_person',
		'segment',
		'salesman',
		'division',
		'latitude',
		'longitude',
		'icon',
	];

	protected $appends = [
		'icon_path'
	];

	public function getIconAttribute($value)
	{
		return asset($value);
	}

	public function getIconPathAttribute()
	{
		return str_replace('/storage', 'storage', str_replace(url(''), '', $this->icon));
	}

}
