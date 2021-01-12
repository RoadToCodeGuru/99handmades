<?php

namespace App\Http\Controllers;

use Redirect,Response;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Item;
use App\Models\ItemSet;
use App\Models\Customer;
use App\Models\OrderList;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $cus_info = Customer::where('id', $request->ordering_customer)->first();

        if($request->order_id == '' || $request->order_id == null){
            $type = 'create';
            $o_id = '';
        }else{
            $box = OrderList::where('order_id', $request->order_id)->first();
            $datas = json_decode($box->order_data, true);

            Order::where('customer_id', $request->ordering_customer)->delete();

            foreach($datas as $data){
                Order::create([
                    'item_id' => $data['item_id'],
                    'customer_id' => $data['customer_id'],
                    'item_count' => $data['item_count'],
                    'discount' => $data['discount'],
                    'final_price' => $data['final_price']
                ]);
            }

            $type = 'edit';
            $o_id = $request->order_id;
        }
        

        if(request()->ajax()) {
            return datatables()->of(Order::where('customer_id', $request->customer_id)->with('item')->select('*'))
            ->addColumn('action', 'admin.orders.orders_action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        $items = Item::get(['item_id', 'item_name', 'stock_amount']);
        $item_sets = ItemSet::get(['id', 'item_set_name']);

        $customers = Customer::get(['id', 'customer_name']);

        return view('admin.orders.orders', compact('type', 'o_id', 'cus_info', 'items', 'item_sets', 'customers'));
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
            'item_id' => 'required|string',
            'amount' => 'required',
            'discount' => 'required'
        ]);

        $id = $request->box_id;

        $item = Item::where('item_id', $request->item_id)->first();
        
        if($id != null or $id != '')
        {   
            $order   =   Order::where('id', $id)->update([
                'customer_id' => $request->customer_o_id,
                'item_id' => $request->item_id,
                'item_count' => $request->amount,
                'discount' => $request->discount,
                'final_price' => ($request->amount * ($item->sale_price - $request->discount))
            ]);
        }
        else 
        {
            $order   =   Order::create([
                'customer_id' => $request->customer_o_id,
                'item_id' => $request->item_id,
                'item_count' => $request->amount,
                'discount' => $request->discount,
                'final_price' => ($request->amount * ($item->sale_price - $request->discount))
            ]);  
        }
                
        return Response::json($order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order  = Order::findOrFail($id);
        return Response::json($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $order   =   Order::where('id', $request->id)->delete();
        return Response::json($order);
        
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'item_set_name' => 'required',
        ]);

        $id = $request->item_set_name;

        $itemset = ItemSet::where('id', $request->item_set_name)->first();
        $datas = json_decode($itemset->item_set_data,true);

        Order::truncate();

        foreach($datas as $data){
            Order::create([
                'item_id' => $data['item_id'],
                'item_count' => $data['amount'],
                'discount' => 0,
                'final_price' => $data['total_price']
            ]);
        }
        
        return Response::json($itemset); 
    }

    public function empty()
    {
        Order::truncate();
        $order = Order::get();
        return Response::json($order);
    }
}
