<?php

namespace App\Http\Controllers;

use Redirect,Response;
use Illuminate\Http\Request;
use App\Models\Customer;

use App\Custom\CustomHelper;
use Hash;

class CustomerController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Customer::select('*'))
            ->addColumn('action', 'admin.customers.customers_action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.customers.customers');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validate($request, [
            'customer_name' => 'required|string',
            'phone_number' => 'required',
            'address' => 'required',
        ]);

        $id = $request->customer_id;

        $custom =  new CustomHelper;
        $valid_ph_number = $custom->getActualOperatorAndPhoneNumber($request->phone_number);
        $c_ph_number = $valid_ph_number[1];
        
        if($id != null or $id != '')
        {   
            $customer   =   Customer::where('id', $id)->update([
                'customer_name' => $request->customer_name,
                'phone_number' => $c_ph_number,
                'customer_address' => $request->address
            ]);
        }
        else 
        {
            $customer   =   Customer::create([
                'customer_name' => $request->customer_name,
                'phone_number' => $c_ph_number,
                'customer_address' => $request->address,
                'customer_password' => Hash::make('99Hc1234')
            ]);  
        }
                
        return Response::json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer  = Customer::findOrFail($id);
        return Response::json($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $customer   =   Customer::where('id', $request->id)->delete();
        return Response::json($customer);
        
    }
}
