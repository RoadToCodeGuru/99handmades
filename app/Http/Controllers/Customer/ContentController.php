<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Item;

class ContentController extends Controller
{
    public function content()
    {
        $items = Item::get();
        return view('customer.content', compact('items'));
    }
}
