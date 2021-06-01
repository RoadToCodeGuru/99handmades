<?php

namespace App\Http\Controllers;

use Redirect,Response;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Item::with('sub_category')->select('*'))
            ->addColumn('action', 'admin.items.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $category = Category::get();
        $sub_category = SubCategory::get();
        return view('admin.items.index', compact('category', 'sub_category'));
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
            'item_name' => 'required|string',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'actual_price' => 'required',
            'sale_price' => 'required',
            'stock_amount' => 'required'
        ]);
       
        $id = $request->item_id;
        $item_image = $request->file('item_image');
        $instock = $request->has('instock') ? 0 : 1;

        $data = [
            'item_name' => $request->item_name,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->sub_category_id,
            'actual_price' => $request->actual_price,
            'sale_price' => $request->sale_price,
            'stock_amount' => $request->stock_amount,
            'instock' => $instock
        ];
        
        if($id != '')
        {   
            $item = Item::where('item_id', $id)->first();
            if($item_image != '') {
                $img_name = rand() .'.'. $item_image->getClientOriginalExtension();
                $item_image->move(public_path('images'), $img_name);

                $fileimg = $item->item_image;
                $oldImage = public_path('images/').$fileimg;
                
                if(file_exists($oldImage)) {
                    @unlink($oldImage);
                }

                $data['item_image'] = $img_name;
            }

            Item::where('item_id', $id)->update($data);
        }
        else 
        {
            if($item_image != '') {
                $new_name = rand() .'.'. $item_image->getClientOriginalExtension();
                $item_image->move(public_path('images'), $new_name);

                $data['item_image'] = $new_name;
            }

            $item = Item::create($data);  
        }
                
        return Response::json($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item  = Item::where('item_id',$id)->first();
        return Response::json($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $item = Item::where('item_id', $request->id)->first();

        $fileimg = $item->item_image;
        $oldImage = public_path('images/').$fileimg;
        
        if(file_exists($oldImage)) {
            @unlink($oldImage);
        }

        Item::where('item_id', $request->id)->delete();
        return Response::json($item);
        
    }

    public function give_capital()
    {
        $items = Item::where('stock_amount', '>', 0)->get();
    

        $cap_items = array();

        foreach($items as $item) 
        {
            $cap_items[] = $item->actual_price * $item->stock_amount;
            $sale_items[] = $item->sale_price * $item->stock_amount;
        }

        $report = [
            'capital' => array_sum($cap_items),
            'sale' => array_sum($sale_items)
        ];
        
        return $report;
    }
}
