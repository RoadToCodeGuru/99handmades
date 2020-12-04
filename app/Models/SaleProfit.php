<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProfit extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function order_list()
    {
        return $this->belongsTo('App\Models\OrderList', 'order_id', 'order_id');
    }
}
