<?php

namespace App\Http\Controllers;

use Redirect,Response;
use Illuminate\Http\Request;
use App\Models\MakeSet;
use App\Models\Item;
use App\Models\ItemSet;

class ItemSetController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(ItemSet::select('*'))
            ->addColumn('action', 'admin.itemsets.itemset_action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.itemsets.itemset');
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
            'item_set_name' => 'required|string',
        ]);
       
        $set_data = MakeSet::with('item')->get();
        $data = (string) $set_data;
        
        $itemset   =   ItemSet::create([
            'item_set_name' => $request->item_set_name,
            'item_set_data' => $data
        ]);  
        
                
        return Response::json($itemset);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itemset  = ItemSet::findOrFail($id);
        return Response::json($itemset);
    }


    public function update(Request $request)
    {
        $this->validate($request, [
            'item_set_id' => 'required',
            'item_set_name' => 'required|string',
        ]);
        
        $id = $request->item_set_id;

        $itemset   =   ItemSet::where('id', $id)->update([
            'item_set_name' => $request->item_set_name
        ]);  
        
                
        return Response::json($itemset);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $itemset   =   ItemSet::where('id', $request->id)->delete();
        return Response::json($itemset);
        
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'ie_set' => 'required',
            'item_set_ie_name' => 'required',
        ]);

        $set = $request->ie_set;
        $id = $request->item_set_ie_name;



        if($set == 'i'){
            $itemset = ItemSet::where('id', $request->item_set_ie_name)->first();
            $datas = json_decode($itemset->item_set_data,true);

            MakeSet::truncate();

            foreach($datas as $data){
                MakeSet::create([
                    'item_id' => $data['item_id'],
                    'amount' => $data['amount'],
                    'total_price' => $data['total_price']
                ]);
            }
            
            return Response::json($itemset);

        }else if ($set == 'e'){
            $set_data = MakeSet::with('item')->get();
            $data = (string) $set_data;
            
            $itemset   =   ItemSet::where('id', $id)->update([
                'item_set_data' => $data
            ]);  
           
            return Response::json($itemset);
        }  
    }

    public function empty()
    {
        MakeSet::truncate();
        $makeset = MakeSet::get();
        return Response::json($makeset);
    }
}
