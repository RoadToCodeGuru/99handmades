<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function items()
    {
        return $this->hasMany('App\Models\Item', 'item_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
