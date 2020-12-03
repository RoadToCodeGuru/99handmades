<?php

namespace App\Http\Controllers;

use Redirect,Response;
use Illuminate\Http\Request;
use App\Models\OrderList;
use App\Models\Order;

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
}
