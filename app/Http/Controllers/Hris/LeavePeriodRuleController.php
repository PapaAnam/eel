<?php

namespace App\Http\Controllers\Hris;

use App\Models\Hris\LeavePeriodRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeavePeriodRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LeavePeriodRule::all();
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
        LeavePeriodRule::updateOrCreate([
            'employee_type'             => $request->employee_type,
        ], [
            'special_permit'                => $request->special_permit,
            'holiday'               => $request->holiday,
            'father_leave'              => $request->father_leave,
            'sick'              => $request->sick,
            'pregnancy'             => $request->pregnancy,
        ]);
        return 'Leave Period Rule success';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hris\LeavePeriodRule  $leavePeriodRule
     * @return \Illuminate\Http\Response
     */
    public function show(LeavePeriodRule $leavePeriodRule)
    {
        return $leavePeriodRule;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hris\LeavePeriodRule  $leavePeriodRule
     * @return \Illuminate\Http\Response
     */
    public function edit(LeavePeriodRule $leavePeriodRule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hris\LeavePeriodRule  $leavePeriodRule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeavePeriodRule $leavePeriodRule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hris\LeavePeriodRule  $leavePeriodRule
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeavePeriodRule $leavePeriodRule)
    {
        //
    }
}
