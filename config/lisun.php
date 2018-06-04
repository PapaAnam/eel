<?php 
return [
	'fleet' => [
		'name' => env('FLEET_NAME', 'Fleet Management'),
		'env' => env('FLEET_ENV', 'production'),
		'base_url' => config('app.url').'/fleet-management'
	],
	'hris' => [
		'name' => env('HRIS_NAME', 'HRIS'),
		'env' => env('HRIS_ENV', 'production'),
		'base_url' => config('app.url').'/hris'
	],
];