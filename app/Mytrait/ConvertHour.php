<?php

namespace App\Mytrait;

trait ConvertHour 
{

	public function convertHour($hours)
	{
		$jam   = floor($hours);
		$dec   = $hours - $jam;
		$minutes = round($dec * 60);
		$t = ($jam > 1) ? 'hours' : "hour";
		$suffix = $minutes > 0 ? ' '.$minutes.' minutes' : '';
		return $jam . ' '.$t.$suffix;
	}

}