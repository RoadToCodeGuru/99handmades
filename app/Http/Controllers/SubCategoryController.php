<?php

namespace App\Http\Controllers;

use Redirect,Response;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(SubCategory::with('category')->select('*'))
            ->addColumn('action', 'admin.categories.subcategory_action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $category = Category::get();
        return view('admin.categories.subcategory', compact('category'));
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
            'subcategory_name' => 'required|string',
        ]);
       
        $id = $request->subcategory_id;
        
        if($id != null or $id != '')
        {   
            $subcategory   =   SubCategory::where('id', $id)->update([
                'category_id' => $request->category_id,
                'sub_category_name' => $request->subcategory_name,
            ]);
        }
        else 
        {
            $subcategory   =   SubCategory::create([
                'category_id' => $request->category_id,
                'sub_category_name' => $request->subcategory_name,
            ]);  
        }
                
        return Response::json($subcategory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subcategory  = SubCategory::findOrFail($id);
        return Response::json($subcategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $subcategory   =   SubCategory::where('id', $request->id)->delete();
        return Response::json($subcategory);
        
    }
}
