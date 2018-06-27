<?php

namespace App\Http\Controllers\Hris;

use App\Models\Hris\LeavePeriodLeft;
use App\Models\Hris\LeavePeriodRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hris\Employee;

class LeavePeriodLeftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
    	$local 			= LeavePeriodRule::where('employee_type', 'local')->first();
    	$international 	= LeavePeriodRule::where('employee_type', 'international')->first();
    	foreach (Employee::active() as $e) {
    		$from = $local;
    		if($e->e_from == 'International'){
    			$from = $international;
    		}
    		LeavePeriodLeft::firstOrCreate([
    			'year'			=> $r->query('year'),
    			'employee_id'	=> $e->id,
    		], [
    			'special_permit'		=> $from['special_permit'],
    			'holiday'				=> $from['holiday'],
    			'father_leave'			=> $from['father_leave'],
    			'sick'					=> $from['sick'],
    			'pregnancy'				=> $from['pregnancy'],
    		]);
    	}
    	return LeavePeriodLeft::with('emp')->where('year', $r->year)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hris\LeavePeriodLeft  $leavePeriodLeft
     * @return \Illuminate\Http\Response
     */
    public function show(LeavePeriodLeft $leavePeriodLeft)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hris\LeavePeriodLeft  $leavePeriodLeft
     * @return \Illuminate\Http\Response
     */
    public function edit(LeavePeriodLeft $leavePeriodLeft)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hris\LeavePeriodLeft  $leavePeriodLeft
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeavePeriodLeft $leavePeriodLeft)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hris\LeavePeriodLeft  $leavePeriodLeft
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeavePeriodLeft $leavePeriodLeft)
    {
        //
    }
}
