<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function sub_category()
    {
        return $this->belongsTo('App\Models\SubCategory', 'subcategory_id');
    }

    public function makeset()
    {
        return $this->hasOne('App\Models\MakeSet', 'item_id', 'item_id');
    }
}
