<?php

namespace App\Http\Controllers;

use Redirect,Response;
use Illuminate\Http\Request;
use App\Models\MakeSet;
use App\Models\Item;
use App\Models\ItemSet;

class MakeSetController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(MakeSet::with('item')->select('*'))
            ->addColumn('action', 'admin.itemsets.makesets_action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $items = Item::get(['item_id', 'item_name', 'sale_price']);
        $item_sets = ItemSet::get(['id', 'item_set_name']);
        return view('admin.itemsets.makesets', compact('items','item_sets'));
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
            'item_id' => 'required',
            'amount' => 'required',
        ]);
       
        $id = $request->makeset_id;

        $item = Item::where('item_id', $request->item_id)->first();
        
        if($id != null or $id != '')
        {   
            $makeset   =   MakeSet::where('id', $id)->update([
                'item_id' => $request->item_id,
                'amount' => $request->amount,
                'total_price' => ($request->amount * $item->sale_price)
            ]);
        }
        else 
        {
            $makeset   =   MakeSet::create([
                'item_id' => $request->item_id,
                'amount' => $request->amount,
                'total_price' => ($request->amount * $item->sale_price)
            ]);  
        }
                
        return Response::json($makeset);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $makeset  = MakeSet::findOrFail($id);
        return Response::json($makeset);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $makeset   =   MakeSet::where('id', $request->id)->delete();
        return Response::json($makeset);
        
    }


    public function invoice(Request $request)
    {
        $customer_name = $request->customer_name;
        $phone_number =  $request->phone_number;
        $address = $request->address;
        $date = $request->date;

        $items   =   MakeSet::with('item')->get();
        foreach($items as $item){
            $subtotal_arr[] = $item->total_price;
        }
        $subtotal = array_sum($subtotal_arr);
        return view('admin.itemsets.invoice', compact('items', 'subtotal', 'customer_name', 'phone_number', 'address', 'date'));
    }
}
