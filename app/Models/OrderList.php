<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function order_logs()
    {
        return $this->hasMany('App\Models\OrderLog', 'order_id', 'order_id');
    }
}
