<?php

namespace App\Http\Controllers\Hris;

use App\Models\Hris\LeavePeriod\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LeavePeriodRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $year = $request->year;
        $is_local = $request->is_local;
        $rules = Rule::with('status');
        if($is_local == 'all'){
            return $rules->where('rule_year', $year)->orderBy('is_local', 'desc')->get();
        }
        return $rules->where('is_local', $is_local)->where('rule_year', $year)->orderBy('is_local', 'desc')->get();
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
        $user = Auth::guard('api')->user();
        $rules = [
            'holiday'=>'required|numeric|min:0',
            'pregnancy'=>'required|numeric|min:0',
            'sick'=>'required|numeric|min:0',
            'special_permit'=>'required|numeric|min:0',
            'father_leave'=>'required|numeric|min:0'
        ];
        if($request->employee_type == 'international'){
            $rules['father_leave']='nullable|numeric|min:0';
        }
        $request->validate($rules);
        $lp = Rule::where('rule_year', $request->year)->where('user_id', $user->id)->first();
        if($lp){
            $lp->update([
                'special_permit'        => $request->special_permit,
                'holiday'               => $request->holiday,
                'father_leave'          => $request->father_leave,
                'sick'                  => $request->sick,
                'pregnancy'             => $request->pregnancy,
            ]);
        }else{
            Rule::create([
                'employee_type'         => $request->employee_type,
                'special_permit'        => $request->special_permit,
                'holiday'               => $request->holiday,
                'father_leave'          => $request->father_leave,
                'sick'                  => $request->sick,
                'pregnancy'             => $request->pregnancy,
                'user_id'               => $user->id,
            ]); 
        }
        return 'Leave Period Rule success';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hris\Rule  $leavePeriodRule
     * @return \Illuminate\Http\Response
     */
    public function show(Rule $rule)
    {
        return $rule;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hris\Rule  $leavePeriodRule
     * @return \Illuminate\Http\Response
     */
    public function edit(Rule $leavePeriodRule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hris\Rule  $leavePeriodRule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rule $leavePeriodRule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hris\Rule  $leavePeriodRule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rule $leavePeriodRule)
    {
        //
    }

    public function storeRule(Request $request)
    {
        $max = (int) $request->max;
        $request->validate([
            'max'=>'required|numeric|min:0',
            'used'=>'required|numeric|min:0|max:'.$max,
            'employee_id'=>'required|numeric|min:0',
            'year'=>'required|numeric|min:2000',
        ]);
        $year = (int) $request->year;
        $employee_id = (int) $request->employee_id;
        $status_id = (int) $request->status_id;
        $rule = Rule::where('rule_year', $year)
        ->where('employee_id', $employee_id)
        ->where('status_id', $status_id)
        ->first();
        if(is_null($rule)){
            $rule = Rule::create([
                'employee_id'=>$employee_id,
                'rule_year'=>$year,
                'status_id'=>$status_id,
                'qty_max'=>(int) $request->max,
                'used'=>(int) $request->used,
            ]);
        }else{
            $rule->update([
                'qty_max'=>(int) $request->max,
                'used'=>(int) $request->used,
            ]);
        }
        return 'Leave Period Rule Success Saved';
    }
}
