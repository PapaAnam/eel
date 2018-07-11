<?php

namespace App\Http\Controllers\Hris;

use App\Models\Hris\CashWithdrawal;
use App\Models\Hris\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CashWithdrawalController extends Controller
{

    public function index()
    {
        return CashWithdrawal::with('applicant','manager','hrd')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'applicant_id'=>'required',
            'hrd_id'=>'required',
            'manager_id'=>'required',
            'total'=>'required|numeric',
            'installment'=>'required|numeric',
            'reason'=>'required',
            'month_start'=>'required',
            'year_start'=>'required',
            'month_end'=>'required',
            'year_end'=>'required',
        ]);
        $applicant = Employee::find($request->applicant_id);
        CashWithdrawal::create([
            'applicant_id'=>$request->applicant_id,
            'job_title_id'=>$applicant->position,
            'department_id'=>$applicant->department,
            'hrd_id'=>$request->hrd_id,
            'manager_id'=>$request->manager_id,
            'total'=>$request->total,
            'reason'=>$request->reason,
            'installment'=>$request->installment,
            'month_start'=>$request->month_start,
            'year_start'=>$request->year_start,
            'month_end'=>$request->month_end,
            'year_end'=>$request->year_end,
            'created_at'=>date('Y-m-d'),
        ]);
        return 'New cash withdrawal success created';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hris\CashWithdrawal  $cashWithdrawal
     * @return \Illuminate\Http\Response
     */
    public function show(CashWithdrawal $cashWithdrawal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hris\CashWithdrawal  $cashWithdrawal
     * @return \Illuminate\Http\Response
     */
    public function edit(CashWithdrawal $cashWithdrawal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hris\CashWithdrawal  $cashWithdrawal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CashWithdrawal $cashWithdrawal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hris\CashWithdrawal  $cashWithdrawal
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashWithdrawal $cashWithdrawal)
    {
        //
    }

    public function printForm(CashWithdrawal $cashWithdrawal)
    {
        return view('cash-withdrawal.print-form');
    }
}
