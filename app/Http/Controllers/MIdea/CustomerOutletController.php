<?php

namespace App\Http\Controllers\MIdea;

use App\Models\MIdea\CustomerOutlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerOutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CustomerOutlet::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'outlet_code'=>'required',
            'outlet_name'=>'required',
            'address'=>'required',
            'district'=>'required',
            'phone_number'=>'required',
            'contact_person'=>'required',
            'segment'=>'required',
            'salesman'=>'required',
            'division'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
            'icon'=>'required|mimes:jpeg,png',
        ]);
        $path = $request->file('icon')->store('public/customer-outlet');
        $path = str_replace('\\', '/', str_replace('public/', 'storage/', $path));
        CustomerOutlet::create([
            'outlet_code'=>$request->outlet_code,
            'outlet_name'=>$request->outlet_name,
            'address'=>$request->address,
            'district'=>$request->district,
            'phone_number'=>$request->phone_number,
            'contact_person'=>$request->contact_person,
            'segment'=>$request->segment,
            'salesman'=>$request->salesman,
            'division'=>$request->division,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            'icon'=>$path,
        ]);
        return ['message'=>'Customer outlet success created', 'status_code'=>200];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MIdea\CustomerOutlet  $customerOutlet
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerOutlet $customerOutlet)
    {
        return $customerOutlet;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MIdea\CustomerOutlet  $customerOutlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerOutlet $customerOutlet)
    {
        $request->validate([
            'outlet_code'=>'required',
            'outlet_name'=>'required',
            'address'=>'required',
            'district'=>'required',
            'phone_number'=>'required',
            'contact_person'=>'required',
            'segment'=>'required',
            'salesman'=>'required',
            'division'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
            'icon'=>'nullable|mimes:jpeg,png',
        ]);
        $data = [
            'outlet_code'=>$request->outlet_code,
            'outlet_name'=>$request->outlet_name,
            'address'=>$request->address,
            'district'=>$request->district,
            'phone_number'=>$request->phone_number,
            'contact_person'=>$request->contact_person,
            'segment'=>$request->segment,
            'salesman'=>$request->salesman,
            'division'=>$request->division,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
        ];
        if($request->file('icon')){
            $path = $request->file('icon')->store('public/customer-outlet');
            $path = str_replace('\\', '/', str_replace('public/', 'storage/', $path));
            $data['icon'] = $path;
        }
        $customerOutlet->update($data);
        return ['message'=>'Customer outlet success update', 'status_code'=>200];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MIdea\CustomerOutlet  $customerOutlet
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerOutlet $customerOutlet)
    {
        //
    }
}
