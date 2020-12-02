<?php

namespace App\Http\Controllers;

use Redirect,Response;
use Illuminate\Http\Request;
use App\Models\OrderList;
use App\Models\Order;

class OrderListController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(OrderList::with('customer')->select('*'))
            ->addColumn('action', 'admin.orders.order_lists_action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.orders.order_lists');
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
            'customer_id' => 'required',
            'delivery_price' => 'required',
            'total_discount' => 'required',
            'status' => 'required',
        ]);

        $id = $request->od_box_id;

        $set_data = Order::with('item')->get();
        $data = (string) $set_data;

        $order_data = [
            'customer_id' => $request->customer_id,
            'order_data' => $data,
            'note' => $request->note,
            'deli_price' => $request->delivery_price,
            'total_discount' => $request->total_discount,
            'status' => $request->status,
            'created_on' => time()
        ];
        
        if($id != null or $id != '')
        {   
            $order_list   =   OrderList::where('order_id', $id)->update($order_data);
        }
        else 
        {
            $order_list   =   OrderList::create($order_data);  
        }
                
        return redirect('/order');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order_list  = OrderList::where('order_id',$id)->first();
        return Response::json($order_list);
    }

    public function detail($id)
    {
        $order_list  = OrderList::where('order_id',$id)->with('customer')->first();
        $order_datas =  json_decode($order_list->order_data, true);

        foreach($order_datas as $data){
            $c_p[] = $data['item']['actual_price'] * $data['item_count'];
            $f_p[] = $data['final_price'];
        }

        $total_capital_price = array_sum($c_p);
        $sub_total = array_sum($f_p);

        $total = $sub_total - ($order_list->total_discount + $order_list->deli_price);

        $total_profit = $total - $total_capital_price;

        return view('admin.details.order_detail', compact('order_list', 'order_datas', 'total_capital_price', 'sub_total', 'total', 'total_profit'));
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