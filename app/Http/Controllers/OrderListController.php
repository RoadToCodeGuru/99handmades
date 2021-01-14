<?php

namespace App\Http\Controllers;

use Redirect,Response;
use Illuminate\Http\Request;
use App\Models\OrderList;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Item;
use App\Models\SubCategory;

class OrderListController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(OrderList::whereIn('status', [0,1])->with('customer')->select('*'))
            ->addColumn('action', 'admin.orders.order_lists_action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $customers = Customer::get();
        return view('admin.orders.order_lists', compact('customers'));
    }

    public function sale()
    {
        if(request()->ajax()) {
            return datatables()->of(OrderList::where('status', 2)->with('customer')->select('*'))
            ->addColumn('action', 'admin.orders.c_action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.orders.completed');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    function stock_change($datas, $action)
    {
        foreach($datas as $data){

            $item = Item::where('item_id', $data->item_id)->first();
            $stock = $item->stock_amount;

            if($action == 'sum')
            {
                Item::where('item_id', $data->item_id)->update([
                    'stock_amount' => $stock + $data->item_count
                ]);
            }else if($action == 'sub')
            {
                Item::where('item_id', $data->item_id)->update([
                    'stock_amount' => $stock - $data->item_count
                ]);
            }
            
        }
    }

    public function store(Request $request)
    {   
        $this->validate($request, [
            'customer_id' => 'required',
            'delivery_price' => 'required',
            'total_discount' => 'required',
            'status' => 'required',
        ]);

        $session_data = session('prev_data');
        $prev_datas =  json_decode($session_data, true);
        
        $id = $request->od_box_id;

        $set_data = Order::where('customer_id', $request->customer_id)->with('item')->get();
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
            foreach($prev_datas as $p_data){

                $item = Item::where('item_id', $p_data['item_id'])->first();
                $stock = $item->stock_amount;
    
                Item::where('item_id', $p_data['item_id'])->update([
                    'stock_amount' => $stock + $p_data['item_count']
                ]);
            }

            $order_list   =   OrderList::where('order_id', $id)->update($order_data);
        }
        else 
        {
            $order_list   =   OrderList::create($order_data);  
            
        }


        foreach($set_data as $data){

            $item = Item::where('item_id', $data->item_id)->first();
            $stock = $item->stock_amount;

            Item::where('item_id', $data->item_id)->update([
                'stock_amount' => $stock - $data->item_count
            ]);
        }

        Order::where('customer_id', $request->customer_id)->delete();
                
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

        $total = ($sub_total + $order_list->deli_price ) - $order_list->total_discount;

        $total_profit = ($sub_total - $order_list->total_discount ) - $total_capital_price;

        return view('admin.details.order_detail', compact('order_list', 'order_datas', 'total_capital_price', 'sub_total', 'total', 'total_profit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Request $request)
    // {
    //     $customer   =   Customer::where('id', $request->id)->delete();
    //     return Response::json($customer);
        
    // }

    public function invoice($id)
    {
        $order_list  = OrderList::where('order_id',$id)->with('customer')->first();
        $date = date("d.m.Y", $order_list->created_on);
        $order_datas =  json_decode($order_list->order_data, true);

        $no= 1;
        foreach($order_datas as $data){
            $f_p[] = $data['final_price'];
            $i_datas[] = [
                'no' => $no,
                'item_name' => $data['item']['item_name'],
                'unit_price' => $data['item']['sale_price'] - $data['discount'],
                'item_count' => $data['item_count'],
                'final_price' => $data['final_price']
            ];
            $no ++;
        }

        $sub_total = array_sum($f_p);

        $total = ($sub_total + $order_list->deli_price ) - $order_list->total_discount;

        return view('admin.itemsets.invoice', compact('order_list', 'i_datas', 'sub_total', 'total', 'date'));
    }

    public function phcover(){
        $sc = SubCategory::where('sub_category_name', 'Ph cover')->first();
        $covers = Item::where('subcategory_id', $sc->id)->where('stock_amount','>', 0)->get();

        return view('admin.details.phcover_list', compact('covers'));
    }

}
