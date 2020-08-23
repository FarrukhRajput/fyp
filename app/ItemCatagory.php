<?php

namespace restro;

use restro\RawItem;
use Illuminate\Database\Eloquent\Model;


class ItemCatagory extends Model
{
    // protected $table = 'item_catagories' ;


    public function getAllProducts()
    {
        return $this->hasMany(RawItem::class,'catagory_id');
    }

}
