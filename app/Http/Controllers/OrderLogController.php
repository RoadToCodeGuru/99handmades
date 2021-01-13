<?php

namespace App\Http\Controllers;

use Redirect,Response;
use Illuminate\Http\Request;
use App\Models\OrderList;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderLog;
use App\Models\Item;
use App\Models\SaleProfit;

class OrderLogController extends Controller
{
    public function status(Request $request)
    {
        if($request->status == 'draft'){
            OrderList::where('order_id', $request->id)->update([
                'status' => 0
            ]);
        }else{
            OrderList::where('order_id', $request->id)->update([
                'status' => 1
            ]);
        }

        return Response::json(['status' => 'reload']);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        // get the order list with customer_id
        $order_list  = OrderList::where('order_id',$id)->first();

        $order_datas =  json_decode($order_list->order_data, true);
        foreach($order_datas as $data){

            $item = Item::where('item_id', $data['item_id'])->first();
            $stock = $item->stock_amount;

            Item::where('item_id', $data['item_id'])->update([
                'stock_amount' => $stock + $data['item_count']
            ]);
        }

        OrderList::where('order_id', $id)->delete();

        return redirect('/order');
    }

    public function e_delete($id)
    {

        OrderList::where('order_id', $id)->delete();

        return redirect('/order');
    }

    public function complete(Request $request)
    {
        $id = $request->id;
        // get the order list with customer_id
        $order_list  = OrderList::where('order_id',$id)->first();
        
        // data for order_logs
        $customer_id = $order_list->customer_id;
        $time = time();


        $order_datas =  json_decode($order_list->order_data, true);

        foreach($order_datas as $data){
            OrderLog::create([
                'order_id' => $id,
                'item_id' => $data['item_id'],
                'customer_id' => $customer_id,
                'o_item_count' => $data['item_count'],
                'o_actual_price' => $data['item']['actual_price'],
                'o_sale_price' => $data['item']['sale_price'],
                'o_unit_discount' => $data['discount'],
                'o_total_price' => $data['final_price'],
                'item_set_id' => $data['item_set_id'],
                'created_on' => $time
            ]);

            $c_p[] = $data['item']['actual_price'] * $data['item_count'];
            $f_p[] = $data['final_price'];
        }

        $total_capital_price = array_sum($c_p);
        $sub_total = array_sum($f_p);

        $total = ($sub_total + $order_list->deli_price ) - $order_list->total_discount;

        $total_profit = ($sub_total - $order_list->total_discount ) - $total_capital_price;

        SaleProfit::create([
            'order_id' => $id,
            'customer_id' => $customer_id,
            'total_capital_price' => $total_capital_price,
            'subtotal_price' => $sub_total - $order_list->total_discount,
            'profit' => $total_profit,
            'created_on' => $time
        ]);

        OrderList::where('order_id', $request->id)->update([
            'status' => 2
        ]);

        return Response::json(['status' => 'reload']);
    }
}
