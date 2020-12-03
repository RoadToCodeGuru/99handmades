<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function order_list()
    {
        return $this->belongsTo('App\Models\OrderList', 'order_id', 'order_id');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id', 'item_id');
    }
}
