<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\SubCategory;
use App\Models\Category;

class ContentController extends Controller
{
    public function content()
    {
        $items = Item::latest()->paginate(100);

        $sub_dc = Category::where('category_name', 'Dream Catcher')->with('sub_categories')->first();
      
        $sub_rs = Category::where('category_name', 'Resin')->with('sub_categories')->first();

        return view('customer.content', compact('items', 'sub_dc', 'sub_rs'));
    }


    public function choose_content($sub)
    {
        $items = Item::where('subcategory_id', $sub)->latest()->get();

        $sub_dc = Category::where('category_name', 'Dream Catcher')->with('sub_categories')->first();
      
        $sub_rs = Category::where('category_name', 'Resin')->with('sub_categories')->first();

        return view('customer.content', compact('items', 'sub_dc', 'sub_rs'));
    }
}
