<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function order_lists()
    {
        return $this->hasMany('App\Models\OrderList');
    }

    public function order_logs()
    {
        return $this->hasMany('App\Models\OrderLog');
    }

    // public function makeset()
    // {
    //     return $this->hasOne('App\Models\MakeSet', 'item_id', 'item_id');
    // }
}
