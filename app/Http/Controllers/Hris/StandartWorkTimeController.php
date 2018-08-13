<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hris\StandartWorkTime;

class StandartWorkTimeController extends Controller
{
    
	public function index(Request $r)
	{
		$month = $r->query('month');
		$year = $r->query('year');
		$standartTime = '176 hours';
		$std = null;
		$st = null;
		if($month && $year){
			$st = StandartWorkTime::where('month', $month)->where('year', $year)->first();
			if(!is_null($st)){
				$std = $st->max_time_view;
			}
		}
		return is_null($st) ? $standartTime : $std;
	}

	public function update(Request $r)
	{
		$month = $r->query('month');
		$year = $r->query('year');
		StandartWorkTime::updateOrCreate([
			'month'=>$month,
			'year'=>$year,
		],[
			'max_time'=>$r->standartWorkTime
		]);
		return 'Standart work time updated';
	}

	public function maxTime(Request $r)
	{
		$month = $r->query('month');
		$year = $r->query('year');
		$standartTime = 176;
		$std = null;
		$st = null;
		if($month && $year){
			$st = StandartWorkTime::where('month', $month)->where('year', $year)->first();
			if(!is_null($st)){
				$std = $st->max_time;
			}
		}
		return is_null($st) ? $standartTime : $std;
	}

}
