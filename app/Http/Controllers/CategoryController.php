<?php

namespace App\Http\Controllers;

use Redirect,Response;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Category::select('*'))
            ->addColumn('action', 'admin.categories.category_action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.categories.category');
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
            'category_name' => 'required|string',
        ]);
        
        $id = $request->category_id;
        
        if($id != null or $id != '')
        {   
            $category   =   Category::where('id', $id)->update([
                'category_name' => $request->category_name,
            ]);
        }
        else 
        {
            $category   =   Category::create([
                'category_name' => $request->category_name,
            ]);  
        }
                
        return Response::json($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category  = Category::findOrFail($id);
        return Response::json($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category   =   Category::where('id', $request->id)->delete();
        return Response::json($category);
        
    }
}
